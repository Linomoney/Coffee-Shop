<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pesanan;
use App\Models\Menu;

class StatistikHarian extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $hariIni    = Pesanan::whereDate('dipesan_pada', today())->where('status', 'selesai');
        $kemarin    = Pesanan::whereDate('dipesan_pada', today()->subDay())->where('status', 'selesai');

        $pendapatan = $hariIni->sum('total_harga');
        $pendKemarin= $kemarin->sum('total_harga');
        $transaksi  = $hariIni->count();
        $menuAktif  = Menu::where('tersedia', true)->count();

        $trendPend  = $pendKemarin > 0
            ? round((($pendapatan - $pendKemarin) / $pendKemarin) * 100)
            : 0;

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($pendapatan, 0, ',', '.'))
                ->description($trendPend >= 0 ? "↑ {$trendPend}% dari kemarin" : "↓ " . abs($trendPend) . "% dari kemarin")
                ->descriptionIcon($trendPend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($trendPend >= 0 ? 'success' : 'danger')
                ->chart(
                    Pesanan::where('status', 'selesai')
                        ->whereBetween('dipesan_pada', [now()->subDays(6), now()])
                        ->selectRaw('DATE(dipesan_pada) as tgl, SUM(total_harga) as total')
                        ->groupBy('tgl')->orderBy('tgl')
                        ->pluck('total')->toArray()
                ),

            Stat::make('Transaksi Hari Ini', $transaksi . ' pesanan')
                ->description('Semua pesanan selesai hari ini')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Menu Aktif', $menuAktif . ' menu')
                ->description('Menu yang tersedia saat ini')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),
        ];
    }
}