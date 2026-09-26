<?php

namespace App\Filament\Admin\Resources\CareerApplicationResource\Pages;

use App\Filament\Admin\Resources\CareerApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCareerApplication extends ViewRecord
{
    protected static string $resource = CareerApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
