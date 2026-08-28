<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Apply enterprise-grade security headers to every response.
     *
     * Defense layers:
     *  1. Clickjacking prevention   (X-Frame-Options)
     *  2. MIME-sniffing prevention   (X-Content-Type-Options)
     *  3. XSS legacy filter         (X-XSS-Protection)
     *  4. Referrer leakage control   (Referrer-Policy)
     *  5. Device permissions lockdown(Permissions-Policy)
     *  6. Cross-domain policy        (X-Permitted-Cross-Domain-Policies)
     *  7. Cross-Origin isolation     (COOP / CORP)
     *  8. Content Security Policy    (CSP)
     *  9. HSTS                       (Strict-Transport-Security)
     * 10. Server identity concealment
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only apply to HTML / JSON responses, skip binary downloads
        $contentType = $response->headers->get('Content-Type', '');
        if (str_contains($contentType, 'octet-stream') || str_contains($contentType, 'pdf')) {
            return $response;
        }

        // 1. Anti-Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. MIME-Sniffing Prevention
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. XSS Legacy Filter
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. Referrer Privacy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Permissions Policy – lock every dangerous browser API
        $response->headers->set('Permissions-Policy', implode(', ', [
            'camera=()',
            'microphone=()',
            'geolocation=()',
            'payment=()',
            'usb=()',
            'display-capture=()',
            'accelerometer=()',
            'gyroscope=()',
            'magnetometer=()',
            'midi=()',
            'serial=()',
            'bluetooth=()',
            'hid=()',
        ]));

        // 6. Cross-Domain Policy (Flash / PDF embedding prevention)
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // 7. Cross-Origin Isolation
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin-allow-popups');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        // 8. Content Security Policy (CSP)
        $cspDirectives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://unpkg.com https://www.googletagmanager.com https://www.google-analytics.com",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com https://unpkg.com",
            "img-src 'self' data: blob: https: http:",
            "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
            "connect-src 'self' https://app.pakasir.com https://api.qrserver.com https://www.google-analytics.com",
            "media-src 'self'",
            "object-src 'none'",
            "frame-src 'self'",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self' https://wa.me https://api.whatsapp.com",
            "upgrade-insecure-requests",
        ];
        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));

        // 9. HSTS – enforce HTTPS for 1 year with sub-domains
        if ($request->isSecure() || config('app.env') === 'production') {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // 10. Conceal server identity
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
