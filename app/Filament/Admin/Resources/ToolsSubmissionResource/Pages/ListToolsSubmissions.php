<?php

namespace App\Filament\Admin\Resources\ToolsSubmissionResource\Pages;

use App\Filament\Admin\Resources\ToolsSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListToolsSubmissions extends ListRecords
{
    protected static string $resource = ToolsSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
