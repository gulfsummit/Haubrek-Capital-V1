<?php

namespace App\Filament\Admin\Resources\WhitePaperResource\Pages;

use App\Filament\Admin\Resources\WhitePaperResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWhitePaper extends CreateRecord
{
    protected static string $resource = WhitePaperResource::class;

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
