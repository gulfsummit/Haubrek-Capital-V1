<?php

namespace App\Filament\Admin\Resources\AboutResource\Pages;

use App\Filament\Admin\Resources\AboutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbout extends EditRecord
{
    protected static string $resource = AboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
