<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'service_category', 'subject', 'message', 'status', 'notes'])]
class ContactMessage extends Model
{
    use HasFactory;

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Belum Dihubungi',
            'contacted' => 'Sudah Dihubungi',
            'completed' => 'Selesai Diproses',
            default => ucfirst($this->status),
        };
    }

    public function getWaLinkAttribute(): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $this->phone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }
        $text = urlencode("Halo Bapak/Ibu {$this->name}, kami dari Tim Redaksi PERSIS PERS ingin menindaklanjuti pesan/pengajuan naskah Anda regarding: {$this->service_category}.");
        return "https://wa.me/{$cleanPhone}?text={$text}";
    }
}
