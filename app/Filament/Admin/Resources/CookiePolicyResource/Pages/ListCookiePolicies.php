<?php

namespace App\Filament\Admin\Resources\CookiePolicyResource\Pages;

use App\Filament\Admin\Resources\CookiePolicyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCookiePolicies extends ListRecords
{
    protected static string $resource = CookiePolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
