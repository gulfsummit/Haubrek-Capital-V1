<?php

namespace App\Filament\Admin\Resources\HomeResource\Pages;

use App\Filament\Admin\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomes extends ListRecords
{
    protected static string $resource = HomeResource::class;

    protected static ?string $title = 'Home';

    protected function getHeaderActions(): array
    {
        return [
             
        ];
    }
}
