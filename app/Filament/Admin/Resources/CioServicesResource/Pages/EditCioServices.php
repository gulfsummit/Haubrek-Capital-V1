<?php

namespace App\Filament\Admin\Resources\CioServicesResource\Pages;

use App\Filament\Admin\Resources\CioServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCioServices extends EditRecord
{
    protected static string $resource = CioServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
