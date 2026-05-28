<?php

namespace App\Filament\Resources\Karyawans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KaryawanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pengguna_id')
                    ->required()
                    ->numeric(),
                TextInput::make('jabatan')
                    ->required(),
                TextInput::make('telepon')
                    ->tel(),
                DatePicker::make('tanggal_masuk')
                    ->required(),
            ]);
    }
}
