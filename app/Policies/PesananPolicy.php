<?php
namespace App\Policies;

use App\Models\Pengguna;
use App\Models\Pesanan;

class PesananPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Pesanan $pesanan): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return in_array($user->peran, ['admin', 'kasir']);
    }

    public function update(Pengguna $user, Pesanan $pesanan): bool
    {
        return in_array($user->peran, ['admin', 'kasir']);
    }

    public function delete(Pengguna $user, Pesanan $pesanan): bool
    {
        return $user->peran === 'admin';
    }

    public function restore(Pengguna $user, Pesanan $pesanan): bool
    {
        return $user->peran === 'admin';
    }

    public function forceDelete(Pengguna $user, Pesanan $pesanan): bool
    {
        return $user->peran === 'admin';
    }
}