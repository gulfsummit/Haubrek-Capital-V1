<?php

namespace App\Filament\Admin\Resources\InvestmentServicesResource\Pages;

use App\Filament\Admin\Resources\InvestmentServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvestmentServices extends ListRecords
{
    protected static string $resource = InvestmentServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
