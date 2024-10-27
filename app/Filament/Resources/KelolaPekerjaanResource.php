<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelolaPekerjaanResource\Pages;
use App\Filament\Resources\KelolaPekerjaanResource\RelationManagers;
use App\Models\KelolaPekerjaan;
use App\Models\Pekerjaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelolaPekerjaanResource extends Resource
{
    protected static ?string $model = Pekerjaan::class;
    protected static ?string $pluralModelLabel = 'Kelola Pekerjaan Pegawai';

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai_id')
                    ->label('Pegawai ID'),
                Tables\Columns\TextColumn::make('pegawai.name')
                    ->label('Pegawai'),
                Tables\Columns\TextColumn::make('kategori_pekerjaan.name')
                    ->label('Kategori Pekerjaan'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Pekerjaan'),
                Tables\Columns\IconColumn::make('file')
                    ->label('Berkas')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('blue')
                    ->url(fn (Pekerjaan $pekerjaan) => route('download', $pekerjaan->id))
                    ,
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'done' => 'Done',
                        'on_going' => 'On Going',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageKelolaPekerjaans::route('/'),
        ];
    }
}
