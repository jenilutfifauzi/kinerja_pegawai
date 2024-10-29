<?php

namespace App\Filament\Kepsek\Resources;

use App\Filament\Kepsek\Resources\DataPenilaianResource\Pages;
use App\Filament\Kepsek\Resources\DataPenilaianResource\RelationManagers;
use App\Models\DataPenilaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Pegawai;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;



class DataPenilaianResource extends Resource
{
    protected static ?string $model = DataPenilaian::class;

    protected static ?string $pluralModelLabel = 'Data Penilaian';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            // Tables\Actions\CreateAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPenilaians::route('/'),
            'create' => Pages\CreateDataPenilaian::route('/create'),
            'edit' => Pages\EditDataPenilaian::route('/{record}/edit'),
        ];
    }
}
