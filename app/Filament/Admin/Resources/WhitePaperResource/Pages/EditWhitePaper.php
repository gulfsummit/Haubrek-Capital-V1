<?php

namespace App\Filament\Admin\Resources\WhitePaperResource\Pages;

use App\Filament\Admin\Resources\WhitePaperResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhitePaper extends EditRecord
{
    protected static string $resource = WhitePaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
