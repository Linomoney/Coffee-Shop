<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName; // ← tambahkan ini
use Filament\Panel;

class Pengguna extends Authenticatable implements FilamentUser, HasName // ← tambahkan HasName
{
    protected $table = 'pengguna';

    protected $fillable = ['nama', 'email', 'kata_sandi', 'peran'];

    protected $hidden = ['kata_sandi', 'remember_token'];

    // Wajib: memberitahu Filament kolom nama kita adalah 'nama'
    public function getFilamentName(): string
    {
        return $this->nama ?? '';
    }

    public function getAuthPassword(): string
    {
        return $this->kata_sandi;
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    protected function casts(): array
    {
        return [
            'kata_sandi' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->peran, ['admin', 'kasir']);
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'pengguna_id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'pengguna_id');
    }
}