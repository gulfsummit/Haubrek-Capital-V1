<?php

namespace App\Filament\Admin\Resources\CioFlashResource\Pages;

use App\Filament\Admin\Resources\CioFlashResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCioFlash extends CreateRecord
{
    protected static string $resource = CioFlashResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }
}
