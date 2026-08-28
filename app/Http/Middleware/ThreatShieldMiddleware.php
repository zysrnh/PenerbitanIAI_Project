<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ThreatShieldMiddleware
{
    /**
     * Anti-DDoS rate limiter + intelligent malicious payload blocker.
     *
     * Layer 1: Global per-IP rate limiting (150 req/min)
     * Layer 2: Targeted SQL injection pattern detection
     * Layer 3: Malicious script & payload detection (public routes)
     * Layer 4: Path traversal attempt detection
     * Layer 5: Known exploit scanner blocking
     */

    private const GLOBAL_RATE_LIMIT = 180;
    private const RATE_WINDOW_SECONDS = 60;
    private const VIOLATION_THRESHOLD = 15;
    private const BAN_DURATION_MINUTES = 30;

    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // 1. Check if IP is banned
        if (Cache::has("threat_banned:{$ip}")) {
            return response('Akses Anda sementara dibatasi karena aktivitas mencurigakan. Silakan hubungi admin.', 429);
        }

        // 2. Global Rate Limiter per IP
        $rateKey = "threat_rate:{$ip}";
        $count = (int) Cache::get($rateKey, 0);
        if ($count >= self::GLOBAL_RATE_LIMIT) {
            $this->recordViolation($ip, 'rate_limit');
            return response('Terlalu banyak permintaan (Rate Limit Exceeded). Harap tunggu sejenak.', 429);
        }
        Cache::put($rateKey, $count + 1, now()->addSeconds(self::RATE_WINDOW_SECONDS));

        // 3. Path Traversal Detection (on URI)
        $uri = rawurldecode($request->getRequestUri());
        if (preg_match('/(\.\.[\/\\\\]|\/etc\/passwd|\/proc\/self|\/windows\/system32)/i', $uri)) {
            $this->recordViolation($ip, 'path_traversal');
            Log::critical("ThreatShield: Blocked path traversal", ['ip' => $ip, 'uri' => $uri]);
            abort(403, 'Forbidden.');
        }

        // 4. Malicious Scanner User-Agent Detection
        $ua = strtolower($request->userAgent() ?? '');
        if ($this->isScannerBot($ua)) {
            $this->recordViolation($ip, 'scanner_bot');
            abort(403, 'Forbidden.');
        }

        // 5. Query string SQLi / XSS inspection for public & guest requests
        if (!$request->is('admin/*')) {
            $queryString = (string) $request->getQueryString();
            if (!empty($queryString) && $this->containsMaliciousPayload($queryString)) {
                $this->recordViolation($ip, 'malicious_query');
                Log::critical("ThreatShield: Blocked malicious query", ['ip' => $ip, 'query' => $queryString]);
                abort(403, 'Forbidden: Malicious parameter detected.');
            }
        }

        return $next($request);
    }

    /**
     * Detect known high-confidence SQLi / XSS patterns in query parameters.
     */
    private function containsMaliciousPayload(string $str): bool
    {
        $decoded = rawurldecode($str);
        $patterns = [
            '/\bunion\b\s+(all\s+)?\bselect\b/i',
            '/(\bor\b|\band\b)\s+[\'\"]?\d+[\'\"]?\s*=\s*[\'\"]?\d+/i',
            '/(\'|\")\s*;\s*(drop|alter|truncate|delete)\s+table/i',
            '/\b(sleep|benchmark)\s*\(\s*\d+\s*\)/i',
            '/<script[\s>]/i',
            '/javascript\s*:/i',
            '/onerror\s*=/i',
            '/onload\s*=/i',
            '/information_schema/i',
            '/0x[0-9a-f]{8,}/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $decoded)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Identify security scanners and exploit tools.
     */
    private function isScannerBot(string $ua): bool
    {
        if (empty($ua)) return false;

        $scanners = [
            'sqlmap', 'nikto', 'wpscan', 'acunetix', 'nessus',
            'havij', 'w3af', 'openvas', 'dirbuster', 'gobuster',
        ];

        foreach ($scanners as $scanner) {
            if (str_contains($ua, $scanner)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Record violation with auto-ban on threshold.
     */
    private function recordViolation(string $ip, string $type): void
    {
        $key = "threat_violations:{$ip}";
        $count = (int) Cache::get($key, 0) + 1;
        Cache::put($key, $count, now()->addMinutes(10));

        if ($count >= self::VIOLATION_THRESHOLD) {
            Cache::put("threat_banned:{$ip}", true, now()->addMinutes(self::BAN_DURATION_MINUTES));
            Log::critical("ThreatShield: Auto-banned IP for {$type}", [
                'ip' => $ip,
                'violations' => $count,
            ]);
        }
    }
}
