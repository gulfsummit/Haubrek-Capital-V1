<?php

namespace App\Filament\Admin\Resources\ResearchResource\Pages;

use App\Filament\Admin\Resources\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearch extends EditRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Research uses cover_image as its primary image
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['cover_image'])) {
            $data['seoMeta']['og_image'] = $data['cover_image'];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['seoMeta']['og_image']) && ! empty($data['cover_image'])) {
            $data['seoMeta']['og_image'] = $data['cover_image'];
        }

        return $data;
    }
}
