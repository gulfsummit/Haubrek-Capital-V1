<?php

namespace App\Filament\Admin\Resources\BlogResource\Pages;

use App\Filament\Admin\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    /**
     * Before saving a new record, copy featured_image → seoMeta.og_image
     * if the OG image was left empty.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }
}
