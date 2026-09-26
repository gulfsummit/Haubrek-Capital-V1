<?php

namespace App\Filament\Admin\Resources\CaseStudiesPageResource\Pages;

use App\Filament\Admin\Resources\CaseStudiesPageResource;
use Filament\Resources\Pages\ListRecords;

class ListCaseStudiesPages extends ListRecords
{
    protected static string $resource = CaseStudiesPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
