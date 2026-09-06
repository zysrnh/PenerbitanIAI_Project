<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the admin profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update admin profile information and avatar.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'         => ['nullable', 'string', 'max:30'],
            'avatar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:3072'],
            'remove_avatar' => ['nullable', 'boolean'],
        ], [
            'name.required'  => 'Nama lengkap atau username wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format alamat email tidak valid.',
            'email.unique'   => 'Alamat email ini sudah digunakan oleh pengguna lain.',
            'avatar.image'   => 'File foto profil harus berupa gambar.',
            'avatar.mimes'   => 'Format foto profil yang didukung: JPEG, PNG, JPG, WEBP, SVG.',
            'avatar.max'     => 'Ukuran file foto profil maksimal 3MB.',
        ]);

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Handle Avatar Removal
        if ($request->boolean('remove_avatar') && !$request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = null;
        }

        // Handle New Avatar Upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return back()->with('success', 'Profil dan foto profil Anda berhasil diperbarui.');
    }

    /**
     * Update admin password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required'         => 'Kata sandi baru wajib diisi.',
            'password.min'              => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed'        => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return back()->with('success', 'Kata sandi akun Anda berhasil diperbarui.');
    }
}
