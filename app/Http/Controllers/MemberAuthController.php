<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MemberAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'member') {
            return redirect()->route('member.dashboard');
        }
        return view('member.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->role !== 'member') {
            return back()->withErrors(['email' => 'Email tidak terdaftar sebagai member.'])->onlyInput('email');
        }

        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Akun Anda tidak aktif.'])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('member.dashboard')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('member.dashboard');
        }
        return view('member.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'phone'                 => ['nullable', 'string', 'max:20'],
            'password'              => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ], [
            'email.unique'    => 'Email sudah terdaftar, silakan login.',
            'password.min'    => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'] ?? null,
            'password'  => Hash::make($validated['password']),
            'role'      => 'member',
            'is_active' => true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('member.dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}
