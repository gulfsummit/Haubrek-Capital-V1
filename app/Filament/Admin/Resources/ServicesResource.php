<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ServicesResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\Services;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Forms\Components\CustomRichEditor;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

class ServicesResource extends Resource
{
    protected static ?string $model = Services::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?string $navigationLabel = 'Services';
    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Services Page';

    protected static ?string $pluralModelLabel = 'Services Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Services Page Content')
                    ->tabs([
                        SectionVisibility::tab([
                            'hero' => 'Hero Section',
                            'description' => 'Main Description Section',
                            'services_list' => 'Services List Section',
                            'governance' => 'Governance Advisory Section',
                            'wealth' => 'Wealth Planning Section',
                            'investment' => 'Strategic Investment Advisory Section',
                            'cio' => 'CIO Office Services Section',
                            'roadmap' => 'Roadmap Section',
                            'cta' => 'CTA Section',
                        ]),
                        // Hero Section Tab
                        Tabs\Tab::make('Hero Section')
                            ->schema([
                                Section::make('Hero Content')
                                    ->schema([
                                        TextInput::make('hero_title_en')
                                            ->label('Hero Title (English)')
                                            ->default('SERVICES')
                                            ->required(),
                                        TextInput::make('hero_title_ar')
                                            ->label('Hero Title (Arabic)')
                                            ->default('الخدمات'),
                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Hero Subtitle (English)')
                                            ->default('Discover our comprehensive wealth management solutions')
                                            ->simple(),
                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Hero Subtitle (Arabic)')
                                            ->default('اكتشف حلول إدارة الثروات الشاملة لدينا')
                                            ->simple(),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                                
                                Section::make('Hero Button')
                                    ->schema([
                                        TextInput::make('hero_button_text_en')
                                            ->label('Button Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->columnSpan(1),
                                        TextInput::make('hero_button_text_ar')
                                            ->label('Button Text (Arabic)')
                                            ->default('طلب اجتماع')
                                            ->columnSpan(1),
                                        TextInput::make('hero_button_link')
                                            ->label('Button Link')
                                            ->default('calendar')
                                            ->helperText('Laravel route name or URL (e.g., calendar, contact-us, #)')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),
                                
                                Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_background_image', 'Hero Background Image (Desktop)', fn ($component) => $component->directory('services/hero')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        ...ImageWithAlt::make('hero_mobile_background_image', 'Hero Background Image (Mobile)', fn ($component) => $component->directory('services/hero')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Main Description Tab
                        Tabs\Tab::make('Main Description')
                            ->schema([
                                Section::make('Description Content')
                                    ->schema([
                                        TextInput::make('description_title_en')
                                            ->label('Description Title (English)')
                                            ->default('OPTIMIZING WEALTH MANAGEMENT FOR HNWI, FAMILY OFFICES & ENDOWMENTS')
                                            ->required(),
                                        TextInput::make('description_title_ar')
                                            ->label('Description Title (Arabic)')
                                            ->default('تحسين إدارة الثروات للأفراد ذوي الملاءة العالية ومكاتب العائلة والهبات'),
                                        CustomRichEditor::make('description_en')
                                            ->label('Description Content (English)')
                                            ->default('As liquid assets grow, so do the challenges of managing them effectively. We establish dedicated investment offices and endowment funds to ensure sustainability, capital growth, and governance.

A high-performing investment office goes beyond wealth management, driving asset diversification, governance, and performance monitoring. Depending on asset value, management can be insourced or outsourced.

At Hauberk Capital, we provide outsourced wealth management solutions to reduce costs, enhance governance, and optimize asset allocation—ensuring long-term financial success.')
                                            ->full(),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Description Content (Arabic)')
                                            ->default('مع نمو الأصول السائلة، تنمو أيضًا تحديات إدارتها بفعالية. نقوم بإنشاء مكاتب استثمارية مخصصة وصناديق هبات لضمان الاستدامة والنمو الرأسمالي والحوكمة.

مكتب الاستثمار عالي الأداء يتجاوز إدارة الثروات، ويقود تنويع الأصول والحوكمة ومراقبة الأداء. اعتمادًا على قيمة الأصول، يمكن أن تكون الإدارة داخلية أو خارجية.

في هوبيرك كابيتال، نقدم حلول إدارة الثروات الخارجية لتقليل التكاليف وتعزيز الحوكمة وتحسين تخصيص الأصول—ضمان النجاح المالي طويل المدى.')
                                            ->full(),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Services List Tab
                        Tabs\Tab::make('Services List')
                            ->schema([
                                Section::make('Services')
                                    ->schema([
                                        Repeater::make('services_list')
                                            ->label('Services List')
                                            ->schema([
                                                TextInput::make('number')
                                                    ->label('Display Number')
                                                    ->placeholder('e.g., 01, 02, 03, 04')
                                                    ->helperText('Custom number to display (leave empty for auto-numbering)')
                                                    ->columnSpan(1),
                                                TextInput::make('title_en')
                                                    ->label('Service Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                TextInput::make('title_ar')
                                                    ->label('Service Title (Arabic)')
                                                    ->columnSpan(1),
                                                TextInput::make('link_text_en')
                                                    ->label('Link Text (English)')
                                                    ->placeholder('e.g., Learn More, View Details, Explore')
                                                    ->helperText('Custom text for the link (defaults to service title)')
                                                    ->columnSpan(1),
                                                TextInput::make('link_text_ar')
                                                    ->label('Link Text (Arabic)')
                                                    ->placeholder('e.g., تعلم المزيد، عرض التفاصيل، استكشاف')
                                                    ->columnSpan(1),
                                                TextInput::make('link_url')
                                                    ->label('Link URL')
                                                    ->placeholder('e.g., #governance-advisory, /services/governance, https://example.com')
                                                    ->helperText('URL or anchor link (e.g., #section-id, /page, https://example.com)')
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Service Description (English)')
                                                    ->simple()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Service Description (Arabic)')
                                                    ->simple()
                                                    ->columnSpan(1),
                                                TextInput::make('section_id')
                                                    ->label('Section ID (for anchor links)')
                                                    ->placeholder('e.g., governance-advisory, wealth-planning, strategic-investment, cio-office')
                                                    ->helperText('Used for smooth scrolling to sections on the same page')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(4)
                                            ->addActionLabel('Add Service')
                                            ->default([
                                                [
                                                    'number' => '01',
                                                    'title_en' => 'GOVERNANCE ADVISORY',
                                                    'title_ar' => 'الاستشارات الحوكمية',
                                                    'link_text_en' => 'GOVERNANCE ADVISORY',
                                                    'link_text_ar' => 'الاستشارات الحوكمية',
                                                    'link_url' => '#governance-advisory',
                                                    'description_en' => 'Strengthening structures for sustainable success.',
                                                    'description_ar' => 'تعزيز الهياكل للنجاح المستدام.',
                                                    'section_id' => 'governance-advisory',
                                                ],
                                                [
                                                    'number' => '02',
                                                    'title_en' => 'WEALTH PLANNING',
                                                    'title_ar' => 'تخطيط الثروات',
                                                    'link_text_en' => 'WEALTH PLANNING',
                                                    'link_text_ar' => 'تخطيط الثروات',
                                                    'link_url' => '#wealth-planning',
                                                    'description_en' => 'Strategic planning to protect and grow your wealth.',
                                                    'description_ar' => 'تخطيط استراتيجي لحماية ونمو ثروتك.',
                                                    'section_id' => 'wealth-planning',
                                                ],
                                                [
                                                    'number' => '03',
                                                    'title_en' => 'STRATEGIC INVESTMENT ADVISORY',
                                                    'title_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
                                                    'link_text_en' => 'STRATEGIC INVESTMENT ADVISORY',
                                                    'link_text_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
                                                    'link_url' => '#strategic-investment',
                                                    'description_en' => 'Data-driven insights for smarter investments.',
                                                    'description_ar' => 'رؤى مدفوعة بالبيانات لاستثمارات أكثر ذكاءً.',
                                                    'section_id' => 'strategic-investment',
                                                ],
                                                [
                                                    'number' => '04',
                                                    'title_en' => 'CIO OFFICE SERVICES',
                                                    'title_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
                                                    'link_text_en' => 'CIO OFFICE SERVICES',
                                                    'link_text_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
                                                    'link_url' => '#cio-office',
                                                    'description_en' => 'Enhancing portfolio management efficiency.',
                                                    'description_ar' => 'تعزيز كفاءة إدارة المحفظة.',
                                                    'section_id' => 'cio-office',
                                                ],
                                            ]),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Governance Advisory Tab
                        Tabs\Tab::make('Governance Advisory')
                            ->schema([
                                Section::make('Governance Advisory Content')
                                    ->schema([
                                        TextInput::make('governance_title_en')
                                            ->label('Title (English)')
                                            ->default('GOVERNANCE ADVISORY')
                                            ->required(),
                                        TextInput::make('governance_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('الاستشارات الحوكمية'),
                                        CustomRichEditor::make('governance_description_en')
                                            ->label('Description (English)')
                                            ->default('We help establish strong governance frameworks to ensure compliance, risk management, and long-term sustainability, enabling better decision-making and control over asset diversification.')
                                            ->simple(),
                                        CustomRichEditor::make('governance_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('نساعد في إنشاء أطر حوكمية قوية لضمان الامتثال وإدارة المخاطر والاستدامة طويلة المدى، مما يتيح اتخاذ قرارات أفضل والتحكم في تنويع الأصول.')
                                            ->simple(),
                                        ...ImageWithAlt::make('governance_background', 'Background Image (Desktop)', fn ($component) => $component->directory('services/governance')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        ...ImageWithAlt::make('governance_mobile_background', 'Background Image (Mobile)', fn ($component) => $component->directory('services/governance')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        FileUpload::make('governance_image')
                                            ->label('Service Image (Desktop)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/governance')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        FileUpload::make('governance_mobile_image')
                                            ->label('Service Image (Mobile)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/governance')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        TextInput::make('governance_read_more_text_en')
                                            ->label('Read More Button Text (English)')
                                            ->default('READ MORE'),
                                        TextInput::make('governance_read_more_text_ar')
                                            ->label('Read More Button Text (Arabic)')
                                            ->default('اقرأ المزيد'),
                                        TextInput::make('governance_link')
                                            ->label('Service Link')
                                            ->default('/governance-services'),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Wealth Planning Tab
                        Tabs\Tab::make('Wealth Planning')
                            ->schema([
                                Section::make('Wealth Planning Content')
                                    ->schema([
                                        TextInput::make('wealth_title_en')
                                            ->label('Title (English)')
                                            ->default('WEALTH PLANNING')
                                            ->required(),
                                        TextInput::make('wealth_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('تخطيط الثروات'),
                                        CustomRichEditor::make('wealth_description_en')
                                            ->label('Description (English)')
                                            ->default('Our strategic wealth planning solutions are designed to protect, grow, and transfer wealth efficiently, ensuring financial security for future generations while optimizing tax and investment structures.')
                                            ->simple(),
                                        CustomRichEditor::make('wealth_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('تم تصميم حلول تخطيط الثروات الاستراتيجية لدينا لحماية ونمو ونقل الثروات بكفاءة، مما يضمن الأمان المالي للأجيال القادمة مع تحسين الهياكل الضريبية والاستثمارية.')
                                            ->simple(),
                                        ...ImageWithAlt::make('wealth_background', 'Background Image (Desktop)', fn ($component) => $component->directory('services/wealth')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        ...ImageWithAlt::make('wealth_mobile_background_image', 'Background Image (Mobile)', fn ($component) => $component->directory('services/wealth')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        FileUpload::make('wealth_image')
                                            ->label('Service Image (Desktop)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/wealth')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        FileUpload::make('wealth_mobile_image')
                                            ->label('Service Image (Mobile)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/wealth')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        TextInput::make('wealth_read_more_text_en')
                                            ->label('Read More Button Text (English)')
                                            ->default('READ MORE'),
                                        TextInput::make('wealth_read_more_text_ar')
                                            ->label('Read More Button Text (Arabic)')
                                            ->default('اقرأ المزيد'),
                                        TextInput::make('wealth_link')
                                            ->label('Service Link')
                                            ->default('/wealth-planning-services'),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Strategic Investment Advisory Tab
                        Tabs\Tab::make('Strategic Investment Advisory')
                            ->schema([
                                Section::make('Strategic Investment Advisory Content')
                                    ->schema([
                                        TextInput::make('investment_title_en')
                                            ->label('Title (English)')
                                            ->default('STRATEGIC INVESTMENT ADVISORY')
                                            ->required(),
                                        TextInput::make('investment_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('الاستشارات الاستثمارية الاستراتيجية'),
                                        CustomRichEditor::make('investment_description_en')
                                            ->label('Description (English)')
                                            ->default('We provide data-driven investment strategies that align with your long-term goals, ensuring optimal asset allocation, risk management, and performance tracking for sustainable capital growth.')
                                            ->simple(),
                                        CustomRichEditor::make('investment_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('نقدم استراتيجيات استثمارية مدفوعة بالبيانات تتوافق مع أهدافك طويلة المدى، مما يضمن التخصيص الأمثل للأصول وإدارة المخاطر وتتبع الأداء للنمو الرأسمالي المستدام.')
                                            ->simple(),
                                        ...ImageWithAlt::make('investment_background', 'Background Image (Desktop)', fn ($component) => $component->directory('services/investment')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        ...ImageWithAlt::make('investment_mobile_background', 'Background Image (Mobile)', fn ($component) => $component->directory('services/investment')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        FileUpload::make('investment_image')
                                            ->label('Service Image (Desktop)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/investment')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        FileUpload::make('investment_mobile_image')
                                            ->label('Service Image (Mobile)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/investment')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        TextInput::make('investment_read_more_text_en')
                                            ->label('Read More Button Text (English)')
                                            ->default('READ MORE'),
                                        TextInput::make('investment_read_more_text_ar')
                                            ->label('Read More Button Text (Arabic)')
                                            ->default('اقرأ المزيد'),
                                        TextInput::make('investment_link')
                                            ->label('Service Link')
                                            ->default('/investment-services'),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // CIO Office Services Tab
                        Tabs\Tab::make('CIO Office Services')
                            ->schema([
                                Section::make('CIO Office Services Content')
                                    ->schema([
                                        TextInput::make('cio_title_en')
                                            ->label('Title (English)')
                                            ->default('CIO OFFICE SERVICES')
                                            ->required(),
                                        TextInput::make('cio_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('خدمات مكتب المدير التنفيذي للاستثمار'),
                                        CustomRichEditor::make('cio_description_en')
                                            ->label('Description (English)')
                                            ->default('Our outsourced CIO services offer institutional-grade portfolio management, helping organizations enhance efficiency, maintain governance, and implement robust performance monitoring frameworks.')
                                            ->simple(),
                                        CustomRichEditor::make('cio_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('تقدم خدمات المدير التنفيذي للاستثمار الخارجية لدينا إدارة محافظ من المستوى المؤسسي، مما يساعد المؤسسات على تعزيز الكفاءة والحفاظ على الحوكمة وتنفيذ أطر مراقبة الأداء القوية.')
                                            ->simple(),
                                        ...ImageWithAlt::make('cio_background', 'Background Image (Desktop)', fn ($component) => $component->directory('services/cio')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        ...ImageWithAlt::make('cio_mobile_background_image', 'Background Image (Mobile)', fn ($component) => $component->directory('services/cio')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                        FileUpload::make('cio_image')
                                            ->label('Service Image (Desktop)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/cio')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        FileUpload::make('cio_mobile_image')
                                            ->label('Service Image (Mobile)')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/cio')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                        TextInput::make('cio_read_more_text_en')
                                            ->label('Read More Button Text (English)')
                                            ->default('READ MORE'),
                                        TextInput::make('cio_read_more_text_ar')
                                            ->label('Read More Button Text (Arabic)')
                                            ->default('اقرأ المزيد'),
                                        TextInput::make('cio_link')
                                            ->label('Service Link')
                                            ->default('/cio-services'),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // Roadmap Tab
                        Tabs\Tab::make('Roadmap')
                            ->schema([
                                Section::make('Roadmap Content')
                                    ->schema([
                                        TextInput::make('roadmap_title_en')
                                            ->label('Roadmap Title (English)')
                                            ->default('CLIENT\'S ROAD MAP')
                                            ->required(),
                                        TextInput::make('roadmap_title_ar')
                                            ->label('Roadmap Title (Arabic)')
                                            ->default('خريطة طريق العميل'),
                                        FileUpload::make('roadmap_mobile_image')
                                            ->label('Roadmap Mobile Image')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('services/roadmap')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg']),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                                
                                Section::make('Roadmap Steps')
                                    ->schema([
                                        Repeater::make('roadmap_steps')
                                            ->label('Roadmap Steps')
                                            ->schema([
                                                TextInput::make('title_en')
                                                    ->label('Step Title (English)')
                                                    ->required(),
                                                TextInput::make('title_ar')
                                                    ->label('Step Title (Arabic)'),
                                                FileUpload::make('icon')
                                                    ->label('Step Icon')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->directory('services/roadmap/steps')
                                                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg']),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(8)
                                            ->addActionLabel('Add Step')
                                            ->default([
                                                ['title_en' => 'Strategic Decision', 'title_ar' => 'قرار استراتيجي'],
                                                ['title_en' => 'Governance', 'title_ar' => 'الحوكمة'],
                                                ['title_en' => 'Current portfolio analysis', 'title_ar' => 'تحليل المحفظة الحالية'],
                                                ['title_en' => 'Investment Policy Statement', 'title_ar' => 'بيان السياسة الاستثمارية'],
                                                ['title_en' => 'Investment Implementation', 'title_ar' => 'تنفيذ الاستثمار'],
                                                ['title_en' => 'Investment Structure', 'title_ar' => 'هيكل الاستثمار'],
                                                ['title_en' => 'Managers Search & Selection', 'title_ar' => 'البحث عن المديرين والاختيار'],
                                                ['title_en' => 'Monitoring Performance', 'title_ar' => 'مراقبة الأداء'],
                                            ]),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),

                        // CTA Section Tab
                        Tabs\Tab::make('CTA Section')
                            ->schema([
                                Section::make('CTA Content')
                                    ->schema([
                                        TextInput::make('cta_title_en')
                                            ->label('CTA Title (English)')
                                            ->default('READY TO START GROWING?!')
                                            ->required(),
                                        TextInput::make('cta_title_ar')
                                            ->label('CTA Title (Arabic)')
                                            ->default('مستعد لبدء النمو؟!'),
                                        CustomRichEditor::make('cta_subtitle_en')
                                            ->label('CTA Subtitle (English)')
                                            ->default('Unlock the full potential of your wealth')
                                            ->simple(),
                                        CustomRichEditor::make('cta_subtitle_ar')
                                            ->label('CTA Subtitle (Arabic)')
                                            ->default('أطلق العنان لإمكانات ثروتك الكاملة')
                                            ->simple(),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                                
                                Section::make('CTA Buttons')
                                    ->schema([
                                        TextInput::make('cta_button_1_text_en')
                                            ->label('Button 1 Text (English)')
                                            ->default('JOIN OUR MAILING LIST')
                                            ->required(),
                                        TextInput::make('cta_button_1_text_ar')
                                            ->label('Button 1 Text (Arabic)')
                                            ->default('انضم إلى قائمة البريد الإلكتروني'),
                                        TextInput::make('cta_button_1_url')
                                            ->label('Button 1 URL')
                                            ->default('/contact-us')
                                            ->required(),
                                        TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->required(),
                                        TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text (Arabic)')
                                            ->default('اطلب اجتماعاً'),
                                        TextInput::make('cta_button_2_url')
                                            ->label('Button 2 URL')
                                            ->default('/request-meeting')
                                            ->required(),
                                    ])->columns(2)
                                      ->columnSpanFull(),
                                
                                Section::make('CTA Background')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'CTA Background Image', fn ($component) => $component->directory('services/cta')->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Hero Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description_title_en')
                    ->label('Description Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateServices::route('/create'),
            'edit' => Pages\EditServices::route('/{record}/edit'),
        ];
    }
}
