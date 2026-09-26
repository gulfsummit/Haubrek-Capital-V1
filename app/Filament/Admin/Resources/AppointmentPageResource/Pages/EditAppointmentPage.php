<?php

namespace App\Filament\Admin\Resources\AppointmentPageResource\Pages;

use App\Filament\Admin\Resources\AppointmentPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppointmentPage extends EditRecord
{
    protected static string $resource = AppointmentPageResource::class;

    protected function getHeaderActions(): array
    {
        // Disable delete actions to prevent accidental removal of the appointment page.
        return [];
    }
}

