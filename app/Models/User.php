<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'telegram_id',
        'password',
        'role',
        'kategori_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    /**
     * Akses unit melalui kategori (HasOneThrough).
     */
    public function unit()
    {
        return $this->hasOneThrough(
            Unit::class,
            Kategori::class,
            'id_kategori',   // FK di kategori (local key match)
            'id_unit',       // FK di unit (local key match)
            'kategori_id',   // FK di users
            'unit_id'        // FK di kategori ke unit
        );
    }

    public function historyLaporans()
    {
        return $this->hasMany(HistoryLaporan::class, 'user_id', 'id');
    }

    public function logStatusLaporans()
    {
        return $this->hasMany(LogStatusLaporan::class, 'user_id', 'id');
    }
}
