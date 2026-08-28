<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('member.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Allow admins to also access member routes (they're supersets)
        $allowedRoles = ['member', 'admin', 'super_admin'];
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('member.login')->with('error', 'Akses hanya untuk member terdaftar.');
        }

        if (!Auth::user()->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('member.login')->with('error', 'Akun Anda telah dinonaktifkan oleh administrator.');
        }

        return $next($request);
    }
}
