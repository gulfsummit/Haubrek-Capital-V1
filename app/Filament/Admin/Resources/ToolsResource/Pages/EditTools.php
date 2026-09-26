<?php

namespace App\Filament\Admin\Resources\ToolsResource\Pages;

use App\Filament\Admin\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTools extends EditRecord
{
    protected static string $resource = ToolsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

