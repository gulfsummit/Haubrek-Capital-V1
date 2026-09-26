<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FaqPageResource\Pages;
use Filament\Forms\Form;

class FaqPageResource extends BasePageCopyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQ Page';

    protected static ?string $modelLabel = 'FAQ Page';

    protected static ?string $pluralModelLabel = 'FAQ Page';

    protected static ?int $navigationSort = 17;

    public static function form(Form $form): Form
    {
        return $form->schema([
            static::identitySection(),
            \Filament\Forms\Components\Tabs::make('FAQ Page Content')
                ->tabs([
                    static::visibilityTab([
                        'hero' => 'Hero Section',
                        'intro' => 'Intro Section',
                        'faq' => 'FAQ Section',
                        'cta' => 'CTA Section',
                    ]),
                    static::heroTab(),
                    static::introTab(includeMainContent: false),
                    static::faqTab(),
                    static::ctaTab(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqPages::route('/'),
            'edit' => Pages\EditFaqPage::route('/{record}/edit'),
        ];
    }

    protected static function getManagedSlugs(): array
    {
        return ['faq'];
    }
}
