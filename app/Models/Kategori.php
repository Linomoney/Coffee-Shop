<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama', 'slug', 'keterangan'];

    // Relasi One to Many
    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategori_id');
    }
}