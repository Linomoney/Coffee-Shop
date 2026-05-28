<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['pengguna_id', 'jabatan', 'telepon', 'tanggal_masuk'];

    // Relasi One to One (balik)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Relasi One to Many
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'karyawan_id');
    }
}