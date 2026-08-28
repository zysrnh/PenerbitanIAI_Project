<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai administrator terlebih dahulu.');
        }

        // If user is a member, redirect them to their member dashboard
        if (Auth::user()->role === 'member') {
            return redirect()->route('member.dashboard')->with('error', 'Akses ditolak. Halaman tersebut khusus untuk Administrator Redaksi.');
        }

        // Must be admin or super_admin
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Akses ditolak: Anda tidak memiliki hak akses administrator.');
        }

        if (!Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Akun administrator Anda telah dinonaktifkan.');
        }

        return $next($request);
    }
}
