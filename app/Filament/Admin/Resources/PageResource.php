<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Support\SectionVisibility;
use App\Filament\Admin\Resources\PageResource\Pages;
use App\Forms\Components\CustomRichEditor;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PageResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationLabel = 'Page Content';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 99;

    protected static ?string $modelLabel = 'Page Content';

    protected static ?string $pluralModelLabel = 'Page Content';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Page Identity')
                ->schema([
                    Forms\Components\Select::make('slug')
                        ->label('Page Key')
                        ->options(self::getSlugOptions())
                        ->required()
                        ->searchable()
                        ->unique(ignoreRecord: true),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])
                ->columns(2),

            Forms\Components\Tabs::make('Page Content')
                ->tabs([
                    SectionVisibility::tab([
                        'hero' => 'Hero Section',
                        'intro' => 'Intro Section',
                        'listing' => 'Listing Section',
                        'cta' => 'CTA Section',
                        'breadcrumb' => 'Breadcrumb Section',
                        'article' => 'Article Content',
                        'sidebar' => 'Sidebar Section',
                        'latest' => 'Latest Section',
                        'faq' => 'FAQ Section',
                        'form' => 'Form Section',
                    ]),
                    Forms\Components\Tabs\Tab::make('Hero & Intro')
                        ->schema([
                            Forms\Components\Section::make('Hero Images')
                                ->schema([
                                    Forms\Components\FileUpload::make('hero_desktop_image')
                                        ->image()
                                        ->directory('pages/hero')
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('hero_desktop_image_alt_en')
                                        ->label('Desktop Image Alt (English)'),
                                    Forms\Components\TextInput::make('hero_desktop_image_alt_ar')
                                        ->label('Desktop Image Alt (Arabic)'),
                                    Forms\Components\FileUpload::make('hero_mobile_image')
                                        ->image()
                                        ->directory('pages/hero')
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('hero_mobile_image_alt_en')
                                        ->label('Mobile Image Alt (English)'),
                                    Forms\Components\TextInput::make('hero_mobile_image_alt_ar')
                                        ->label('Mobile Image Alt (Arabic)'),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('Hero Copy')
                                ->schema([
                                    Forms\Components\TextInput::make('title_en')
                                        ->label('Hero Title (English)'),
                                    Forms\Components\TextInput::make('title_ar')
                                        ->label('Hero Title (Arabic)'),
                                    CustomRichEditor::make('subtitle_en')
                                        ->label('Hero Subtitle (English)')
                                        ->simple(),
                                    CustomRichEditor::make('subtitle_ar')
                                        ->label('Hero Subtitle (Arabic)')
                                        ->simple(),
                                    Forms\Components\TextInput::make('primary_button_text_en')
                                        ->label('Primary Button Text (English)'),
                                    Forms\Components\TextInput::make('primary_button_text_ar')
                                        ->label('Primary Button Text (Arabic)'),
                                    Forms\Components\TextInput::make('primary_button_url')
                                        ->label('Primary Button URL')
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('secondary_button_text_en')
                                        ->label('Secondary Button Text (English)'),
                                    Forms\Components\TextInput::make('secondary_button_text_ar')
                                        ->label('Secondary Button Text (Arabic)'),
                                    Forms\Components\TextInput::make('secondary_button_url')
                                        ->label('Secondary Button URL')
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('Section Intro')
                                ->schema([
                                    Forms\Components\FileUpload::make('body_background_image')
                                        ->image()
                                        ->directory('pages/body')
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('body_background_image_alt_en')
                                        ->label('Section Background Alt (English)'),
                                    Forms\Components\TextInput::make('body_background_image_alt_ar')
                                        ->label('Section Background Alt (Arabic)'),
                                    Forms\Components\TextInput::make('intro_title_en')
                                        ->label('Intro Title (English)'),
                                    Forms\Components\TextInput::make('intro_title_ar')
                                        ->label('Intro Title (Arabic)'),
                                    CustomRichEditor::make('intro_subtitle_en')
                                        ->label('Intro Subtitle (English)')
                                        ->simple(),
                                    CustomRichEditor::make('intro_subtitle_ar')
                                        ->label('Intro Subtitle (Arabic)')
                                        ->simple(),
                                    CustomRichEditor::make('content_en')
                                        ->label('Main Content (English)')
                                        ->simple()
                                        ->columnSpanFull(),
                                    CustomRichEditor::make('content_ar')
                                        ->label('Main Content (Arabic)')
                                        ->simple()
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),

                    Forms\Components\Tabs\Tab::make('Listings & Detail Labels')
                        ->schema([
                            Forms\Components\Section::make('Listing Labels')
                                ->schema([
                                    Forms\Components\TextInput::make('search_results_label_en'),
                                    Forms\Components\TextInput::make('search_results_label_ar'),
                                    Forms\Components\TextInput::make('clear_search_label_en'),
                                    Forms\Components\TextInput::make('clear_search_label_ar'),
                                    Forms\Components\TextInput::make('all_items_label_en'),
                                    Forms\Components\TextInput::make('all_items_label_ar'),
                                    Forms\Components\TextInput::make('learn_more_label_en'),
                                    Forms\Components\TextInput::make('learn_more_label_ar'),
                                    Forms\Components\TextInput::make('empty_state_title_en'),
                                    Forms\Components\TextInput::make('empty_state_title_ar'),
                                    Forms\Components\Textarea::make('empty_state_description_en')
                                        ->rows(2),
                                    Forms\Components\Textarea::make('empty_state_description_ar')
                                        ->rows(2),
                                    Forms\Components\TextInput::make('latest_section_title_en'),
                                    Forms\Components\TextInput::make('latest_section_title_ar'),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('Detail Labels')
                                ->schema([
                                    Forms\Components\TextInput::make('home_breadcrumb_label_en'),
                                    Forms\Components\TextInput::make('home_breadcrumb_label_ar'),
                                    Forms\Components\TextInput::make('listing_breadcrumb_label_en'),
                                    Forms\Components\TextInput::make('listing_breadcrumb_label_ar'),
                                    Forms\Components\TextInput::make('share_label_en'),
                                    Forms\Components\TextInput::make('share_label_ar'),
                                    Forms\Components\TextInput::make('back_button_text_en'),
                                    Forms\Components\TextInput::make('back_button_text_ar'),
                                    Forms\Components\TextInput::make('search_title_en'),
                                    Forms\Components\TextInput::make('search_title_ar'),
                                    Forms\Components\TextInput::make('search_placeholder_en'),
                                    Forms\Components\TextInput::make('search_placeholder_ar'),
                                    Forms\Components\TextInput::make('search_button_text_en'),
                                    Forms\Components\TextInput::make('search_button_text_ar'),
                                    Forms\Components\TextInput::make('services_title_en'),
                                    Forms\Components\TextInput::make('services_title_ar'),
                                    Forms\Components\TextInput::make('subscribe_title_en'),
                                    Forms\Components\TextInput::make('subscribe_title_ar'),
                                    Forms\Components\TextInput::make('subscribe_button_text_en'),
                                    Forms\Components\TextInput::make('subscribe_button_text_ar'),
                                    Forms\Components\TextInput::make('categories_title_en'),
                                    Forms\Components\TextInput::make('categories_title_ar'),
                                    Forms\Components\TextInput::make('all_categories_label_en'),
                                    Forms\Components\TextInput::make('all_categories_label_ar'),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('Service Links')
                                ->schema([
                                    Forms\Components\Repeater::make('service_links')
                                        ->schema([
                                            Forms\Components\TextInput::make('label_en')
                                                ->required(),
                                            Forms\Components\TextInput::make('label_ar')
                                                ->required(),
                                            Forms\Components\TextInput::make('url')
                                                ->required()
                                                ->columnSpanFull(),
                                        ])
                                        ->columns(2)
                                        ->columnSpanFull()
                                        ->addActionLabel('Add Service Link'),
                                ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('FAQ & Forms')
                        ->schema([
                            Forms\Components\Section::make('FAQ Items')
                                ->schema([
                                    Forms\Components\Repeater::make('faq_items')
                                        ->schema([
                                            Forms\Components\TextInput::make('question_en')
                                                ->required(),
                                            Forms\Components\TextInput::make('question_ar')
                                                ->required(),
                                            CustomRichEditor::make('answer_en')
                                                ->simple()
                                                ->required(),
                                            CustomRichEditor::make('answer_ar')
                                                ->simple()
                                                ->required(),
                                        ])
                                        ->columns(2)
                                        ->columnSpanFull()
                                        ->addActionLabel('Add FAQ Item'),
                                ]),
                            Forms\Components\Section::make('Form Copy')
                                ->schema([
                                    Forms\Components\TextInput::make('form_title_en'),
                                    Forms\Components\TextInput::make('form_title_ar'),
                                    Forms\Components\TextInput::make('form_button_text_en'),
                                    Forms\Components\TextInput::make('form_button_text_ar'),
                                    Forms\Components\TextInput::make('form_warning_text_en'),
                                    Forms\Components\TextInput::make('form_warning_text_ar'),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('Form Fields')
                                ->schema([
                                    Forms\Components\Repeater::make('form_fields')
                                        ->schema([
                                            Forms\Components\TextInput::make('field_name')
                                                ->required(),
                                            Forms\Components\Select::make('field_type')
                                                ->options([
                                                    'text' => 'Text',
                                                    'email' => 'Email',
                                                    'tel' => 'Telephone',
                                                    'textarea' => 'Textarea',
                                                    'radio' => 'Radio',
                                                    'checkbox' => 'Checkbox',
                                                    'select' => 'Select',
                                                ])
                                                ->required()
                                                ->reactive(),
                                            Forms\Components\TextInput::make('label_en')
                                                ->required(),
                                            Forms\Components\TextInput::make('label_ar')
                                                ->required(),
                                            Forms\Components\TextInput::make('placeholder_en'),
                                            Forms\Components\TextInput::make('placeholder_ar'),
                                            Forms\Components\Repeater::make('options')
                                                ->schema([
                                                    Forms\Components\TextInput::make('value')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('label_en')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('label_ar')
                                                        ->required(),
                                                ])
                                                ->columns(3)
                                                ->addActionLabel('Add Option')
                                                ->columnSpanFull()
                                                ->visible(fn (callable $get) => in_array($get('field_type'), ['radio', 'checkbox', 'select'], true)),
                                        ])
                                        ->columns(2)
                                        ->columnSpanFull()
                                        ->addActionLabel('Add Form Field'),
                                ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('CTA Section')
                        ->schema([
                            Forms\Components\Section::make('CTA Background')
                                ->schema([
                                    Forms\Components\FileUpload::make('cta_background_image')
                                        ->image()
                                        ->directory('pages/cta')
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('cta_background_image_alt_en'),
                                    Forms\Components\TextInput::make('cta_background_image_alt_ar'),
                                ])
                                ->columns(2),
                            Forms\Components\Section::make('CTA Copy')
                                ->schema([
                                    Forms\Components\TextInput::make('cta_title_en'),
                                    Forms\Components\TextInput::make('cta_title_ar'),
                                    CustomRichEditor::make('cta_description_en')
                                        ->simple(),
                                    CustomRichEditor::make('cta_description_ar')
                                        ->simple(),
                                    Forms\Components\TextInput::make('cta_button_1_text_en'),
                                    Forms\Components\TextInput::make('cta_button_1_text_ar'),
                                    Forms\Components\TextInput::make('cta_button_1_url')
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('cta_button_2_text_en'),
                                    Forms\Components\TextInput::make('cta_button_2_text_ar'),
                                    Forms\Components\TextInput::make('cta_button_2_url')
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->label('Page Key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('slug');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('slug', array_keys(self::getSlugOptions()));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    protected static function getSlugOptions(): array
    {
        return [
            'faq' => 'FAQ Page',
            'request-meeting' => 'Request Meeting Page',
            'blog-list' => 'Blog List Page',
            'blog-detail' => 'Blog Detail Page',
            'case-studies-list' => 'Case Studies List Page',
            'case-studies-detail' => 'Case Studies Detail Page',
            'articles-list' => 'Articles List Page',
            'articles-detail' => 'Articles Detail Page',
            'books-list' => 'Books List Page',
            'books-detail' => 'Books Detail Page',
            'glossaries-list' => 'Glossaries List Page',
            'glossaries-detail' => 'Glossaries Detail Page',
        ];
    }
}
