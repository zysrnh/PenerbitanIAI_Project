<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@iaipibandung.ac.id'],
            [
                'name' => 'Super Admin IAI Persis',
                'role' => 'super_admin',
                'phone' => '082116116133',
                'is_active' => true,
                'password' => Hash::make('password'),
            ]
        );

        // 2. Admin Biasa
        User::updateOrCreate(
            ['email' => 'admin@iaipibandung.ac.id'],
            [
                'name' => 'Admin Penerbitan',
                'role' => 'admin',
                'phone' => '081234567890',
                'is_active' => true,
                'password' => Hash::make('password'),
            ]
        );

        // 3. Default Contact Settings
        $settings = [
            'contact_address' => 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287',
            'contact_whatsapp' => '082116116133',
            'contact_phone' => '(022) 5441951',
            'contact_email' => 'penerbitan@iaipibandung.ac.id',
            'contact_hours' => 'Senin – Jumat: 08:00 – 16:00 WIB',
            'contact_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sInstitut%20Agama%20Islam%20Persatuan%20Islam%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
        ];

        foreach ($settings as $k => $v) {
            SiteSetting::set($k, $v);
        }
    }
}
