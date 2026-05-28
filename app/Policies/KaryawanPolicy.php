<?php
namespace App\Policies;

use App\Models\Pengguna; // ← ganti dari User
use App\Models\Karyawan;

class KaryawanPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Karyawan $karyawan): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Karyawan $karyawan): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Karyawan $karyawan): bool
    {
        return $user->peran === 'admin';
    }

    public function restore(Pengguna $user, Karyawan $karyawan): bool
    {
        return $user->peran === 'admin';
    }

    public function forceDelete(Pengguna $user, Karyawan $karyawan): bool
    {
        return $user->peran === 'admin';
    }
}