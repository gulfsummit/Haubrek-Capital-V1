<?php

namespace App\Filament\Admin\Resources\AppResource\Pages;

use App\Filament\Admin\Resources\AppResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApp extends CreateRecord
{
    protected static string $resource = AppResource::class;
}
