<?php

namespace App\Filament\Admin\Resources\CioFlashResource\Pages;

use App\Filament\Admin\Resources\CioFlashResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCioFlash extends ListRecords
{
    protected static string $resource = CioFlashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
