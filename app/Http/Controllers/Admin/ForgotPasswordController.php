<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan form minta link reset password
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Kirim link reset password ke email admin
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format alamat email tidak valid.',
        ]);

        $user = User::where('email', $request->email)
            ->whereIn('role', ['super_admin', 'admin', 'operator'])
            ->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Alamat email tidak terdaftar sebagai administrator sistem.');
        }

        // Generate token 64 karakter
        $token = Str::random(64);

        // Hapus token lama jika ada, lalu masukkan token baru
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => Carbon::now(),
        ]);

        $resetUrl = route('admin.password.reset', ['token' => $token, 'email' => $request->email]);

        // Coba kirim email
        try {
            Mail::send('emails.admin_reset_password', [
                'user'     => $user,
                'resetUrl' => $resetUrl,
                'token'    => $token,
            ], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Kata Sandi Akun Administrator - Penerbit PERSIS');
            });

            return back()->with('success', 'Tautan pemulihan kata sandi telah dikirim ke email Anda. Silakan periksa kotak masuk atau folder spam.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email reset password: ' . $e->getMessage());
            
            // Jika mail server belum terkonfigurasi (misal di local development), beri feedback yang jelas
            return back()->with('success', 'Permintaan reset berhasil diproses. Jika email tidak masuk, Anda dapat menggunakan URL pemulihan berikut: ' . $resetUrl);
        }
    }

    /**
     * Tampilkan form input password baru
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        $record = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$record) {
            return redirect()->route('admin.password.request')
                ->with('error', 'Token pemulihan kata sandi tidak valid atau sudah kadaluarsa.');
        }

        // Cek kedaluwarsa token (60 menit)
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('admin.password.request')
                ->with('error', 'Token pemulihan telah kadaluarsa (lebih dari 60 menit). Silakan ajukan ulang.');
        }

        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $email ?? $record->email,
        ]);
    }

    /**
     * Simpan password baru
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required'                 => 'Alamat email wajib diisi.',
            'password.required'              => 'Kata sandi baru wajib diisi.',
            'password.min'                   => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'             => 'Konfirmasi kata sandi tidak cocok.',
            'password_confirmation.required' => 'Ulangi kata sandi baru Anda.',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withInput()->with('error', 'Token pemulihan tidak cocok atau tidak valid.');
        }

        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
            return redirect()->route('admin.password.request')
                ->with('error', 'Token pemulihan telah kadaluarsa. Silakan ajukan ulang.');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Akun admin dengan email tersebut tidak ditemukan.');
        }

        // Update password & status aktif
        $user->password = Hash::make($request->password);
        $user->is_active = true;
        $user->save();

        // Hapus token yang sudah terpakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')
            ->with('success', 'Kata sandi berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
    }
}
