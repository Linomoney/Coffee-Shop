<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pengguna_id')
                    ->required()
                    ->numeric(),
                TextInput::make('karyawan_id')
                    ->numeric(),
                TextInput::make('kode_pesanan')
                    ->required(),
                Select::make('status')
                    ->options(['menunggu' => 'Menunggu', 'proses' => 'Proses', 'selesai' => 'Selesai', 'batal' => 'Batal'])
                    ->default('menunggu')
                    ->required(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('cara_bayar')
                    ->options(['tunai' => 'Tunai', 'qris' => 'Qris', 'transfer' => 'Transfer'])
                    ->default('tunai')
                    ->required(),
                DateTimePicker::make('dipesan_pada')
                    ->required(),
            ]);
    }
}
