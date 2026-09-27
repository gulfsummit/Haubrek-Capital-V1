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
    protected function afterSave(): void
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
