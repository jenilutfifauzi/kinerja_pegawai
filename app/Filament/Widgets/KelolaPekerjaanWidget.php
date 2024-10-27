<?php

namespace App\Filament\Widgets;

use App\Models\Pekerjaan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class KelolaPekerjaanWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected $label = 'Detail Pekerjaan Pegawai';
    public function table(Table $table): Table
    {
        $currentMonth = now()->startOfMonth();
        return $table
            ->query(
                Pekerjaan::query()
                ->whereMonth('created_at', $currentMonth->month)
            )
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
            ]);
    }
}
