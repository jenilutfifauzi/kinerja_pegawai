<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\Pegawai;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $pluralModelLabel = 'Pegawai';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Pegawai')
                    ->required()
                    ->placeholder('John Doe'),
                TextInput::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->placeholder('Jl. Jend. Sudirman No. 1'),
                TextInput::make('no_telp')
                    ->label('No. Telp')
                    ->required()
                    ->placeholder('081234567890'),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('Email address'),
                Select::make('user_id')
                    ->label('User')
                    ->searchable()
                    ->options(User::pluck('name', 'id')->toArray()),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pegawai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_telp')
                    ->label('No. Telp')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
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
            'index' => Pages\ManagePegawais::route('/'),
        ];
    }
}
