<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BlogPageResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;

class BlogPageResource extends BasePageCopyResource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Blog Page';

    protected static ?string $modelLabel = 'Blog Page';

    protected static ?string $pluralModelLabel = 'Blog Page';

    protected static ?int $navigationSort = 19;

    public static function form(Form $form): Form
    {
        return $form->schema([
            static::identitySection(),
            Forms\Components\Tabs::make('Blog Page Content')
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
                    Forms\Components\Tabs\Tab::make('Blog List Page')
                        ->schema([
                            ...static::heroSections(),
                            ...static::introSections(false),
                            static::listLabelsSection(),
                            ...static::ctaSections(),
                        ])
                        ->visible(fn (callable $get) => $get('slug') === 'blog-list'),
                    Forms\Components\Tabs\Tab::make('Blog Detail Page')
                        ->schema([
                            static::detailLabelsSection('All Posts Label', 'Latest Topics Title'),
                            static::serviceLinksSection(),
                        ])
                        ->visible(fn (callable $get) => $get('slug') === 'blog-detail'),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPages::route('/'),
            'edit' => Pages\EditBlogPage::route('/{record}/edit'),
        ];
    }

    protected static function getManagedSlugs(): array
    {
        return ['blog-list', 'blog-detail'];
    }
}
