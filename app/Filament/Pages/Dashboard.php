<?php
namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatistikHarian;
use App\Filament\Widgets\GrafikPendapatan;

class Dashboard extends BaseDashboard
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?int    $navigationSort  = 0;

    public function getWidgets(): array
    {
        return [
            StatistikHarian::class,
            GrafikPendapatan::class,
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->peran === 'admin';
    }
}