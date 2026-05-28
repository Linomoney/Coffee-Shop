<?php

namespace App\Policies;

use App\Models\DetailPesanan;
use App\Models\Pengguna;
use Illuminate\Auth\Access\Response;

class DetailPesananPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Pengguna $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Pengguna $user, DetailPesanan $detailPesanan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Pengguna $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Pengguna $user, DetailPesanan $detailPesanan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Pengguna $user, DetailPesanan $detailPesanan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Pengguna $user, DetailPesanan $detailPesanan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Pengguna $user, DetailPesanan $detailPesanan): bool
    {
        return false;
    }
}
