<?php

namespace App\Filament\User\Resources\KelolaPekerjaanResource\Pages;

use App\Filament\User\Resources\KelolaPekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKelolaPekerjaans extends ManageRecords
{
    protected static string $resource = KelolaPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
