<?php

namespace App\Filament\Admin\Resources\ResourceCenterResource\Pages;

use App\Filament\Admin\Resources\ResourceCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResourceCenters extends ListRecords
{
    protected static string $resource = ResourceCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

