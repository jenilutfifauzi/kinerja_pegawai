<?php

namespace App\Filament\Resources\KategoriPekerjaanResource\Pages;

use App\Filament\Resources\KategoriPekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriPekerjaans extends ManageRecords
{
    protected static string $resource = KategoriPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
