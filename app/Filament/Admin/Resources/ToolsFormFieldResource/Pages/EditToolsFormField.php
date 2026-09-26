<?php

namespace App\Filament\Admin\Resources\ToolsFormFieldResource\Pages;

use App\Filament\Admin\Resources\ToolsFormFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditToolsFormField extends EditRecord
{
    protected static string $resource = ToolsFormFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
