<?php

namespace App\Filament\Resources\Penggunas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PenggunaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('kata_sandi')
                    ->required(),
                Select::make('peran')
                    ->options(['admin' => 'Admin', 'kasir' => 'Kasir', 'pelanggan' => 'Pelanggan'])
                    ->default('pelanggan')
                    ->required(),
            ]);
    }
}
