<?php

namespace App\Filament\Admin\Resources\ResearchResource\Pages;

use App\Filament\Admin\Resources\ResearchResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResearch extends CreateRecord
{
    protected static string $resource = ResearchResource::class;

    // Research uses cover_image as its primary image
    protected function afterCreate(): void
    {
        $record = $this->record;

        if (blank($record->cover_image)) {
            return;
        }

        $seo = $record->seoMeta()->firstOrCreate([]);

        if (blank($seo->og_image)) {
            $seo->og_image = $record->cover_image;
            $seo->save();
        }
    }
}
