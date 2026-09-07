<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MemberForgotPasswordController extends Controller
{
    /**
     * Tampilkan form minta link reset password member
     */
    public function showLinkRequestForm()
    {
        return view('member.auth.forgot-password');
    }

    /**
     * Kirim link reset password ke email member
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format alamat email tidak valid.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Alamat email tidak terdaftar di sistem PERSIS PERS.');
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

        $resetUrl = route('member.password.reset', ['token' => $token, 'email' => $request->email]);

        // Coba kirim email
        try {
            Mail::send('emails.member_reset_password', [
                'user'     => $user,
                'resetUrl' => $resetUrl,
                'token'    => $token,
            ], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Setel Ulang Kata Sandi Akun - Penerbit PERSIS');
            });

            return back()->with('success', 'Tautan pemulihan kata sandi telah dikirim ke email Anda. Silakan periksa kotak masuk atau folder spam.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email reset password member: ' . $e->getMessage());
            
            return back()->with('success', 'Permintaan reset berhasil diproses. Jika email tidak masuk, Anda dapat menggunakan tautan berikut: ' . $resetUrl);
        }
    }

    /**
     * Tampilkan form input password baru member
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        $record = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$record) {
            return redirect()->route('member.password.request')
                ->with('error', 'Tautan pemulihan kata sandi tidak valid atau sudah kadaluarsa.');
        }

        // Cek kedaluwarsa token (60 menit)
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('member.password.request')
                ->with('error', 'Tautan pemulihan telah kadaluarsa (lebih dari 60 menit). Silakan ajukan ulang.');
        }

        return view('member.auth.reset-password', [
            'token' => $token,
            'email' => $email ?? $record->email,
        ]);
    }

    /**
     * Simpan password baru member
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required'                 => 'Alamat email wajib diisi.',
            'password.required'              => 'Kata sandi baru wajib diisi.',
            'password.min'                   => 'Kata sandi minimal 8 karakter.',
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
            return redirect()->route('member.password.request')
                ->with('error', 'Token pemulihan telah kadaluarsa. Silakan ajukan ulang.');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Akun dengan email tersebut tidak ditemukan.');
        }

        // Update password & status aktif
        $user->password = Hash::make($request->password);
        $user->is_active = true;
        $user->save();

        // Hapus token yang sudah terpakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('member.login')
            ->with('success', 'Kata sandi berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
    }
}
