<?php
namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Schemas\Schema;
use Filament\Forms\Components\{TextInput, Textarea, Select, Toggle, FileUpload, Section};
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn, ImageColumn, IconColumn, ToggleColumn};
use Filament\Tables\Filters\SelectFilter;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationLabel = 'Kelola Menu';
    protected static string | \UnitEnum | null $navigationGroup = 'Menu';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel = 'Menu';
    protected static ?string $pluralModelLabel = 'Menu'; // ← ini yang penting

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Menu')->schema([
                TextInput::make('nama')->label('Nama Menu')->required()->maxLength(100),
                Select::make('kategori_id')->label('Kategori')
                    ->relationship('kategori', 'nama')->required()->searchable(),
                Textarea::make('keterangan')->label('Deskripsi')->rows(3),
                TextInput::make('harga')->label('Harga (Rp)')->required()->numeric()->prefix('Rp'),
                Toggle::make('tersedia')->label('Tersedia')->default(true)->inline(false),
            ])->columns(2),
            Section::make('Gambar Produk')->schema([
                FileUpload::make('gambar')->label('Upload Gambar')
                    ->image()->directory('menu')->imagePreviewHeight('200')
                    ->maxSize(2048)->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')->label('Foto')->square()->size(56)->defaultImageUrl(fn() => null),
                TextColumn::make('nama')->label('Nama Menu')->searchable()->weight('bold'),
                TextColumn::make('kategori.nama')->label('Kategori')->badge()->color('warning'),
                TextColumn::make('harga')->label('Harga')->money('IDR')->sortable()->color('primary'),
                ToggleColumn::make('tersedia')->label('Tersedia'),
            ])
            ->filters([
                SelectFilter::make('kategori_id')->label('Kategori')->relationship('kategori', 'nama'),
                SelectFilter::make('tersedia')->label('Status')
                    ->options([1 => 'Tersedia', 0 => 'Habis']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->peran === 'admin';
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit'   => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}