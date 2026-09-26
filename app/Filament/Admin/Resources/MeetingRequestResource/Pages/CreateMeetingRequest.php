<?php

namespace App\Filament\Admin\Resources\MeetingRequestResource\Pages;

use App\Filament\Admin\Resources\MeetingRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMeetingRequest extends CreateRecord
{
    protected static string $resource = MeetingRequestResource::class;
}
