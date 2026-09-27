<?php

namespace App\Filament\Admin\Resources\ResearchResource\Pages;

use App\Filament\Admin\Resources\ResearchResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResearch extends CreateRecord
{
    protected static string $resource = ResearchResource::class;

    // Research uses cover_image as its primary image
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['cover_image'])) {
            $data['seoMeta']['og_image'] = $data['cover_image'];
        }

        return $data;
    }
}
