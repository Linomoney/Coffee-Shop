<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Pesanan;

class GrafikPendapatan extends ChartWidget
{
    protected ?string $heading = '📈 Grafik Pendapatan 7 Hari Terakhir';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Pesanan::where('status', 'selesai')
            ->whereBetween('dipesan_pada', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(dipesan_pada) as tgl, SUM(total_harga) as total, COUNT(*) as jumlah')
            ->groupBy('tgl')->orderBy('tgl')
            ->get();

        return [
            'datasets' => [
                [
                    'label'           => 'Pendapatan (Rp)',
                    'data'            => $data->pluck('total')->toArray(),
                    'borderColor'     => '#6F4E37',
                    'backgroundColor' => 'rgba(111,78,55,0.15)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $data->map(fn($d) => \Carbon\Carbon::parse($d->tgl)->isoFormat('ddd D/M'))->toArray(),
        ];
    }

    protected function getType(): string { return 'line'; }
}