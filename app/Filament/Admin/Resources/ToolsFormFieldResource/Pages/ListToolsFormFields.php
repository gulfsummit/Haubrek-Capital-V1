<?php

namespace App\Filament\Admin\Resources\ToolsFormFieldResource\Pages;

use App\Filament\Admin\Resources\ToolsFormFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListToolsFormFields extends ListRecords
{
    protected static string $resource = ToolsFormFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
