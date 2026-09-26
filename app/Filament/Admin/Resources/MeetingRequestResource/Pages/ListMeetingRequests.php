<?php

namespace App\Filament\Admin\Resources\MeetingRequestResource\Pages;

use App\Filament\Admin\Resources\MeetingRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeetingRequests extends ListRecords
{
    protected static string $resource = MeetingRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
