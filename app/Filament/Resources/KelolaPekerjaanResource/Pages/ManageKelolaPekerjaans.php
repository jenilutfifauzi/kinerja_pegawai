<?php

namespace App\Filament\Resources\KelolaPekerjaanResource\Pages;

use App\Filament\Resources\KelolaPekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKelolaPekerjaans extends ManageRecords
{
    protected static string $resource = KelolaPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
