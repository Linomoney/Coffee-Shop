<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Pengguna;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Karyawan;
use App\Models\Pesanan;

use App\Policies\PenggunaPolicy;
use App\Policies\KategoriPolicy;
use App\Policies\MenuPolicy;
use App\Policies\KaryawanPolicy;
use App\Policies\PesananPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Pengguna::class => PenggunaPolicy::class,
        Kategori::class => KategoriPolicy::class,
        Menu::class     => MenuPolicy::class,
        Karyawan::class => KaryawanPolicy::class,
        Pesanan::class  => PesananPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}