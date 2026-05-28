<?php
namespace App\Policies;

use App\Models\Pengguna;

class PenggunaPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function view(Pengguna $user, Pengguna $model): bool
    {
        return $user->peran === 'admin';
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Pengguna $model): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Pengguna $model): bool
    {
        return $user->peran === 'admin';
    }

    public function restore(Pengguna $user, Pengguna $model): bool
    {
        return $user->peran === 'admin';
    }

    public function forceDelete(Pengguna $user, Pengguna $model): bool
    {
        return $user->peran === 'admin';
    }
}