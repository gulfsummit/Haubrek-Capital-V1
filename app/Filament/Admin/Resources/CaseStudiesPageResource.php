<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CaseStudiesPageResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;

class CaseStudiesPageResource extends BasePageCopyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationLabel = 'Case Studies Page';

    protected static ?string $modelLabel = 'Case Studies Page';

    protected static ?string $pluralModelLabel = 'Case Studies Page';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form->schema([
            static::identitySection(),
            Forms\Components\Tabs::make('Case Studies Page Content')
                ->tabs([
                    static::visibilityTab([
                        'hero' => 'Hero Section',
                        'intro' => 'Intro Section',
                        'listing' => 'Listing Section',
                        'cta' => 'CTA Section',
                        'breadcrumb' => 'Breadcrumb Section',
                        'article' => 'Article Content',
                        'sidebar' => 'Sidebar Section',
                        'latest' => 'Latest Topics Section',
                    ]),
                    Forms\Components\Tabs\Tab::make('Case Studies List Page')
                        ->schema([
                            ...static::heroSections(),
                            ...static::introSections(false),
                            static::listLabelsSection('Learn More Label'),
                            ...static::ctaSections(),
                        ])
                        ->visible(fn (callable $get) => $get('slug') === 'case-studies-list'),
                    Forms\Components\Tabs\Tab::make('Case Studies Detail Page')
                        ->schema([
                            static::detailLabelsSection('All Case Studies Label', 'Latest Section Title'),
                            static::serviceLinksSection(),
                        ])
                        ->visible(fn (callable $get) => $get('slug') === 'case-studies-detail'),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaseStudiesPages::route('/'),
            'edit' => Pages\EditCaseStudiesPage::route('/{record}/edit'),
        ];
    }

    protected static function getManagedSlugs(): array
    {
        return ['case-studies-list', 'case-studies-detail'];
    }
}
