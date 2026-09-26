<?php

namespace App\Filament\Admin\Resources\GovernanceServicesResource\Pages;

use App\Filament\Admin\Resources\GovernanceServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGovernanceServices extends EditRecord
{
    protected static string $resource = GovernanceServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

