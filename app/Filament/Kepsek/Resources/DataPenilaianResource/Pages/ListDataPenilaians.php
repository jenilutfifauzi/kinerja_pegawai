<?php

namespace App\Filament\Kepsek\Resources\DataPenilaianResource\Pages;

use App\Filament\Kepsek\Resources\DataPenilaianResource;
use App\Filament\Resources\DataPenilaianResource\RelationManagers\KelolaPekerjaansRelationManager;
use App\Filament\Widgets\KelolaPekerjaanWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataPenilaians extends ListRecords
{
    protected static string $resource = DataPenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            KelolaPekerjaansRelationManager::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            KelolaPekerjaanWidget::make(),
        ];
    }
}
