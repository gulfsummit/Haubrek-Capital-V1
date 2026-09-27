<?php

namespace App\Filament\Admin\Resources\BlogResource\Pages;

use App\Filament\Admin\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    /**
     * After the record and its relationships are saved, sync featured_image
     * into seoMeta.og_image if the og_image was left empty.
     */
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
