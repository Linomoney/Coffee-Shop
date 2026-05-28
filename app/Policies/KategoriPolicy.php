<?php
namespace App\Policies;

use App\Models\Pengguna;
use App\Models\Kategori;

class KategoriPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Kategori $kategori): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Kategori $kategori): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Kategori $kategori): bool
    {
        return $user->peran === 'admin';
    }

    public function restore(Pengguna $user, Kategori $kategori): bool
    {
        return $user->peran === 'admin';
    }

    public function forceDelete(Pengguna $user, Kategori $kategori): bool
    {
        return $user->peran === 'admin';
    }
}