<?php

namespace App\Filament\Admin\Resources\CaseStudiesPageResource\Pages;

use App\Filament\Admin\Resources\CaseStudiesPageResource;
use Filament\Resources\Pages\EditRecord;

class EditCaseStudiesPage extends EditRecord
{
    protected static string $resource = CaseStudiesPageResource::class;

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
