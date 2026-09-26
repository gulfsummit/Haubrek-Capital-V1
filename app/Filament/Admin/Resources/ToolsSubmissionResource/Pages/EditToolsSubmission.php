<?php

namespace App\Filament\Admin\Resources\ToolsSubmissionResource\Pages;

use App\Filament\Admin\Resources\ToolsSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditToolsSubmission extends EditRecord
{
    protected static string $resource = ToolsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
