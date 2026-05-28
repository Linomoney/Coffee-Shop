<?php
namespace App\Policies;

use App\Models\Pengguna;
use App\Models\Menu;

class MenuPolicy
{
    public function viewAny(Pengguna $user): bool
    {
        return true;
    }

    public function view(Pengguna $user, Menu $menu): bool
    {
        return true;
    }

    public function create(Pengguna $user): bool
    {
        return $user->peran === 'admin';
    }

    public function update(Pengguna $user, Menu $menu): bool
    {
        return $user->peran === 'admin';
    }

    public function delete(Pengguna $user, Menu $menu): bool
    {
        return $user->peran === 'admin';
    }

    public function restore(Pengguna $user, Menu $menu): bool
    {
        return $user->peran === 'admin';
    }

    public function forceDelete(Pengguna $user, Menu $menu): bool
    {
        return $user->peran === 'admin';
    }
}