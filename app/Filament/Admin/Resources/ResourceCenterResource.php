<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ResourceCenterResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\ResourceCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\CustomRichEditor;

class ResourceCenterResource extends Resource
{
    protected static ?string $model = ResourceCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Resource Center';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 13;

    protected static ?string $modelLabel = 'Resource Center Page';

    protected static ?string $pluralModelLabel = 'Resource Center Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(1),

                Forms\Components\Tabs::make('Content')
                    ->tabs([
                        SectionVisibility::tab([
                            'hero' => 'Hero Section',
                            'main' => 'Main Section',
                            'cards' => 'Resource Cards Section',
                            'cta' => 'CTA Section',
                        ]),
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->schema([
                                Forms\Components\Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background', fn ($component) => $component->directory('resource-center/hero')->helperText('Recommended: 1920x1080px')),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background', fn ($component) => $component->directory('resource-center/hero')->helperText('Recommended: 768x1024px')),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),

                                Forms\Components\Section::make('Hero Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('RESOURCE CENTER'),

                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('Your gateway to expert insights, strategic investment knowledge, and exclusive financial tools—designed to empower investors and businesses alike.')
                                            ->simple(),

                                        Forms\Components\TextInput::make('hero_button_text_en')
                                            ->label('Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('REQUEST A MEETING'),

                                        Forms\Components\TextInput::make('hero_button_url_en')
                                            ->label('Button URL')
                                            ->placeholder('/request-meeting or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /request-meeting) or full URL (e.g., https://example.com). Leave blank to use the default Request Meeting route.')
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Section::make('Hero Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('مركز الموارد'),

                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('بوابتك إلى رؤى الخبراء والمعرفة الاستثمارية الاستراتيجية والأدوات المالية الحصرية - المصممة لتمكين المستثمرين والشركات على حد سواء.')
                                            ->simple(),

                                        Forms\Components\TextInput::make('hero_button_text_ar')
                                            ->label('Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('طلب اجتماع'),

                                        Forms\Components\TextInput::make('hero_button_url_ar')
                                            ->label('Button URL')
                                            ->placeholder('/request-meeting or https://example.com')
                                            ->helperText('اكتب رابطاً نسبياً (مثل /request-meeting) أو رابطاً كاملاً (مثل https://example.com). اتركه فارغاً لاستخدام الرابط الافتراضي.')
                                            ->maxLength(255),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Main Section')
                            ->schema([
                                Forms\Components\Section::make('Section Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('section_title_en')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('EXPLORE OUR KEY RESOURCES'),

                                        CustomRichEditor::make('section_subtitle_en')
                                            ->label('Section Subtitle')
                                            ->required()
                                            ->default('Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Section Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('section_title_ar')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('استكشف مواردنا الرئيسية'),

                                        CustomRichEditor::make('section_subtitle_ar')
                                            ->label('Section Subtitle')
                                            ->required()
                                            ->default('استكشف الفرق الديناميكية التي تقود ابتكارنا وخبرتنا ، كل منها مكرس لتحسين تجربة استشارات الثروة الخاصة بك.')
                                            ->simple(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Resource Cards')
                            ->schema([
                                Forms\Components\Section::make('Blog/News Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('blog_card_image')
                                            ->label('Card Image')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('resource-center/cards')
                                            ->helperText('Recommended: 400x300px'),

                                        Forms\Components\TextInput::make('blog_card_title_en')
                                            ->label('Card Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Blogs / News'),

                                        Forms\Components\TextInput::make('blog_card_title_ar')
                                            ->label('Card Title (Arabic)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('المدونات / الأخبار'),

                                        Forms\Components\TextInput::make('blog_card_link')
                                            ->label('Card Link URL')
                                            ->placeholder('/blog or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /blog) or full URL (e.g., https://example.com)')
                                            ->default('/blog'),
                                        Forms\Components\Toggle::make('blog_card_enabled')
                                            ->label('Enable Link')
                                            ->helperText('Disable to render the card without a clickable link.')
                                            ->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('Case Studies Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('case_studies_card_image')
                                            ->label('Card Image')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('resource-center/cards')
                                            ->helperText('Recommended: 400x300px'),

                                        Forms\Components\TextInput::make('case_studies_card_title_en')
                                            ->label('Card Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Case Studies'),

                                        Forms\Components\TextInput::make('case_studies_card_title_ar')
                                            ->label('Card Title (Arabic)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('دراسات الحالة'),

                                        Forms\Components\TextInput::make('case_studies_card_link')
                                            ->label('Card Link URL')
                                            ->placeholder('/blog or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /blog) or full URL (e.g., https://example.com)')
                                            ->default('/blog'),
                                        Forms\Components\Toggle::make('case_studies_card_enabled')
                                            ->label('Enable Link')
                                            ->helperText('Disable to render the card without a clickable link.')
                                            ->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('Tools Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('tools_card_image')
                                            ->label('Card Image')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('resource-center/cards')
                                            ->helperText('Recommended: 400x300px'),

                                        Forms\Components\TextInput::make('tools_card_title_en')
                                            ->label('Card Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Tools'),

                                        Forms\Components\TextInput::make('tools_card_title_ar')
                                            ->label('Card Title (Arabic)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('الأدوات'),

                                        Forms\Components\TextInput::make('tools_card_link')
                                            ->label('Card Link URL')
                                            ->placeholder('/tools or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /tools) or full URL (e.g., https://example.com)')
                                            ->default('/blog'),
                                        Forms\Components\Toggle::make('tools_card_enabled')
                                            ->label('Enable Link')
                                            ->helperText('Disable to render the card without a clickable link.')
                                            ->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('White Papers Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('white_papers_card_image')
                                            ->label('Card Image')->image()->imageEditor()
                                            ->directory('resource-center/cards')->helperText('Recommended: 400x300px'),
                                        Forms\Components\TextInput::make('white_papers_card_title_en')
                                            ->label('Card Title (English)')->maxLength(255)->default('White Papers'),
                                        Forms\Components\TextInput::make('white_papers_card_title_ar')
                                            ->label('Card Title (Arabic)')->maxLength(255)->default('الأوراق البيضاء'),
                                        Forms\Components\TextInput::make('white_papers_card_link')
                                            ->label('Card Link URL')->default('/resources-center/white-papers')
                                            ->helperText('e.g., /resources-center/white-papers'),
                                        Forms\Components\Toggle::make('white_papers_card_enabled')
                                            ->label('Enable Link')->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('CIO Flash Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cio_flash_card_image')
                                            ->label('Card Image')->image()->imageEditor()
                                            ->directory('resource-center/cards')->helperText('Recommended: 400x300px'),
                                        Forms\Components\TextInput::make('cio_flash_card_title_en')
                                            ->label('Card Title (English)')->maxLength(255)->default('CIO Flash'),
                                        Forms\Components\TextInput::make('cio_flash_card_title_ar')
                                            ->label('Card Title (Arabic)')->maxLength(255)->default('CIO Flash'),
                                        Forms\Components\TextInput::make('cio_flash_card_link')
                                            ->label('Card Link URL')->default('/resources-center/cio-flash')
                                            ->helperText('e.g., /resources-center/cio-flash'),
                                        Forms\Components\Toggle::make('cio_flash_card_enabled')
                                            ->label('Enable Link')->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('Monday Window Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('monday_window_card_image')
                                            ->label('Card Image')->image()->imageEditor()
                                            ->directory('resource-center/cards')->helperText('Recommended: 400x300px'),
                                        Forms\Components\TextInput::make('monday_window_card_title_en')
                                            ->label('Card Title (English)')->maxLength(255)->default('Monday Window'),
                                        Forms\Components\TextInput::make('monday_window_card_title_ar')
                                            ->label('Card Title (Arabic)')->maxLength(255)->default('نافذة الاثنين'),
                                        Forms\Components\TextInput::make('monday_window_card_link')
                                            ->label('Card Link URL')->default('/resources-center/monday-window')
                                            ->helperText('e.g., /resources-center/monday-window'),
                                        Forms\Components\Toggle::make('monday_window_card_enabled')
                                            ->label('Enable Link')->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),

                                Forms\Components\Section::make('Research Card')
                                    ->schema([
                                        Forms\Components\FileUpload::make('research_card_image')
                                            ->label('Card Image')->image()->imageEditor()
                                            ->directory('resource-center/cards')->helperText('Recommended: 400x300px'),
                                        Forms\Components\TextInput::make('research_card_title_en')
                                            ->label('Card Title (English)')->maxLength(255)->default('Research'),
                                        Forms\Components\TextInput::make('research_card_title_ar')
                                            ->label('Card Title (Arabic)')->maxLength(255)->default('الأبحاث'),
                                        Forms\Components\TextInput::make('research_card_link')
                                            ->label('Card Link URL')->default('/resources-center/research')
                                            ->helperText('e.g., /resources-center/research'),
                                        Forms\Components\Toggle::make('research_card_enabled')
                                            ->label('Enable Link')->default(true),
                                    ])
                                    ->columns(1)
                                    ->collapsible(),
                            ]),

                        Forms\Components\Tabs\Tab::make('CTA Section')
                            ->schema([
                                Forms\Components\Section::make('CTA Background')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'Background Image', fn ($component) => $component->directory('resource-center/cta')->helperText('Recommended: 1920x600px')),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('CTA Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title_en')
                                            ->label('CTA Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('READY TO START GROWING?!'),

                                        CustomRichEditor::make('cta_subtitle_en')
                                            ->label('CTA Subtitle')
                                            ->required()
                                            ->default('Unlock the full potential of your wealth')
                                            ->simple(),

                                        Forms\Components\TextInput::make('cta_button_1_text_en')
                                            ->label('Button 1 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('JOIN OUR MAILING LIST'),

                                        Forms\Components\TextInput::make('cta_button_1_url_en')
                                            ->label('Button 1 URL')
                                            ->placeholder('/contact-us or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /contact-us) or full URL (e.g., https://example.com). Leave blank to use the default Contact Us route.')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('REQUEST A MEETING'),

                                        Forms\Components\TextInput::make('cta_button_2_url_en')
                                            ->label('Button 2 URL')
                                            ->placeholder('/request-meeting or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /request-meeting) or full URL (e.g., https://example.com). Leave blank to use the default Request Meeting route.')
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Section::make('CTA Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title_ar')
                                            ->label('CTA Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('هل أنت مستعد للبدء في النمو؟!'),

                                        CustomRichEditor::make('cta_subtitle_ar')
                                            ->label('CTA Subtitle')
                                            ->required()
                                            ->default('أطلق العنان للإمكانات الكاملة لثروتك')
                                            ->simple(),

                                        Forms\Components\TextInput::make('cta_button_1_text_ar')
                                            ->label('Button 1 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('انضم إلى قائمتنا البريدية'),

                                        Forms\Components\TextInput::make('cta_button_1_url_ar')
                                            ->label('Button 1 URL')
                                            ->placeholder('/contact-us أو https://example.com')
                                            ->helperText('اكتب رابطاً نسبياً (مثل /contact-us) أو رابطاً كاملاً (مثل https://example.com). اتركه فارغاً لاستخدام الرابط الافتراضي للتواصل معنا.')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('طلب اجتماع'),

                                        Forms\Components\TextInput::make('cta_button_2_url_ar')
                                            ->label('Button 2 URL')
                                            ->placeholder('/request-meeting أو https://example.com')
                                            ->helperText('اكتب رابطاً نسبياً (مثل /request-meeting) أو رابطاً كاملاً (مثل https://example.com). اتركه فارغاً لاستخدام رابط طلب الاجتماع الافتراضي.')
                                            ->maxLength(255),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Hero Title')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResourceCenters::route('/'),
            'create' => Pages\CreateResourceCenter::route('/create'),
            'edit' => Pages\EditResourceCenter::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return ResourceCenter::count() === 0;
    }
}

