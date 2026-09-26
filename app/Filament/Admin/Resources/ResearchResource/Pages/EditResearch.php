<?php

namespace App\Filament\Admin\Resources\ResearchResource\Pages;

use App\Filament\Admin\Resources\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearch extends EditRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
