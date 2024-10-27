<?php

namespace App\Filament\Resources\DataPenilaianResource\Pages;

use App\Filament\Resources\DataPenilaianResource;
use App\Filament\Resources\DataPenilaianResource\RelationManagers\KelolaPekerjaansRelationManager;
use App\Filament\Widgets\KelolaPekerjaanWidget;
use App\Imports\ImportDataPenilaians;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ManageDataPenilaians extends ManageRecords
{
    protected static string $resource = DataPenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        return view('filament.custom.admin.upload-excel', compact('data'));
    }

    public $file = '';

    public function save()
    {

        if ($this->file != '') {
            Excel::import(new ImportDataPenilaians, $this->file);
        }
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
