<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\Home;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomRichEditor;
use App\Filament\Admin\Resources\HomeResource\Pages;
use App\Filament\Admin\Resources\HomeResource\RelationManagers;

class HomeResource extends Resource
{
    protected static ?string $model = Home::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Page Builder';
    protected static ?string $navigationLabel = 'Home Page';
    protected static ?string $modelLabel = 'Home Page';
    protected static ?string $pluralModelLabel = 'Home Pages';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Home Page Content')
                ->tabs([
                    SectionVisibility::tab([
                        'hero' => 'Hero Section',
                        'assist' => 'How We Can Assist Section',
                        'diversified' => 'Diversified Programs Section',
                        'directors' => 'Board of Directors Section',
                        'track_record' => 'Proven Track Record Section',
                        'roadmap' => 'Road Map Section',
                        'insights' => 'Insights Section',
                        'cta' => 'Ready To Start Growing Section',
                    ]),
                    // Hero Section Tab
                    Tabs\Tab::make('Hero Section')
                        ->schema([
                            Section::make('Hero Slides')
                                ->schema([
                                    Repeater::make('hero_slides')
                                        ->label('Slides')
                                        ->default(static::defaultHeroSlides())
                                        ->schema([
                                            TextInput::make('title_en')
                                                ->label('Title (English)')
                                                ->required(),
                                            TextInput::make('title_ar')
                                                ->label('Title (Arabic)'),
                                            CustomRichEditor::make('subtitle_en')
                                                ->label('Subtitle (English)')
                                                ->simple(),
                                            CustomRichEditor::make('subtitle_ar')
                                                ->label('Subtitle (Arabic)')
                                                ->simple(),
                                            ...ImageWithAlt::make('image', 'Background Image', fn ($component) => $component->directory('home/hero')),
                                            TextInput::make('button_text_en')
                                                ->label('Button Text (English)')
                                                ->default('LEARN MORE'),
                                            TextInput::make('button_text_ar')
                                                ->label('Button Text (Arabic)'),
                                            TextInput::make('button_link')
                                                ->label('Button Link')
                                                ->helperText('Route path, anchor, or full URL'),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(3)
                                        ->addActionLabel('Add Slide')
                                        ->reorderable()
                                        ->reorderableWithButtons()
                                        ->reorderableWithDragAndDrop(false)
                                        ->collapsible()
                                        ->itemLabel(fn ($state): ?string => is_array($state) ? ($state['title_en'] ?? $state['title_ar'] ?? 'Slide') : 'Slide')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // How We Can Assist Tab
                    Tabs\Tab::make('How We Can Assist')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('assist_title_en')
                                        ->label('Title (English)')
                                        ->default('HOW WE CAN ASSIST')
                                        ,
                                    TextInput::make('assist_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('assist_description_en')
                                        ->label('Description (English)')
                                        ->full(),
                                    CustomRichEditor::make('assist_description_ar')
                                        ->label('Description (Arabic)')
                                        ->full(),
                                    FileUpload::make('assist_image')
                                        ->label('Section Image')
                                        ->directory('home/assist')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('assist_image_alt_en')
                                        ->label('Section Image Alt (English)')
                                        ->default('Assist section image')
                                        ->maxLength(255),
                                    TextInput::make('assist_image_alt_ar')
                                        ->label('Section Image Alt (Arabic)')
                                        ->default('صورة قسم المساعدة')
                                        ->maxLength(255),
                                ])
                                ->columns(2),

                            Section::make('Our Services Button')
                                ->schema([
                                    TextInput::make('assist_button_text_en')
                                        ->label('Button Text (English)')
                                        ->default('OUR SERVICES')
                                        ->columnSpan(1),
                                    TextInput::make('assist_button_text_ar')
                                        ->label('Button Text (Arabic)')
                                        ->default('خدماتنا')
                                        ->columnSpan(1),
                                    TextInput::make('assist_button_link')
                                        ->label('Button Link')
                                        ->default('services')
                                        ->helperText('Laravel route name or URL (e.g., services, about-us, #)')
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),

                            Section::make('Services')
                                ->schema([
                                    Repeater::make('services')
                                        ->label('Services')
                                        ->schema([
                                            TextInput::make('title_en')
                                                ->label('Service Title (English)')
                                                ->required(),
                                            TextInput::make('title_ar')
                                                ->label('Service Title (Arabic)')
                                                ->required(),
                                            CustomRichEditor::make('description_en')
                                                ->label('Service Description (English)')
                                                ->simple(),
                                            CustomRichEditor::make('description_ar')
                                                ->label('Service Description (Arabic)')
                                                ->simple(),
                                            TextInput::make('link')
                                                ->label('Service Link (Read More)')
                                                ->placeholder('e.g., /governance-services'),
                                            TextInput::make('read_more_text_en')
                                                ->label('Read More Button Text (English)')
                                                ->default('Read More'),
                                            TextInput::make('read_more_text_ar')
                                                ->label('Read More Button Text (Arabic)')
                                                ->default('اقرأ المزيد'),
                                            FileUpload::make('icon')
                                                ->label('Service Icon')
                                                ->directory('home/services/icons')
                                                ->image()
                                                ->imageEditor(),
                                            TextInput::make('icon_alt_en')
                                                ->label('Service Icon Alt (English)')
                                                ->default('Service icon')
                                                ->maxLength(255),
                                            TextInput::make('icon_alt_ar')
                                                ->label('Service Icon Alt (Arabic)')
                                                ->default('رمز الخدمة')
                                                ->maxLength(255),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(4)
                                        ->addActionLabel('Add Service')
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? null)
                                        ->default([
                                            [
                                                'title_en' => 'Governance Advisory',
                                                'title_ar' => 'الاستشارات الحوكمية',
                                                'description_en' => 'Comprehensive governance advisory services to help organizations establish effective governance frameworks and policies.',
                                                'description_ar' => 'خدمات استشارية شاملة في مجال الحوكمة لمساعدة المنظمات على إنشاء أطر وسياسات حوكمة فعالة.',
                                                'link' => 'governance-services',
                                                'image' => null,
                                            ],
                                            [
                                                'title_en' => 'Wealth Planning',
                                                'title_ar' => 'تخطيط الثروة',
                                                'description_en' => 'Strategic wealth planning services designed to help clients achieve their long-term financial goals and objectives.',
                                                'description_ar' => 'خدمات تخطيط الثروة الاستراتيجية المصممة لمساعدة العملاء على تحقيق أهدافهم المالية طويلة المدى.',
                                                'link' => 'wealth-services',
                                                'image' => null,
                                            ],
                                            [
                                                'title_en' => 'Strategic Investment Advisory',
                                                'title_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
                                                'description_en' => 'Expert investment advisory services providing strategic guidance for optimal portfolio management and growth.',
                                                'description_ar' => 'خدمات استشارية استثمارية متخصصة تقدم التوجيه الاستراتيجي لإدارة المحافظ المثلى والنمو.',
                                                'link' => 'investment-services',
                                                'image' => null,
                                            ],
                                            [
                                                'title_en' => 'CIO Office Services',
                                                'title_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
                                                'description_en' => 'Comprehensive CIO office services including investment oversight, risk management, and strategic planning.',
                                                'description_ar' => 'خدمات شاملة لمكتب المدير التنفيذي للاستثمار تشمل الإشراف على الاستثمار وإدارة المخاطر والتخطيط الاستراتيجي.',
                                                'link' => 'cio-services',
                                                'image' => null,
                                            ],
                                        ]),
                                ]),
                        ]),

                    // Diversified Programs Tab
                    Tabs\Tab::make('Diversified Programs')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('diversified_title_en')
                                        ->label('Title (English)')
                                        ->default('DIVERSIFIED PROGRAMS')
                                        ,
                                    TextInput::make('diversified_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('diversified_description_en')
                                        ->label('Description (English)')
                                        ->simple(),
                                    CustomRichEditor::make('diversified_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('diversified_desktop_image')
                                        ->label('Desktop Image')
                                        ->directory('home/diversified')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('diversified_desktop_image_alt_en')
                                        ->label('Desktop Image Alt (English)')
                                        ->default('Diversified programs')
                                        ->maxLength(255),
                                    TextInput::make('diversified_desktop_image_alt_ar')
                                        ->label('Desktop Image Alt (Arabic)')
                                        ->default('البرامج المتنوعة')
                                        ->maxLength(255),
                                    FileUpload::make('diversified_mobile_image')
                                        ->label('Mobile Image')
                                        ->directory('home/diversified')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('diversified_mobile_image_alt_en')
                                        ->label('Mobile Image Alt (English)')
                                        ->default('Diversified programs (mobile)')
                                        ->maxLength(255),
                                    TextInput::make('diversified_mobile_image_alt_ar')
                                        ->label('Mobile Image Alt (Arabic)')
                                        ->default('البرامج المتنوعة (الجوال)')
                                        ->maxLength(255),
                                    TextInput::make('diversified_button_text_en')
                                        ->label('Button Text (English)')
                                        ->default('LEARN MORE')
                                        ,
                                    TextInput::make('diversified_button_text_ar')
                                        ->label('Button Text (Arabic)'),
                                    TextInput::make('diversified_button_link')
                                        ->label('Button Link')
                                        ,
                                ])
                                ->columns(2),
                            
                            Section::make('Diversified Services')
                                ->schema([
                                    Repeater::make('diversified_services')
                                        ->label('Services')
                                        ->schema([
                                            FileUpload::make('icon')
                                                ->label('Icon')
                                                ->directory('home/diversified/services')
                                                ->image()
                                                ->imageEditor()
                                                ->required(),
                                            TextInput::make('icon_alt_en')
                                                ->label('Icon Alt (English)')
                                                ->default('Diversified service icon')
                                                ->maxLength(255),
                                            TextInput::make('icon_alt_ar')
                                                ->label('Icon Alt (Arabic)')
                                                ->default('رمز خدمة')
                                                ->maxLength(255),
                                            TextInput::make('title_en')
                                                ->label('Title (English)')
                                                ->required(),
                                            TextInput::make('title_ar')
                                                ->label('Title (Arabic)'),
                                            TextInput::make('link')
                                                ->label('Link (optional)')
                                                ->url(),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(6)
                                        ->addActionLabel('Add Service')
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? null),
                                ]),
                        ]),

                    // Board of Directors Tab
                    Tabs\Tab::make('Board of Directors')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('directors_title_en')
                                        ->label('Title (English)')
                                        ->default('BOARD OF DIRECTORS')
                                        ,
                                    TextInput::make('directors_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('directors_description_en')
                                        ->label('Description (English)')
                                        ->simple(),
                                    CustomRichEditor::make('directors_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('directors_background_image')
                                        ->label('Background Image')
                                        ->directory('home/directors')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('directors_background_image_alt_en')
                                        ->label('Background Image Alt (English)')
                                        ->default('Board of directors background')
                                        ->maxLength(255),
                                    TextInput::make('directors_background_image_alt_ar')
                                        ->label('Background Image Alt (Arabic)')
                                        ->default('خلفية مجلس المديرين')
                                        ->maxLength(255),
                                ])
                                ->columns(2),

                            Section::make('Directors')
                                ->schema([
                                    Repeater::make('directors')
                                        ->label('Directors')
                                        ->schema([
                                            TextInput::make('name_en')
                                                ->label('Name (English)')
                                                ,
                                            TextInput::make('name_ar')
                                                ->label('Name (Arabic)')
                                                ,
                                            TextInput::make('position_en')
                                                ->label('Position (English)')
                                                ,
                                            TextInput::make('position_ar')
                                                ->label('Position (Arabic)')
                                                ,
                                            FileUpload::make('image')
                                                ->label('Profile Image')
                                                ->directory('home/directors')
                                                ->image()
                                                ->imageEditor(),
                                            TextInput::make('image_alt_en')
                                                ->label('Profile Image Alt (English)')
                                                ->default('Director profile')
                                                ->maxLength(255),
                                            TextInput::make('image_alt_ar')
                                                ->label('Profile Image Alt (Arabic)')
                                                ->default('صورة المدير')
                                                ->maxLength(255),
                                            FileUpload::make('popup_image')
                                                ->label('Popup Image')
                                                ->directory('home/directors/popup')
                                                ->image()
                                                ->imageEditor(),
                                            TextInput::make('popup_image_alt_en')
                                                ->label('Popup Image Alt (English)')
                                                ->default('Director popup image')
                                                ->maxLength(255),
                                            TextInput::make('popup_image_alt_ar')
                                                ->label('Popup Image Alt (Arabic)')
                                                ->default('صورة منبثقة للمدير')
                                                ->maxLength(255),
                                        ])
                                        ->columns(3)
                                        ->defaultItems(3)
                                        ->addActionLabel('Add Director')
                                        ->default([
                                            [
                                                'name_en' => 'Wael Fawzi',
                                                'name_ar' => 'وائل فوزي',
                                                'position_en' => 'Managing Director',
                                                'position_ar' => 'المدير التنفيذي',
                                                'image' => null,
                                            ],
                                            [
                                                'name_en' => 'Natalia Biryukova',
                                                'name_ar' => 'ناتاليا بيريوكوفا',
                                                'position_en' => 'Director',
                                                'position_ar' => 'مدير',
                                                'image' => null,
                                            ],
                                            [
                                                'name_en' => 'Motesm Aggad',
                                                'name_ar' => 'متمم عقد',
                                                'position_en' => 'Director',
                                                'position_ar' => 'مدير',
                                                'image' => null,
                                            ],
                                        ]),
                                ]),
                        ]),

                    // Proven Track Record Tab
                    Tabs\Tab::make('Proven Track Record')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('track_record_title_en')
                                        ->label('Title (English)')
                                        ->default('PROVEN TRACK RECORD')
                                        ,
                                    TextInput::make('track_record_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('track_record_description_en')
                                        ->label('Description (English)')
                                        ->simple(),
                                    CustomRichEditor::make('track_record_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('track_record_background_image')
                                        ->label('Background Image')
                                        ->directory('home/track-record')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('track_record_background_image_alt_en')
                                        ->label('Background Image Alt (English)')
                                        ->default('Track record background')
                                        ->maxLength(255),
                                    TextInput::make('track_record_background_image_alt_ar')
                                        ->label('Background Image Alt (Arabic)')
                                        ->default('خلفية سجل الأداء')
                                        ->maxLength(255),
                                    FileUpload::make('track_record_icon')
                                        ->label('Track Record Icon')
                                        ->directory('home/track-record')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('track_record_icon_alt_en')
                                        ->label('Icon Alt (English)')
                                        ->default('Track record icon')
                                        ->maxLength(255),
                                    TextInput::make('track_record_icon_alt_ar')
                                        ->label('Icon Alt (Arabic)')
                                        ->default('أيقونة سجل الأداء')
                                        ->maxLength(255),
                                ])
                                ->columns(2),

                            Section::make('Metrics')
                                ->schema([
                                    Repeater::make('track_record_metrics')
                                        ->label('Track Record Metrics')
                                        ->schema([
                                            TextInput::make('number')
                                                ->label('Number')
                                                ,
                                            TextInput::make('label_en')
                                                ->label('Label (English)')
                                                ,
                                            TextInput::make('label_ar')
                                                ->label('Label (Arabic)')
                                                ,
                                        ])
                                        ->columns(3)
                                        ->defaultItems(4)
                                        ->addActionLabel('Add Metric'),
                                ]),
                        ]),

                    // Road Map Tab
                    Tabs\Tab::make('Road Map')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('roadmap_title_en')
                                        ->label('Title (English)')
                                        ->default('ROAD MAP')
                                        ,
                                    TextInput::make('roadmap_title_ar')
                                        ->label('Title (Arabic)'),
                                    FileUpload::make('roadmap_mobile_image')
                                        ->label('Mobile Image')
                                        ->directory('home/roadmap')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('roadmap_mobile_image_alt_en')
                                        ->label('Mobile Image Alt (English)')
                                        ->default('Roadmap mobile image')
                                        ->maxLength(255),
                                    TextInput::make('roadmap_mobile_image_alt_ar')
                                        ->label('Mobile Image Alt (Arabic)')
                                        ->default('صورة خارطة الطريق للجوال')
                                        ->maxLength(255),
                                    TextInput::make('roadmap_button_text_en')
                                        ->label('Button Text (English)')
                                        ->default('VIEW ROADMAP')
                                        ,
                                    TextInput::make('roadmap_button_text_ar')
                                        ->label('Button Text (Arabic)'),
                                    TextInput::make('roadmap_button_link')
                                        ->label('Button Link')
                                        ,
                                ])
                                ->columns(2),

                            Section::make('Roadmap Steps')
                                ->schema([
                                    Repeater::make('roadmap_steps')
                                        ->label('Roadmap Steps')
                                        ->schema([
                                            TextInput::make('step_en')
                                                ->label('Step (English)')
                                                ->columnSpan(1),
                                            TextInput::make('step_ar')
                                                ->label('Step (Arabic)')
                                                ->columnSpan(1),
                                            TextInput::make('description_en')
                                                ->label('Description (English)')
                                                ->columnSpan(1),
                                            TextInput::make('description_ar')
                                                ->label('Description (Arabic)')
                                                ->columnSpan(1),
                                            FileUpload::make('icon')
                                                ->label('Step Icon')
                                                ->directory('home/roadmap/icons')
                                                ->image()
                                                ->imageEditor(),
                                            TextInput::make('icon_alt_en')
                                                ->label('Step Icon Alt (English)')
                                                ->default('Roadmap step icon')
                                                ->maxLength(255),
                                            TextInput::make('icon_alt_ar')
                                                ->label('Step Icon Alt (Arabic)')
                                                ->default('أيقونة خطوة خارطة الطريق')
                                                ->maxLength(255),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(8)
                                        ->addActionLabel('Add Step')
                                        ->default([
                                            [
                                                'step_en' => 'Strategic Decision',
                                                'step_ar' => 'قرار استراتيجي',
                                                'description_en' => 'Strategic decision making process',
                                                'description_ar' => 'عملية اتخاذ القرارات الاستراتيجية',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Governance',
                                                'step_ar' => 'الحوكمة',
                                                'description_en' => 'Governance structure and policies',
                                                'description_ar' => 'هيكل وسياسات الحوكمة',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Current portfolio analysis',
                                                'step_ar' => 'تحليل المحفظة الحالية',
                                                'description_en' => 'Analysis of current investment portfolio',
                                                'description_ar' => 'تحليل محفظة الاستثمار الحالية',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Investment Policy Statement',
                                                'step_ar' => 'بيان سياسة الاستثمار',
                                                'description_en' => 'Investment policy and guidelines',
                                                'description_ar' => 'سياسة ومبادئ الاستثمار',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Investment Implementation',
                                                'step_ar' => 'تنفيذ الاستثمار',
                                                'description_en' => 'Implementation of investment strategy',
                                                'description_ar' => 'تنفيذ استراتيجية الاستثمار',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Investment Structure',
                                                'step_ar' => 'هيكل الاستثمار',
                                                'description_en' => 'Investment structure and framework',
                                                'description_ar' => 'هيكل وإطار الاستثمار',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Managers Search & Selection',
                                                'step_ar' => 'البحث عن المديرين والاختيار',
                                                'description_en' => 'Search and selection of investment managers',
                                                'description_ar' => 'البحث عن مديري الاستثمار واختيارهم',
                                                'icon' => null,
                                            ],
                                            [
                                                'step_en' => 'Monitoring Performance',
                                                'step_ar' => 'مراقبة الأداء',
                                                'description_en' => 'Performance monitoring and reporting',
                                                'description_ar' => 'مراقبة الأداء والتقرير',
                                                'icon' => null,
                                            ],
                                        ]),
                                ]),
                        ]),

                    // Insights Tab
                    Tabs\Tab::make('Insights')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    TextInput::make('insights_title_en')
                                        ->label('Title (English)')
                                        ->default('INSIGHTS')
                                        ,
                                    TextInput::make('insights_title_ar')
                                        ->label('Title (Arabic)'),
                                ])
                                ->columns(2),

                            Section::make('Insights Sections')
                                ->schema([
                                    Repeater::make('insights_sections')
                                        ->label('Insights Sections')
                                        ->schema([
                                            CustomRichEditor::make('description_en')
                                                ->label('Description (English)')
                                                ->simple(),
                                            CustomRichEditor::make('description_ar')
                                                ->label('Description (Arabic)')
                                                ->simple(),
                                            FileUpload::make('image')
                                                ->label('Insight Image')
                                                ->directory('home/insights')
                                                ->image()
                                                ->imageEditor(),
                                            TextInput::make('image_alt_en')
                                                ->label('Insight Image Alt (English)')
                                                ->default('Insight image')
                                                ->maxLength(255),
                                            TextInput::make('image_alt_ar')
                                                ->label('Insight Image Alt (Arabic)')
                                                ->default('صورة الرؤى')
                                                ->maxLength(255),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(3)
                                        ->addActionLabel('Add Section'),
                                ]),
                        ]),

                    // Ready To Start Growing Tab
                    Tabs\Tab::make('Ready To Start Growing')
                        ->schema([
                            Section::make('Section Content')
                                ->schema([
                                    Toggle::make('cta_section_enabled')
                                        ->label('Show Section')
                                        ->default(true)
                                        ->inline(false),
                                    TextInput::make('cta_title_en')
                                        ->label('Title (English)')
                                        ->default('READY TO START GROWING?')
                                        ,
                                    TextInput::make('cta_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('cta_description_en')
                                        ->label('Description (English)')
                                        ->simple(),
                                    CustomRichEditor::make('cta_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('cta_background_image')
                                        ->label('Background Image')
                                        ->directory('home/cta')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('cta_background_image_alt_en')
                                        ->label('Background Image Alt (English)')
                                        ->default('CTA section background')
                                        ->maxLength(255),
                                    TextInput::make('cta_background_image_alt_ar')
                                        ->label('Background Image Alt (Arabic)')
                                        ->default('خلفية قسم الدعوة إلى الإجراء')
                                        ->maxLength(255),
                                    TextInput::make('cta_button_1_text_en')
                                        ->label('Button 1 Text (English)')
                                        ->default('GET STARTED')
                                        ,
                                    TextInput::make('cta_button_1_text_ar')
                                        ->label('Button 1 Text (Arabic)'),
                                    TextInput::make('cta_button_1_link')
                                        ->label('Button 1 Link')
                                        ,
                                    TextInput::make('cta_button_2_text_en')
                                        ->label('Button 2 Text (English)')
                                        ->default('LEARN MORE')
                                        ,
                                    TextInput::make('cta_button_2_text_ar')
                                        ->label('Button 2 Text (Arabic)'),
                                    TextInput::make('cta_button_2_link')
                                        ->label('Button 2 Link')
                                        ,
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
                Tables\Columns\TextColumn::make('hero_slide_1_title_en')
                    ->label('Hero Slide 1 Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assist_title_en')
                    ->label('Assist Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }

    public static function defaultHeroSlides(): array
    {
        return [
            [
                'title_en' => 'YOUR WEALTH JOURNEY PARTNERS',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
                'subtitle_ar' => null,
                'image' => null,
                'image_alt_en' => 'Hero slide 1 background',
                'image_alt_ar' => 'خلفية الشريحة الأولى',
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'about-us#who-we-are-section',
            ],
            [
                'title_en' => 'TAILORED PROGRAM FOR GROWING YOUR WEALTH',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you succeed.',
                'subtitle_ar' => null,
                'image' => null,
                'image_alt_en' => 'Hero slide 2 background',
                'image_alt_ar' => 'خلفية الشريحة الثانية',
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'resource-center',
            ],
            [
                'title_en' => 'SECURE AND EXPAND YOUR WEALTH',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
                'subtitle_ar' => null,
                'image' => null,
                'image_alt_en' => 'Hero slide 3 background',
                'image_alt_ar' => 'خلفية الشريحة الثالثة',
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'services',
            ],
        ];
    }

    public static function legacyHeroSlides(?Home $record): array
    {
        if (! $record) {
            return static::defaultHeroSlides();
        }

        $slides = [];

        foreach ([1, 2, 3] as $index) {
            $slide = [
                'title_en' => $record->{"hero_slide_{$index}_title_en"} ?? null,
                'title_ar' => $record->{"hero_slide_{$index}_title_ar"} ?? null,
                'subtitle_en' => $record->{"hero_slide_{$index}_subtitle_en"} ?? null,
                'subtitle_ar' => $record->{"hero_slide_{$index}_subtitle_ar"} ?? null,
                'image' => $record->{"hero_slide_{$index}_image"} ?? null,
                'image_alt_en' => $record->{"hero_slide_{$index}_image_alt_en"} ?? null,
                'image_alt_ar' => $record->{"hero_slide_{$index}_image_alt_ar"} ?? null,
                'button_text_en' => $record->{"hero_slide_{$index}_button_text_en"} ?? null,
                'button_text_ar' => $record->{"hero_slide_{$index}_button_text_ar"} ?? null,
                'button_link' => $record->{"hero_slide_{$index}_button_link"} ?? null,
            ];

            if (
                filled($slide['title_en']) || filled($slide['title_ar']) || filled($slide['subtitle_en']) || filled($slide['subtitle_ar']) ||
                filled($slide['image']) || filled($slide['button_text_en']) || filled($slide['button_text_ar']) || filled($slide['button_link'])
            ) {
                $slides[] = $slide;
            }
        }

        return $slides !== [] ? $slides : static::defaultHeroSlides();
    }

    public static function heroSlidesForForm(?Home $record): array
    {
        if (! $record) {
            return static::defaultHeroSlides();
        }

        $storedSlides = static::sanitizeHeroSlides($record->hero_slides ?? []);

        if ($storedSlides !== []) {
            return $storedSlides;
        }

        $legacySlides = static::sanitizeHeroSlides(static::legacyHeroSlides($record));

        return $legacySlides !== [] ? $legacySlides : static::defaultHeroSlides();
    }

    public static function sanitizeHeroSlides(array $slides): array
    {
        return collect(array_values($slides))
            ->map(function ($slide): array {
                $slide = is_array($slide) ? $slide : [];

                return [
                    'title_en' => $slide['title_en'] ?? null,
                    'title_ar' => $slide['title_ar'] ?? null,
                    'subtitle_en' => $slide['subtitle_en'] ?? null,
                    'subtitle_ar' => $slide['subtitle_ar'] ?? null,
                    'image' => $slide['image'] ?? null,
                    'image_alt_en' => $slide['image_alt_en'] ?? null,
                    'image_alt_ar' => $slide['image_alt_ar'] ?? null,
                    'button_text_en' => $slide['button_text_en'] ?? null,
                    'button_text_ar' => $slide['button_text_ar'] ?? null,
                    'button_link' => $slide['button_link'] ?? null,
                ];
            })
            ->filter(function (array $slide): bool {
                return collect($slide)->contains(fn ($value) => filled($value));
            })
            ->values()
            ->all();
    }

    public static function syncLegacyHeroSlides(array $data): array
    {
        $data['hero_slides'] = static::sanitizeHeroSlides($data['hero_slides'] ?? []);
        $slides = array_values($data['hero_slides']);

        foreach ([1, 2, 3] as $index) {
            $slide = $slides[$index - 1] ?? [];

            $data["hero_slide_{$index}_title_en"] = $slide['title_en'] ?? null;
            $data["hero_slide_{$index}_title_ar"] = $slide['title_ar'] ?? null;
            $data["hero_slide_{$index}_subtitle_en"] = $slide['subtitle_en'] ?? null;
            $data["hero_slide_{$index}_subtitle_ar"] = $slide['subtitle_ar'] ?? null;
            $data["hero_slide_{$index}_image"] = $slide['image'] ?? null;
            $data["hero_slide_{$index}_image_alt_en"] = $slide['image_alt_en'] ?? null;
            $data["hero_slide_{$index}_image_alt_ar"] = $slide['image_alt_ar'] ?? null;
            $data["hero_slide_{$index}_button_text_en"] = $slide['button_text_en'] ?? null;
            $data["hero_slide_{$index}_button_text_ar"] = $slide['button_text_ar'] ?? null;
            $data["hero_slide_{$index}_button_link"] = $slide['button_link'] ?? null;
        }

        return $data;
    }
}
