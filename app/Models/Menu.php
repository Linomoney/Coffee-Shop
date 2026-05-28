<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['kategori_id', 'nama', 'keterangan', 'harga', 'gambar', 'tersedia'];

    // Relasi Many to One
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi One to Many
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'menu_id');
    }
}