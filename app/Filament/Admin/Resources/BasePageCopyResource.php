<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Support\SectionVisibility;
use App\Forms\Components\CustomRichEditor;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

abstract class BasePageCopyResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Page Builder';

    abstract protected static function getManagedSlugs(): array;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('slug', static::getManagedSlugs());
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
            ->bulkActions([])
            ->defaultSort('slug');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [];
    }

    protected static function identitySection(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Page Settings')
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->label('Page Key')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active'),
            ])
            ->columns(2);
    }

    /**
     * @param  array<string, string>  $sections
     */
    protected static function visibilityTab(array $sections, string $label = 'Section Visibility'): Forms\Components\Tabs\Tab
    {
        return SectionVisibility::tab($sections, $label);
    }

    protected static function heroTab(string $label = 'Hero Section'): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make($label)
            ->schema([
                Forms\Components\Section::make('Hero Images')
                    ->schema([
                        Forms\Components\FileUpload::make('hero_desktop_image')
                            ->label('Hero Image (Desktop)')
                            ->image()
                            ->directory('pages/hero')
                            ->imageEditor(),
                        Forms\Components\TextInput::make('hero_desktop_image_alt_en')
                            ->label('Desktop Image Alt (English)'),
                        Forms\Components\TextInput::make('hero_desktop_image_alt_ar')
                            ->label('Desktop Image Alt (Arabic)'),
                        Forms\Components\FileUpload::make('hero_mobile_image')
                            ->label('Hero Image (Mobile)')
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
            ]);
    }

    protected static function introTab(string $label = 'Intro Section', bool $includeMainContent = true): Forms\Components\Tabs\Tab
    {
        $schema = [
            Forms\Components\Section::make('Section Intro')
                ->schema([
                    Forms\Components\FileUpload::make('body_background_image')
                        ->label('Section Background Image')
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
                ])
                ->columns(2),
        ];

        if ($includeMainContent) {
            $schema[] = Forms\Components\Section::make('Main Content')
                ->schema([
                    CustomRichEditor::make('content_en')
                        ->label('Content (English)')
                        ->simple()
                        ->columnSpanFull(),
                    CustomRichEditor::make('content_ar')
                        ->label('Content (Arabic)')
                        ->simple()
                        ->columnSpanFull(),
                ]);
        }

        return Forms\Components\Tabs\Tab::make($label)->schema($schema);
    }

    protected static function faqTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('FAQ Items')
            ->schema([
                Forms\Components\Repeater::make('faq_items')
                    ->schema([
                        Forms\Components\TextInput::make('question_en')
                            ->label('Question (English)')
                            ->required(),
                        Forms\Components\TextInput::make('question_ar')
                            ->label('Question (Arabic)')
                            ->required(),
                        CustomRichEditor::make('answer_en')
                            ->label('Answer (English)')
                            ->simple()
                            ->required(),
                        CustomRichEditor::make('answer_ar')
                            ->label('Answer (Arabic)')
                            ->simple()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Add FAQ Item'),
            ]);
    }

    protected static function requestMeetingTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('Form Copy')
            ->schema([
                Forms\Components\Section::make('Meeting Form Content')
                    ->schema([
                        Forms\Components\FileUpload::make('body_background_image')
                            ->label('Form Background Image')
                            ->image()
                            ->directory('pages/body')
                            ->imageEditor(),
                        Forms\Components\TextInput::make('body_background_image_alt_en')
                            ->label('Form Background Alt (English)'),
                        Forms\Components\TextInput::make('body_background_image_alt_ar')
                            ->label('Form Background Alt (Arabic)'),
                        Forms\Components\TextInput::make('form_title_en')
                            ->label('Form Title (English)'),
                        Forms\Components\TextInput::make('form_title_ar')
                            ->label('Form Title (Arabic)'),
                        Forms\Components\TextInput::make('form_button_text_en')
                            ->label('Button Text (English)'),
                        Forms\Components\TextInput::make('form_button_text_ar')
                            ->label('Button Text (Arabic)'),
                        Forms\Components\TextInput::make('form_warning_text_en')
                            ->label('Warning Text (English)'),
                        Forms\Components\TextInput::make('form_warning_text_ar')
                            ->label('Warning Text (Arabic)'),
                    ])
                    ->columns(2),
            ]);
    }

    protected static function ctaTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('CTA Section')
            ->schema([
                Forms\Components\Section::make('CTA Background')
                    ->schema([
                        Forms\Components\FileUpload::make('cta_background_image')
                            ->label('CTA Background Image')
                            ->image()
                            ->directory('pages/cta')
                            ->imageEditor(),
                        Forms\Components\TextInput::make('cta_background_image_alt_en')
                            ->label('CTA Background Alt (English)'),
                        Forms\Components\TextInput::make('cta_background_image_alt_ar')
                            ->label('CTA Background Alt (Arabic)'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('CTA Copy')
                    ->schema([
                        Forms\Components\TextInput::make('cta_title_en')
                            ->label('CTA Title (English)'),
                        Forms\Components\TextInput::make('cta_title_ar')
                            ->label('CTA Title (Arabic)'),
                        CustomRichEditor::make('cta_description_en')
                            ->label('CTA Description (English)')
                            ->simple(),
                        CustomRichEditor::make('cta_description_ar')
                            ->label('CTA Description (Arabic)')
                            ->simple(),
                        Forms\Components\TextInput::make('cta_button_1_text_en')
                            ->label('Primary Button Text (English)'),
                        Forms\Components\TextInput::make('cta_button_1_text_ar')
                            ->label('Primary Button Text (Arabic)'),
                        Forms\Components\TextInput::make('cta_button_1_url')
                            ->label('Primary Button URL')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('cta_button_2_text_en')
                            ->label('Secondary Button Text (English)'),
                        Forms\Components\TextInput::make('cta_button_2_text_ar')
                            ->label('Secondary Button Text (Arabic)'),
                        Forms\Components\TextInput::make('cta_button_2_url')
                            ->label('Secondary Button URL')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    protected static function heroSections(): array
    {
        return [
            Forms\Components\Section::make('Hero Images')
                ->schema([
                    Forms\Components\FileUpload::make('hero_desktop_image')
                        ->label('Hero Image (Desktop)')
                        ->image()
                        ->directory('pages/hero')
                        ->imageEditor(),
                    Forms\Components\TextInput::make('hero_desktop_image_alt_en')
                        ->label('Desktop Image Alt (English)'),
                    Forms\Components\TextInput::make('hero_desktop_image_alt_ar')
                        ->label('Desktop Image Alt (Arabic)'),
                    Forms\Components\FileUpload::make('hero_mobile_image')
                        ->label('Hero Image (Mobile)')
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
        ];
    }

    protected static function introSections(bool $includeMainContent = true): array
    {
        $sections = [
            Forms\Components\Section::make('Section Intro')
                ->schema([
                    Forms\Components\FileUpload::make('body_background_image')
                        ->label('Section Background Image')
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
                ])
                ->columns(2),
        ];

        if ($includeMainContent) {
            $sections[] = Forms\Components\Section::make('Main Content')
                ->schema([
                    CustomRichEditor::make('content_en')
                        ->label('Content (English)')
                        ->simple()
                        ->columnSpanFull(),
                    CustomRichEditor::make('content_ar')
                        ->label('Content (Arabic)')
                        ->simple()
                        ->columnSpanFull(),
                ]);
        }

        return $sections;
    }

    protected static function ctaSections(): array
    {
        return [
            Forms\Components\Section::make('CTA Background')
                ->schema([
                    Forms\Components\FileUpload::make('cta_background_image')
                        ->label('CTA Background Image')
                        ->image()
                        ->directory('pages/cta')
                        ->imageEditor(),
                    Forms\Components\TextInput::make('cta_background_image_alt_en')
                        ->label('CTA Background Alt (English)'),
                    Forms\Components\TextInput::make('cta_background_image_alt_ar')
                        ->label('CTA Background Alt (Arabic)'),
                ])
                ->columns(2),
            Forms\Components\Section::make('CTA Copy')
                ->schema([
                    Forms\Components\TextInput::make('cta_title_en')
                        ->label('CTA Title (English)'),
                    Forms\Components\TextInput::make('cta_title_ar')
                        ->label('CTA Title (Arabic)'),
                    CustomRichEditor::make('cta_description_en')
                        ->label('CTA Description (English)')
                        ->simple(),
                    CustomRichEditor::make('cta_description_ar')
                        ->label('CTA Description (Arabic)')
                        ->simple(),
                    Forms\Components\TextInput::make('cta_button_1_text_en')
                        ->label('Primary Button Text (English)'),
                    Forms\Components\TextInput::make('cta_button_1_text_ar')
                        ->label('Primary Button Text (Arabic)'),
                    Forms\Components\TextInput::make('cta_button_1_url')
                        ->label('Primary Button URL')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('cta_button_2_text_en')
                        ->label('Secondary Button Text (English)'),
                    Forms\Components\TextInput::make('cta_button_2_text_ar')
                        ->label('Secondary Button Text (Arabic)'),
                    Forms\Components\TextInput::make('cta_button_2_url')
                        ->label('Secondary Button URL')
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }

    protected static function listLabelsSection(string $learnMoreLabel = 'Learn More Label'): Forms\Components\Section
    {
        return Forms\Components\Section::make('Listing Labels')
            ->schema([
                Forms\Components\TextInput::make('search_results_label_en')
                    ->label('Search Results Label (English)'),
                Forms\Components\TextInput::make('search_results_label_ar')
                    ->label('Search Results Label (Arabic)'),
                Forms\Components\TextInput::make('clear_search_label_en')
                    ->label('Clear Search Label (English)'),
                Forms\Components\TextInput::make('clear_search_label_ar')
                    ->label('Clear Search Label (Arabic)'),
                Forms\Components\TextInput::make('all_items_label_en')
                    ->label('All Items Label (English)'),
                Forms\Components\TextInput::make('all_items_label_ar')
                    ->label('All Items Label (Arabic)'),
                Forms\Components\TextInput::make('learn_more_label_en')
                    ->label($learnMoreLabel . ' (English)'),
                Forms\Components\TextInput::make('learn_more_label_ar')
                    ->label($learnMoreLabel . ' (Arabic)'),
                Forms\Components\TextInput::make('empty_state_title_en')
                    ->label('Empty State Title (English)'),
                Forms\Components\TextInput::make('empty_state_title_ar')
                    ->label('Empty State Title (Arabic)'),
                Forms\Components\Textarea::make('empty_state_description_en')
                    ->label('Empty State Description (English)')
                    ->rows(2),
                Forms\Components\Textarea::make('empty_state_description_ar')
                    ->label('Empty State Description (Arabic)')
                    ->rows(2),
            ])
            ->columns(2);
    }

    protected static function detailLabelsSection(string $allItemsLabel = 'All Items Label', string $latestLabel = 'Latest Section Title'): Forms\Components\Section
    {
        return Forms\Components\Section::make('Detail Labels')
            ->schema([
                Forms\Components\TextInput::make('home_breadcrumb_label_en')
                    ->label('Home Breadcrumb (English)'),
                Forms\Components\TextInput::make('home_breadcrumb_label_ar')
                    ->label('Home Breadcrumb (Arabic)'),
                Forms\Components\TextInput::make('listing_breadcrumb_label_en')
                    ->label('Listing Breadcrumb (English)'),
                Forms\Components\TextInput::make('listing_breadcrumb_label_ar')
                    ->label('Listing Breadcrumb (Arabic)'),
                Forms\Components\TextInput::make('share_label_en')
                    ->label('Share Label (English)'),
                Forms\Components\TextInput::make('share_label_ar')
                    ->label('Share Label (Arabic)'),
                Forms\Components\TextInput::make('back_button_text_en')
                    ->label('Back Button Text (English)'),
                Forms\Components\TextInput::make('back_button_text_ar')
                    ->label('Back Button Text (Arabic)'),
                Forms\Components\TextInput::make('search_title_en')
                    ->label('Sidebar Search Title (English)'),
                Forms\Components\TextInput::make('search_title_ar')
                    ->label('Sidebar Search Title (Arabic)'),
                Forms\Components\TextInput::make('search_placeholder_en')
                    ->label('Sidebar Search Placeholder (English)'),
                Forms\Components\TextInput::make('search_placeholder_ar')
                    ->label('Sidebar Search Placeholder (Arabic)'),
                Forms\Components\TextInput::make('search_button_text_en')
                    ->label('Sidebar Search Button (English)'),
                Forms\Components\TextInput::make('search_button_text_ar')
                    ->label('Sidebar Search Button (Arabic)'),
                Forms\Components\TextInput::make('services_title_en')
                    ->label('Services Title (English)'),
                Forms\Components\TextInput::make('services_title_ar')
                    ->label('Services Title (Arabic)'),
                Forms\Components\TextInput::make('subscribe_title_en')
                    ->label('Subscribe Title (English)'),
                Forms\Components\TextInput::make('subscribe_title_ar')
                    ->label('Subscribe Title (Arabic)'),
                Forms\Components\TextInput::make('subscribe_button_text_en')
                    ->label('Subscribe Button (English)'),
                Forms\Components\TextInput::make('subscribe_button_text_ar')
                    ->label('Subscribe Button (Arabic)'),
                Forms\Components\TextInput::make('categories_title_en')
                    ->label('Categories Title (English)'),
                Forms\Components\TextInput::make('categories_title_ar')
                    ->label('Categories Title (Arabic)'),
                Forms\Components\TextInput::make('all_categories_label_en')
                    ->label($allItemsLabel . ' (English)'),
                Forms\Components\TextInput::make('all_categories_label_ar')
                    ->label($allItemsLabel . ' (Arabic)'),
                Forms\Components\TextInput::make('latest_section_title_en')
                    ->label($latestLabel . ' (English)'),
                Forms\Components\TextInput::make('latest_section_title_ar')
                    ->label($latestLabel . ' (Arabic)'),
                Forms\Components\TextInput::make('learn_more_label_en')
                    ->label('Learn More Label (English)'),
                Forms\Components\TextInput::make('learn_more_label_ar')
                    ->label('Learn More Label (Arabic)'),
            ])
            ->columns(2);
    }

    protected static function serviceLinksSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Service Links')
            ->schema([
                Forms\Components\Repeater::make('service_links')
                    ->schema([
                        Forms\Components\TextInput::make('label_en')
                            ->label('Label (English)')
                            ->required(),
                        Forms\Components\TextInput::make('label_ar')
                            ->label('Label (Arabic)')
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Add Service Link'),
            ]);
    }

    protected static function buildForm(array $tabs, string $tabLabel = 'Page Content'): Form
    {
        return Forms\Form::make()
            ->schema([
                static::identitySection(),
                Forms\Components\Tabs::make($tabLabel)
                    ->tabs($tabs)
                    ->columnSpanFull(),
            ]);
    }
}
