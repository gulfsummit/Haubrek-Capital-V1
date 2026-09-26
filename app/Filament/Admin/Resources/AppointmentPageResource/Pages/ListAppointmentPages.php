<?php

namespace App\Filament\Admin\Resources\AppointmentPageResource\Pages;

use App\Filament\Admin\Resources\AppointmentPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppointmentPages extends ListRecords
{
    protected static string $resource = AppointmentPageResource::class;

    protected static ?string $title = 'Appointment Page';

    protected function getHeaderActions(): array
    {
        // Disable create action since this page should have a single record.
        return [];
    }
}

