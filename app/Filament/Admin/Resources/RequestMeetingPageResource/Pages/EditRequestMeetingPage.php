<?php

namespace App\Filament\Admin\Resources\RequestMeetingPageResource\Pages;

use App\Filament\Admin\Resources\RequestMeetingPageResource;
use Filament\Resources\Pages\EditRecord;

class EditRequestMeetingPage extends EditRecord
{
    protected static string $resource = RequestMeetingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
