<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPenilaianResource\Pages;
use App\Filament\Resources\DataPenilaianResource\RelationManagers;
use App\Filament\Resources\KelolaPekerjaanResource\RelationManagers\KelolaPekerjaanRelationManager;
use App\Models\DataPenilaian;
use App\Models\Pegawai;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataPenilaianResource extends Resource
{
    protected static ?string $model = DataPenilaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pegawai_id')
                    ->label('Pegawai ID')
                    ->options(
                        Pegawai::pluck('name', 'id')
                    )
                    ->required(),
                TextInput::make('jumlah_hadir')
                    ->label('Jumlah Hadir')
                    ->required(),
                TextInput::make('jumlah_izin')
                    ->label('Jumlah Izin')
                    ->required(),
                TextInput::make('jumlah_sakit')
                    ->label('Jumlah Sakit')
                    ->required(),
                DatePicker::make('periode')
                    ->label('Periode')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        // total nilai diambil dari nilai_total_hadir + nilai_total_izin + nilai_total_sakit

        return $table
            ->columns([
                TextColumn::make('pegawai.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_hadir')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_izin')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_sakit')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total_pekerjaan_harian')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total_pekerjaan_lembur')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total_hadir')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total_izin')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total_sakit')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_total')
                    ->formatStateUsing(function (DataPenilaian $record) {
                        return $record->nilai_total_hadir + $record->nilai_total_izin + $record->nilai_total_sakit + $record->nilai_total_pekerjaan_harian + $record->nilai_total_pekerjaan_lembur;
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('periode')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ManageDataPenilaians::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('pegawai');
    }

   
}
