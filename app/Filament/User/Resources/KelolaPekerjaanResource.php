<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\KelolaPekerjaanResource\Pages;
use App\Filament\User\Resources\KelolaPekerjaanResource\RelationManagers;
use App\Models\KategoriPekerjaan;
use App\Models\KelolaPekerjaan;
use App\Models\Pekerjaan;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;

class KelolaPekerjaanResource extends Resource
{
    protected static ?string $model = Pekerjaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('pegawai_id')
                    ->label('Pegawai')
                    ->required()
                    ->default(Auth::user()->pegawai->id)
                    ->readOnly()
                    ->placeholder('Pegawai'),
                TextInput::make('user_id')
                    ->label('User')
                    ->required()
                    ->placeholder('User')
                    ->readOnly()
                    ->default(Auth::id()),
                Select::make('kategori_pekerjaan_id')
                    ->label('Kategori Pekerjaan')
                    ->required()
                    ->options(KategoriPekerjaan::pluck('name', 'id')->toArray())
                    ->placeholder('Kategori Pekerjaan'),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'on_going' => 'On Going',
                        'done' => 'Done',
                    ])
                    ->placeholder('Status'),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->placeholder('Title'),
                FileUpload::make('file')
                    ->label('File')
                    // ->required()
                    ->placeholder('File'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pegawai.name')
                    ->label('Pegawai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori_pekerjaan.name')
                    ->label('Kategori Pekerjaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('file')
                    ->label('File')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Download')
                    ->url(fn (Pekerjaan $pekerjaan) => route('download', $pekerjaan->id))
                    ->visible(fn (Pekerjaan $pekerjaan) => $pekerjaan->file != null)
                
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('pegawai', 'user', 'kategori_pekerjaan')->where('user_id', Auth::id());
    }
}
