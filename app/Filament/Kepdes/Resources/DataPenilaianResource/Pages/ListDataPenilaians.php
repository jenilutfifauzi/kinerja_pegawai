<?php

namespace App\Filament\Kepdes\Resources\DataPenilaianResource\Pages;

use App\Filament\Kepdes\Resources\DataPenilaianResource;
use App\Filament\Widgets\KelolaPekerjaanWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataPenilaians extends ListRecords
{
    protected static string $resource = DataPenilaianResource::class;
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            KelolaPekerjaanWidget::make(),
        ];
    }
}
