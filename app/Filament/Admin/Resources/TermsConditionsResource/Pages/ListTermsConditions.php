<?php

namespace App\Filament\Admin\Resources\TermsConditionsResource\Pages;

use App\Filament\Admin\Resources\TermsConditionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTermsConditions extends ListRecords
{
    protected static string $resource = TermsConditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
