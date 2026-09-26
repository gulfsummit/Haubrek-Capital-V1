<?php

namespace App\Filament\Admin\Resources\GovernanceServicesResource\Pages;

use App\Filament\Admin\Resources\GovernanceServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovernanceServices extends ListRecords
{
    protected static string $resource = GovernanceServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
             
        ];
    }
}

