<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPekerjaanResource\Pages;
use App\Filament\Resources\KategoriPekerjaanResource\RelationManagers;
use App\Models\KategoriPekerjaan;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriPekerjaanResource extends Resource
{
    protected static ?string $model = KategoriPekerjaan::class;

    protected static ?string $pluralModelLabel = 'Kategori Pekerjaan';
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Kategori Pekerjaan')
                    ->required()
                    ->placeholder('Kategori Pekerjaan'),
                TextInput::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Deskripsi Kategori Pekerjaan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori Pekerjaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKategoriPekerjaans::route('/'),
        ];
    }
}
