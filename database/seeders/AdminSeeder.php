<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            // 1. Super Admin Utama (persispers.com)
            [
                'email'     => 'admin@persispers.com',
                'name'      => 'Super Admin PERSIS PERS',
                'role'      => 'super_admin',
                'phone'     => '082116116133',
                'is_active' => true,
                'password'  => Hash::make('persispers'),
            ],
            // 2. Super Admin Alternatif (penerbitpersis.com)
            [
                'email'     => 'superadmin@penerbitpersis.com',
                'name'      => 'Super Admin PERSIS PERS',
                'role'      => 'super_admin',
                'phone'     => '082116116133',
                'is_active' => true,
                'password'  => Hash::make('persispers'),
            ],
            // 3. Admin Redaksi & Penerbitan Naskah
            [
                'email'     => 'redaksi@penerbitpersis.com',
                'name'      => 'M. Farhan Zaki, M.Ag. (Admin Redaksi)',
                'role'      => 'admin',
                'phone'     => '085117797487',
                'is_active' => true,
                'password'  => Hash::make('persispers'),
            ],
            // 4. Admin Pengiriman & Gudang Logistik
            [
                'email'     => 'pengiriman@penerbitpersis.com',
                'name'      => 'Ust. Wildan Hidayat (Admin Pengiriman)',
                'role'      => 'admin',
                'phone'     => '082116116133',
                'is_active' => true,
                'password'  => Hash::make('persispers'),
            ],
            // 5. Admin Keuangan & Faktur Transaksi
            [
                'email'     => 'keuangan@penerbitpersis.com',
                'name'      => 'Nurul Hidayah, M.Pd. (Admin Keuangan)',
                'role'      => 'admin',
                'phone'     => '082116116133',
                'is_active' => true,
                'password'  => Hash::make('persispers'),
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}
