<?php

namespace App\Filament\Kepsek\Resources\DataPenilaianResource\Pages;

use App\Filament\Kepsek\Resources\DataPenilaianResource;
use App\Filament\Resources\DataPenilaianResource\RelationManagers\KelolaPekerjaansRelationManager;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPenilaian extends EditRecord
{
    protected static string $resource = DataPenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            KelolaPekerjaansRelationManager::class,
            
        ];
    }
}
