<?php

namespace App\Filament\Admin\Resources\FaqPageResource\Pages;

use App\Filament\Admin\Resources\FaqPageResource;
use Filament\Resources\Pages\EditRecord;

class EditFaqPage extends EditRecord
{
    protected static string $resource = FaqPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
