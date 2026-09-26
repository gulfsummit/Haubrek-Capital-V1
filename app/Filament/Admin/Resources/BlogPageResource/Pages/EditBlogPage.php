<?php

namespace App\Filament\Admin\Resources\BlogPageResource\Pages;

use App\Filament\Admin\Resources\BlogPageResource;
use Filament\Resources\Pages\EditRecord;

class EditBlogPage extends EditRecord
{
    protected static string $resource = BlogPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        foreach ($this->record->getAttributes() as $key => $value) {
            if (array_key_exists($key, $data) && $data[$key] === null) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
