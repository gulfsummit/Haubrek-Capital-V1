<?php

namespace App\Filament\Admin\Resources\RequestMeetingPageResource\Pages;

use App\Filament\Admin\Resources\RequestMeetingPageResource;
use Filament\Resources\Pages\ListRecords;

class ListRequestMeetingPages extends ListRecords
{
    protected static string $resource = RequestMeetingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
