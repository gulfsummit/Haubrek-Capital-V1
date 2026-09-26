<?php

namespace App\Filament\Admin\Resources\ToolsResource\Pages;

use App\Filament\Admin\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTools extends ListRecords
{
    protected static string $resource = ToolsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action since we don't allow creating new pages
        ];
    }
}

