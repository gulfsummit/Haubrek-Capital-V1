<?php

namespace App\Filament\Admin\Resources\MondayWindowResource\Pages;

use App\Filament\Admin\Resources\MondayWindowResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMondayWindow extends EditRecord
{
    protected static string $resource = MondayWindowResource::class;

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
