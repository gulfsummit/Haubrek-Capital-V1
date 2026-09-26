<?php

namespace App\Filament\Admin\Resources\AppResource\Pages;

use App\Filament\Admin\Resources\AppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApp extends EditRecord
{
    protected static string $resource = AppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
