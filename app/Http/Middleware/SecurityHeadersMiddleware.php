<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and apply strict enterprise security headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Anti-Clickjacking: Disallows embedding in external malicious iframes
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. MIME Type Sniffing Prevention: Strict content-type enforcement
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. Cross-Site Scripting (XSS) Legacy Defense
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. Referrer Privacy Policy: No sensitive URL leak on cross-origin requests
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Hardware & Privacy Permissions Policy Lockdown
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=(), usb=(), display-capture=()');

        // 6. Cross-Domain Policy Lockdown (Flash/PDF data leak prevention)
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // 7. Cross-Origin Opener Policy (Spectre & window tampering defense)
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin-allow-popups');

        // 8. Strict-Transport-Security (HSTS - Enforce HTTPS permanently)
        if ($request->isSecure() || env('APP_ENV') === 'production' || str_contains(url('/'), 'https://')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // 9. Remove server exposure headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
