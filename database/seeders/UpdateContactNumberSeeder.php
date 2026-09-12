<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class UpdateContactNumberSeeder extends Seeder
{
    /**
     * Run the database seeds to update official contact numbers.
     */
    public function run(): void
    {
        $contactNumber = '0859-7800-6263';
        $cleanNumber = '6285978006263';
        $waUrl = "https://wa.me/{$cleanNumber}";

        $settings = [
            'contact_whatsapp' => $contactNumber,
            'social_whatsapp'  => $waUrl,
            'wakaf_contact_wa' => $contactNumber,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        $this->command->info("Nomor kontak resmi WhatsApp berhasil diperbarui ke: {$contactNumber} ({$waUrl})");
    }
}
