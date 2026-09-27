<?php

namespace App\Filament\Admin\Resources\MondayWindowResource\Pages;

use App\Filament\Admin\Resources\MondayWindowResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMondayWindow extends CreateRecord
{
    protected static string $resource = MondayWindowResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }
}
