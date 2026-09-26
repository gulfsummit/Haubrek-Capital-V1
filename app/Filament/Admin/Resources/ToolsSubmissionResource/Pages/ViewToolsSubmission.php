<?php

namespace App\Filament\Admin\Resources\ToolsSubmissionResource\Pages;

use App\Filament\Admin\Resources\ToolsSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewToolsSubmission extends ViewRecord
{
    protected static string $resource = ToolsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

