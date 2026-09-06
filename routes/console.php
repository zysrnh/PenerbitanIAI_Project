<?php

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Command 1: Menjalankan Seeder Akun Admin secara langsung
 * Berguna di hosting cPanel yang melarang tinker / eval()
 */
Artisan::command('admin:seed', function () {
    $this->info('Memulai seeding akun admin...');
    $seeder = new AdminSeeder();
    $seeder->run();
    $this->info('✓ Seeder akun admin berhasil dijalankan!');
    $this->call('admin:list');
})->purpose('Seed atau perbarui akun-akun admin tanpa reset database');

/**
 * Command 2: Menampilkan daftar semua akun admin & perannya
 */
Artisan::command('admin:list', function () {
    $admins = User::whereIn('role', ['super_admin', 'admin', 'operator'])
        ->get(['id', 'name', 'email', 'role', 'phone', 'is_active', 'created_at']);

    if ($admins->isEmpty()) {
        $this->warn('Belum ada akun admin di database. Jalankan `php artisan admin:seed` untuk membuatnya.');
        return;
    }

    $headers = ['ID', 'Nama', 'Email', 'Role', 'No. Telp', 'Aktif?', 'Terdaftar'];
    $rows = $admins->map(function ($user) {
        return [
            $user->id,
            $user->name,
            $user->email,
            strtoupper($user->role),
            $user->phone ?? '-',
            $user->is_active ? 'YA' : 'NONAKTIF',
            $user->created_at ? $user->created_at->format('Y-m-d H:i') : '-',
        ];
    });

    $this->table($headers, $rows);
})->purpose('Menampilkan daftar seluruh akun admin beserta status dan perannya');

/**
 * Command 3: Reset password akun admin langsung lewat terminal
 */
Artisan::command('admin:reset-password {email? : Email akun admin} {password? : Password baru}', function () {
    $email = $this->argument('email') ?: $this->ask('Masukkan email admin');
    $user = User::where('email', $email)->first();

    if (!$user) {
        $this->error("Akun dengan email '{$email}' tidak ditemukan!");
        return 1;
    }

    $newPassword = $this->argument('password') ?: $this->secret('Masukkan password baru (default: persispers)') ?: 'persispers';

    $user->password = Hash::make($newPassword);
    $user->is_active = true;
    $user->save();

    $this->info("✓ Sukses! Password untuk akun '{$user->name}' ({$user->email}) berhasil diubah menjadi: {$newPassword}");
    return 0;
})->purpose('Reset kata sandi akun admin secara instan lewat terminal');
