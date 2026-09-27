<?php

namespace App\Filament\Admin\Resources\WhitePaperResource\Pages;

use App\Filament\Admin\Resources\WhitePaperResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWhitePaper extends CreateRecord
{
    protected static string $resource = WhitePaperResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }
}
