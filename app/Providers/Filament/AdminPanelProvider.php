<?php
namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use App\Filament\Pages\KasirPage;
use App\Http\Middleware\ArahkanBerdasarkanRole;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary'   => Color::hex('#6F4E37'), // cokelat kopi
                'secondary' => Color::hex('#C4A882'), // kopi susu
                'gray'      => Color::hex('#78716c'),
                'info'      => Color::hex('#0ea5e9'),
                'success'   => Color::hex('#22c55e'),
                'warning'   => Color::hex('#f59e0b'),
                'danger'    => Color::hex('#ef4444'),
            ])
            ->font('Poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap')
            ->brandName('☕ Kopi Nusantara')
            ->brandLogo(null)
            ->favicon(null)
            ->navigationGroups([
                NavigationGroup::make('Kasir'),
                NavigationGroup::make('Manajemen Menu'),
                NavigationGroup::make('Laporan'),
                NavigationGroup::make('Pengaturan'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                'web',
                ArahkanBerdasarkanRole::class, // ← tambahkan ini
            ])
            ->authMiddleware(['auth'])
            ->plugins([])
            ->renderHook(
                'panels::body.start',
                fn() => '',
            )
            ->authGuard('web');
    }
}