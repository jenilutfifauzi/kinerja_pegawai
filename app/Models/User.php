<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'level',
    ];

    protected $with = ['pegawai'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function canAccessPanel(Panel $panel): bool
    {
        // admin
        if ($panel->getId() === 'admin') {
            if ($this->level === 'admin') {
                return true;
            }
            return false;
        }

        // user
        if ($panel->getId() === 'user') {
            if ($this->level === 'user') {
                return true;
            }
            return false;
        }

        if ($panel->getId() === 'kepsek') {
            if ($this->level === 'kepsek') {
                return true;
            }
            return false;
        }

        if ($panel->getId() === 'kepdes') {
            if ($this->level === 'kepdes') {
                return true;
            }
            return false;
        }
    }

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }
}
