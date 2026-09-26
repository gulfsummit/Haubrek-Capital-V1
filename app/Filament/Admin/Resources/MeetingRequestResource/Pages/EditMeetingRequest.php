<?php

namespace App\Filament\Admin\Resources\MeetingRequestResource\Pages;

use App\Filament\Admin\Resources\MeetingRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeetingRequest extends EditRecord
{
    protected static string $resource = MeetingRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
