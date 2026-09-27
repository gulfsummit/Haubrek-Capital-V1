<?php

namespace App\Filament\Admin\Resources\CioFlashResource\Pages;

use App\Filament\Admin\Resources\CioFlashResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCioFlash extends CreateRecord
{
    protected static string $resource = CioFlashResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        if (blank($record->featured_image)) {
            return;
        }

        $seo = $record->seoMeta()->firstOrCreate([]);

        if (blank($seo->og_image)) {
            $seo->og_image = $record->featured_image;
            $seo->save();
        }
    }
}
