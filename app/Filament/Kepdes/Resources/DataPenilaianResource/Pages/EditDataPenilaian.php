<?php

namespace App\Filament\Kepdes\Resources\DataPenilaianResource\Pages;

use App\Filament\Kepdes\Resources\DataPenilaianResource;
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
}
