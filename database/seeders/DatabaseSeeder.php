<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Super Admin Account
        User::updateOrCreate(
            ['email' => 'superadmin@iaipibandung.ac.id'],
            [
                'name' => 'Super Admin IAI Persis',
                'role' => 'super_admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Admin Biasa Account
        User::updateOrCreate(
            ['email' => 'admin@iaipibandung.ac.id'],
            [
                'name' => 'Admin Penerbitan',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
