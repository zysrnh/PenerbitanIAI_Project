<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['name', 'email', 'phone', 'avatar', 'password', 'role', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Check if user is Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is standard Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the role display label.
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'super_admin' => 'Super Admin',
            'admin' => 'Admin Biasa',
            default => ucfirst($this->role),
        };
    }

    /**
     * Get user avatar URL.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!empty($this->avatar)) {
            if (Str::startsWith($this->avatar, ['http://', 'https://', '/'])) {
                return $this->avatar;
            }
            return asset('storage/' . $this->avatar);
        }
        return null;
    }

    /**
     * Get user initials.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }
        return $initials ?: 'U';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }
}
