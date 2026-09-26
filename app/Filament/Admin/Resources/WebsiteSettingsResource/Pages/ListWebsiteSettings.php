<?php

namespace App\Filament\Admin\Resources\WebsiteSettingsResource\Pages;

use App\Filament\Admin\Resources\WebsiteSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteSettings extends ListRecords
{
    protected static string $resource = WebsiteSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
             
        ];
    }
}
