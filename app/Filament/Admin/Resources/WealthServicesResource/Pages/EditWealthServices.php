<?php

namespace App\Filament\Admin\Resources\WealthServicesResource\Pages;

use App\Filament\Admin\Resources\WealthServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWealthServices extends EditRecord
{
    protected static string $resource = WealthServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
