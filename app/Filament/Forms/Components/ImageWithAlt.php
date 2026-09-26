<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class ImageWithAlt
{
    /**
     * @param  callable|null  $configureFile  Receives the FileUpload instance and must return it.
     */
    public static function make(string $name, string $label, ?callable $configureFile = null): array
    {
        $file = FileUpload::make($name)
            ->label($label)
            ->image()
            ->imageEditor();

        if ($configureFile) {
            $file = $configureFile($file);
        }

        $altEn = TextInput::make("{$name}_alt_en")
            ->label("{$label} Alt (English)")
            ->maxLength(255);

        $altAr = TextInput::make("{$name}_alt_ar")
            ->label("{$label} Alt (Arabic)")
            ->maxLength(255);

        return [$file, $altEn, $altAr];
    }
}

