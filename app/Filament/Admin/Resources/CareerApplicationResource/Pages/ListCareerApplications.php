<?php

namespace App\Filament\Admin\Resources\CareerApplicationResource\Pages;

use App\Filament\Admin\Resources\CareerApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareerApplications extends ListRecords
{
    protected static string $resource = CareerApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action - applications are submitted through the website
        ];
    }
}
