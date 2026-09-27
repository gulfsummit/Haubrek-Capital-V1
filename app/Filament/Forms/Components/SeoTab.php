<?php

namespace App\Filament\Forms\Components;

use Filament\Forms;

class SeoTab
{
    /**
     * @param  string       $relationship  The Eloquent relationship name (default: 'seoMeta')
     * @param  string|null  $urlPrefix     The base URL path prefix used to auto-generate the
     *                                     canonical URL (e.g. '/blog/', '/resources-center/white-papers/').
     *                                     When provided, the canonical field is pre-filled with
     *                                     APP_URL + urlPrefix + slug on create, and shown as a
     *                                     read-only hint when the field is empty on edit.
     */
    public static function make(string $relationship = 'seoMeta', ?string $urlPrefix = null): Forms\Components\Tabs\Tab
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $prefix  = $urlPrefix ? '/' . trim($urlPrefix, '/') . '/' : null;

        return Forms\Components\Tabs\Tab::make('SEO')
            ->schema([
                Forms\Components\Section::make('SEO Metadata')
                    ->description('Manage meta tags for search engines and social sharing. Recommended: Meta title up to 60 characters, description up to 160 characters.')
                    ->relationship($relationship)
                    ->schema([
                        Forms\Components\TextInput::make('meta_title_en')
                            ->label('Meta Title (English)')
                            ->maxLength(255)
                            ->helperText('Recommended up to 60 characters.'),
                        Forms\Components\TextInput::make('meta_title_ar')
                            ->label('Meta Title (Arabic)')
                            ->maxLength(255)
                            ->helperText('موصى به حتى 60 حرفاً.'),
                        Forms\Components\Textarea::make('meta_description_en')
                            ->label('Meta Description (English)')
                            ->rows(3)
                            ->helperText('Recommended up to 160 characters.'),
                        Forms\Components\Textarea::make('meta_description_ar')
                            ->label('Meta Description (Arabic)')
                            ->rows(3)
                            ->helperText('موصى به حتى 160 حرفاً.'),
                        Forms\Components\TextInput::make('h1_en')
                            ->label('Primary H1 (English)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('h1_ar')
                            ->label('Primary H1 (Arabic)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('meta_keywords_en')
                            ->label('Meta Keywords (English)')
                            ->helperText('Optional: comma-separated keywords.')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('meta_keywords_ar')
                            ->label('Meta Keywords (Arabic)')
                            ->helperText('اختياري: كلمات مفصولة بفاصلة.')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('canonical_url')
                            ->label('Canonical URL')
                            ->url()
                            ->helperText(
                                $prefix
                                    ? 'Auto-generated from the slug (' . $baseUrl . $prefix . '{slug}). Override only if needed.'
                                    : 'Leave empty to use the default page URL.'
                            )
                            ->placeholder($prefix ? $baseUrl . $prefix . 'your-slug' : null),
                        Forms\Components\TextInput::make('og_title_en')
                            ->label('OG Title (English)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('og_title_ar')
                            ->label('OG Title (Arabic)')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('og_description_en')
                            ->label('OG Description (English)')
                            ->rows(3),
                        Forms\Components\Textarea::make('og_description_ar')
                            ->label('OG Description (Arabic)')
                            ->rows(3),
                        Forms\Components\FileUpload::make('og_image')
                            ->label('OG Image')
                            ->image()
                            ->directory('seo/og')
                            ->imageEditor()
                            ->helperText('Recommended 1200x630px for social sharing. Auto-filled from the main image if left empty.'),
                        Forms\Components\TextInput::make('og_image_alt_en')
                            ->label('OG Image Alt Text (English)')
                            ->maxLength(255)
                            ->helperText('Provide a descriptive alt text for accessibility and SEO.'),
                        Forms\Components\TextInput::make('og_image_alt_ar')
                            ->label('OG Image Alt Text (Arabic)')
                            ->maxLength(255)
                            ->helperText('وصف بديل للصورة لأغراض الوصول ومحركات البحث.'),
                    ])
                    ->columns(2),
            ]);
    }
}
