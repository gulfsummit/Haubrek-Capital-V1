<?php

namespace App\Filament\Admin\Resources\CioFlashResource\Pages;

use App\Filament\Admin\Resources\CioFlashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCioFlash extends EditRecord
{
    protected static string $resource = CioFlashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['featured_image'])) {
            $data['seoMeta']['og_image'] = $data['featured_image'];
        }

        return $data;
    }
}
