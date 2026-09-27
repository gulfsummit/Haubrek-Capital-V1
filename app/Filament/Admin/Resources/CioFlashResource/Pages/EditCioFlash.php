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

    protected function afterSave(): void
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
