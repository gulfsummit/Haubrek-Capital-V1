<?php

namespace App\Filament\Admin\Resources\MondayWindowResource\Pages;

use App\Filament\Admin\Resources\MondayWindowResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMondayWindows extends ListRecords
{
    protected static string $resource = MondayWindowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
