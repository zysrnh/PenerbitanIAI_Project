<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Apply essential enterprise security headers without interfering with Tailwind CDN, Fonts, or dynamic CSS.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Anti-Clickjacking: prevent malicious iframe embedding
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. MIME-Sniffing Prevention: strict content-type enforcement
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. XSS Filter Defense
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. Referrer Privacy Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Hardware Permissions Policy
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), usb=(), display-capture=()');

        // 6. Cross-Domain Flash/PDF Lockdown
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // 7. Strict-Transport-Security (HTTPS)
        if ($request->isSecure() || config('app.env') === 'production') {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // 8. Conceal server disclosure headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
