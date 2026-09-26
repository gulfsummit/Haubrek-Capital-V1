<?php

namespace App\Filament\Admin\Resources\HomeResource\Pages;

use App\Filament\Admin\Resources\HomeResource;
use App\Models\Home;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHome extends EditRecord
{
    protected static string $resource = HomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['hero_slides'] = HomeResource::heroSlidesForForm($this->record);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return HomeResource::syncLegacyHeroSlides($data);
    }
}
