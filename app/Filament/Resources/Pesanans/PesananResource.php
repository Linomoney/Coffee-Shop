<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Riwayat Pesanan';
    protected static string | \UnitEnum | null $navigationGroup = 'Laporan';
    protected static ?string $modelLabel = 'Pesanan';
    protected static ?string $pluralModelLabel = 'Pesanan';
    protected static ?int    $navigationSort  = 1;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pesanan')->label('Kode')->searchable()->copyable()->badge()->color('primary'),
                TextColumn::make('nomor_meja')->label('Meja')->searchable(),
                TextColumn::make('pengguna.nama')->label('Pelanggan')->searchable(),
                TextColumn::make('karyawan.pengguna.nama')->label('Kasir'),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn(string $state) => match($state) {
                        'selesai'  => 'success',
                        'proses'   => 'warning',
                        'menunggu' => 'info',
                        'batal'    => 'danger',
                    }),
                TextColumn::make('cara_bayar')->label('Bayar')->badge()->color('gray'),
                TextColumn::make('total_harga')->label('Total')
                    ->money('IDR')->sortable()
                    ->color('primary')->weight('bold'),
                TextColumn::make('dipesan_pada')->label('Waktu')
                    ->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->defaultSort('dipesan_pada', 'desc')
            ->filters([
                SelectFilter::make('status')->label('Status')
                    ->options(['menunggu'=>'Menunggu','proses'=>'Proses','selesai'=>'Selesai','batal'=>'Batal']),
                SelectFilter::make('cara_bayar')->label('Cara Bayar')
                    ->options(['tunai'=>'Tunai','qris'=>'QRIS','transfer'=>'Transfer']),
                Filter::make('hari_ini')->label('Hari Ini')
                    ->query(fn(Builder $q) => $q->whereDate('dipesan_pada', today())),
            ])
            ->striped()
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function form(Schema $schema): Schema
    {
    return $schema->schema([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'view'  => Pages\ViewPesanan::route('/{record}'),
        ];
    }

    public static function canCreate(): bool { return false; }
}