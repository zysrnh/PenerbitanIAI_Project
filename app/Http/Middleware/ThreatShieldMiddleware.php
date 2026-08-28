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
     * Anti-DDoS rate limiter + malicious payload detector.
     *
     * Layer 1: Global per-IP rate limiting (independent from route throttle)
     * Layer 2: SQL injection pattern detection in query strings & body
     * Layer 3: XSS payload detection in inputs
     * Layer 4: Path traversal attack detection
     * Layer 5: Oversized request body rejection
     * Layer 6: Suspicious User-Agent blocking
     */

    // Max requests per IP per minute (global)
    private const GLOBAL_RATE_LIMIT = 120;
    private const RATE_WINDOW_SECONDS = 60;

    // Max request body size (2MB)
    private const MAX_BODY_SIZE = 2 * 1024 * 1024;

    // Auto-ban threshold: if IP triggers N violations in 10 minutes, block for 30 minutes
    private const VIOLATION_THRESHOLD = 10;
    private const BAN_DURATION_MINUTES = 30;

    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // Check if IP is currently banned
        if (Cache::has("threat_banned:{$ip}")) {
            Log::warning("ThreatShield: Blocked banned IP", ['ip' => $ip, 'uri' => $request->getRequestUri()]);
            abort(429, 'Too Many Requests. Silakan coba beberapa saat lagi.');
        }

        // Layer 1: Global per-IP rate limiting
        $rateCacheKey = "threat_rate:{$ip}";
        $requestCount = (int) Cache::get($rateCacheKey, 0);

        if ($requestCount >= self::GLOBAL_RATE_LIMIT) {
            $this->recordViolation($ip, 'rate_limit_exceeded');
            Log::warning("ThreatShield: Rate limit exceeded", ['ip' => $ip, 'count' => $requestCount]);
            abort(429, 'Too Many Requests.');
        }

        Cache::put($rateCacheKey, $requestCount + 1, now()->addSeconds(self::RATE_WINDOW_SECONDS));

        // Layer 2: SQL Injection Detection
        $allInputs = $this->flattenInputs($request);
        if ($this->detectSqlInjection($allInputs)) {
            $this->recordViolation($ip, 'sql_injection');
            Log::critical("ThreatShield: SQL Injection attempt blocked", [
                'ip'  => $ip,
                'uri' => $request->getRequestUri(),
            ]);
            abort(403, 'Forbidden: Malicious request detected.');
        }

        // Layer 3: XSS Payload Detection
        if ($this->detectXss($allInputs)) {
            $this->recordViolation($ip, 'xss_attempt');
            Log::critical("ThreatShield: XSS attempt blocked", [
                'ip'  => $ip,
                'uri' => $request->getRequestUri(),
            ]);
            abort(403, 'Forbidden: Malicious request detected.');
        }

        // Layer 4: Path Traversal Detection
        $uri = $request->getRequestUri();
        if ($this->detectPathTraversal($uri)) {
            $this->recordViolation($ip, 'path_traversal');
            Log::critical("ThreatShield: Path traversal attempt blocked", [
                'ip'  => $ip,
                'uri' => $uri,
            ]);
            abort(403, 'Forbidden.');
        }

        // Layer 5: Oversized request body rejection
        $contentLength = $request->header('Content-Length', 0);
        if ((int) $contentLength > self::MAX_BODY_SIZE) {
            abort(413, 'Request body too large.');
        }

        // Layer 6: Suspicious User-Agent blocking
        $userAgent = strtolower($request->userAgent() ?? '');
        if ($this->isSuspiciousUserAgent($userAgent)) {
            $this->recordViolation($ip, 'suspicious_ua');
            abort(403, 'Forbidden.');
        }

        return $next($request);
    }

    /**
     * Flatten all request inputs including query string into a single array of strings.
     */
    private function flattenInputs(Request $request): array
    {
        $inputs = [];
        foreach ($request->all() as $key => $value) {
            if (is_string($value)) {
                $inputs[] = $value;
                $inputs[] = $key;
            } elseif (is_array($value)) {
                array_walk_recursive($value, function ($v) use (&$inputs) {
                    if (is_string($v)) {
                        $inputs[] = $v;
                    }
                });
            }
        }

        // Also check query string
        foreach ($request->query() as $key => $value) {
            if (is_string($value)) {
                $inputs[] = $value;
            }
        }

        return $inputs;
    }

    /**
     * Detect common SQL injection patterns.
     */
    private function detectSqlInjection(array $inputs): bool
    {
        $patterns = [
            '/(\bunion\b\s+\bselect\b)/i',
            '/(\bselect\b\s+.*\bfrom\b)/i',
            '/(\binsert\b\s+\binto\b)/i',
            '/(\bupdate\b\s+.*\bset\b)/i',
            '/(\bdelete\b\s+\bfrom\b)/i',
            '/(\bdrop\b\s+\btable\b)/i',
            '/(\balter\b\s+\btable\b)/i',
            '/(\bexec\b\s*\()/i',
            '/(\bexecute\b\s*\()/i',
            '/(\'|\");\s*(drop|alter|truncate|delete|update|insert)/i',
            '/(\bor\b\s+[\'\"]?\d+[\'\"]?\s*=\s*[\'\"]?\d+)/i',
            '/(\band\b\s+[\'\"]?\d+[\'\"]?\s*=\s*[\'\"]?\d+)/i',
            '/(sleep\s*\(\s*\d+\s*\))/i',
            '/(benchmark\s*\()/i',
            '/(load_file\s*\()/i',
            '/(into\s+(out|dump)file)/i',
            '/(information_schema)/i',
            '/(0x[0-9a-f]{8,})/i',
            '/(char\s*\(\s*\d+)/i',
            '/(concat\s*\()/i',
            '/(group_concat\s*\()/i',
        ];

        foreach ($inputs as $input) {
            if (strlen($input) < 4) continue;
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $input)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Detect common XSS attack payloads.
     */
    private function detectXss(array $inputs): bool
    {
        $patterns = [
            '/<script[\s>]/i',
            '/javascript\s*:/i',
            '/on(click|load|error|mouseover|focus|blur|submit|change|input|keyup|keydown)\s*=/i',
            '/<iframe/i',
            '/<object/i',
            '/<embed/i',
            '/<applet/i',
            '/<meta[^>]+http-equiv/i',
            '/<link[^>]+rel\s*=\s*["\']?import/i',
            '/expression\s*\(/i',
            '/url\s*\(\s*["\']?javascript/i',
            '/data\s*:\s*text\/html/i',
            '/vbscript\s*:/i',
        ];

        foreach ($inputs as $input) {
            if (strlen($input) < 4) continue;
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $input)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Detect path traversal attempts.
     */
    private function detectPathTraversal(string $uri): bool
    {
        $patterns = [
            '/\.\.\//',
            '/\.\.\\\\/',
            '/%2e%2e/i',
            '/%252e%252e/i',
            '/\/etc\/passwd/i',
            '/\/proc\/self/i',
            '/\/windows\/system32/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $uri)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Detect known malicious or scanner user agents.
     */
    private function isSuspiciousUserAgent(string $ua): bool
    {
        if (empty($ua)) return false;

        $blocked = [
            'sqlmap', 'nikto', 'nmap', 'masscan', 'dirbuster',
            'gobuster', 'wpscan', 'acunetix', 'nessus', 'burpsuite',
            'havij', 'w3af', 'openvas', 'zmeu', 'morfeus',
            'scanner', 'exploit', 'attack', 'inject',
        ];

        foreach ($blocked as $term) {
            if (str_contains($ua, $term)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Record a violation for an IP. Auto-ban if threshold exceeded.
     */
    private function recordViolation(string $ip, string $type): void
    {
        $violationKey = "threat_violations:{$ip}";
        $count = (int) Cache::get($violationKey, 0) + 1;
        Cache::put($violationKey, $count, now()->addMinutes(10));

        if ($count >= self::VIOLATION_THRESHOLD) {
            Cache::put("threat_banned:{$ip}", true, now()->addMinutes(self::BAN_DURATION_MINUTES));
            Log::critical("ThreatShield: IP auto-banned for {$type}", [
                'ip'         => $ip,
                'violations' => $count,
                'ban_minutes' => self::BAN_DURATION_MINUTES,
            ]);
        }
    }
}
