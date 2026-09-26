<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;

class SectionVisibility
{
    /**
     * @param  array<string, string>  $sections
     */
    public static function tab(array $sections, string $label = 'Section Visibility'): Tabs\Tab
    {
        return Tabs\Tab::make($label)
            ->schema([
                static::section($sections),
            ]);
    }

    /**
     * @param  array<string, string>  $sections
     */
    public static function section(array $sections, string $label = 'Visibility Controls'): Section
    {
        $schema = [];

        foreach ($sections as $key => $sectionLabel) {
            $schema[] = Toggle::make("section_visibility.{$key}")
                ->label("Show {$sectionLabel}")
                ->default(true)
                ->inline(false);
        }

        return Section::make($label)
            ->schema($schema)
            ->columns(2);
    }
}
