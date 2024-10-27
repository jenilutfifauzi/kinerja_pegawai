<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPenilaianResource\Pages;
use App\Filament\Resources\DataPenilaianResource\RelationManagers;
use App\Filament\Resources\DataPenilaianResource\RelationManagers\KelolaPekerjaansRelationManager;
use App\Filament\Widgets\KelolaPekerjaanWidget;
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
use Filament\Tables\Filters\Filter;
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
                Select::make('nilai_bobot_pekerjaan_harian')
                    ->label('Nilai Bobot Pekerjaan Harian')
                    ->options([
                        '5' => 'Baik Sekali',
                        '4' => 'Baik',
                        '3' => 'Cukup',
                        '2' => 'Agak Kurang',
                        '1' => 'Kurang',
                    ])
                    ->required(),
                    Select::make('nilai_bobot_pekerjaan_lembur')
                    ->label('Nilai Bobot Pekerjaan Lembur')
                    ->options([
                        '5' => 'Baik Sekali',
                        '4' => 'Baik',
                        '3' => 'Cukup',
                        '2' => 'Agak Kurang',
                        '1' => 'Kurang',
                    ])
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
                Filter::make('periode')
                ->form([
                    Forms\Components\DatePicker::make('created_from')
                        ->label('Periode dari'),
                    Forms\Components\DatePicker::make('created_until')
                        ->label('Periode sampai'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('periode', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('periode', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->using(function (DataPenilaian $record, array $data): DataPenilaian {

                    $nilai_total_pekerjaan_harian = $data['nilai_bobot_pekerjaan_harian'] * 10;
                    $nilai_total_pekerjaan_lembur = $data['nilai_bobot_pekerjaan_lembur'] * 10;
                    $data['nilai_total_pekerjaan_harian'] = $nilai_total_pekerjaan_harian;
                    $data['nilai_total_pekerjaan_lembur'] = $nilai_total_pekerjaan_lembur;
                    $record->update($data);
             
                    return $record;
                })
            
            ,
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

    public static function getRelations(): array
    {
        return [
            KelolaPekerjaansRelationManager::class,
        ];
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
