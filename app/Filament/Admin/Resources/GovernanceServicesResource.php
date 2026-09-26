<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GovernanceServicesResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\GovernanceServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Forms\Components\CustomRichEditor;
use Filament\Tables;
use Filament\Tables\Table;

class GovernanceServicesResource extends Resource
{
    protected static ?string $model = GovernanceServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationGroup = 'Page Builder';
    
    protected static ?string $navigationLabel = 'Governance';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Governance Services Content')
                    ->columnSpanFull()
                    ->tabs([
                        SectionVisibility::tab([
                            'hero' => 'Hero Section',
                            'overview' => 'Services Overview Section',
                            'approach' => 'Approach Section',
                            'steps' => 'Steps Section',
                            'why_choose' => 'Why Choose Us Section',
                            'cta' => 'CTA Section',
                        ]),
                        // Hero Section Tab
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->schema([
                                Forms\Components\Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background Image', fn ($component) => $component->directory('governance-services/hero')->default('images/governance-innerpage-pg.png')->columnSpan(1)),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background Image', fn ($component) => $component->directory('governance-services/hero')->default('images/mobile-governance-innerpage-pg.png')->columnSpan(1)),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Hero Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Title (English)')
                                            ->default('GOVERNANCE SERVICES')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('خدمات الحوكمة')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('hero_subtitle_en')
                                        ->label('Subtitle (English)')
                                            ->default('Tailored Governance for Lasting Prosperity')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('حوكمة مخصصة للازدهار الدائم')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_text_en')
                                            ->label('Button Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_text_ar')
                                            ->label('Button Text (Arabic)')
                                            ->default('اطلب اجتماع')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_url')
                                            ->label('Button URL')
                                            ->default('request-a-meeting')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ]),

                        // Services Overview Tab
                        Forms\Components\Tabs\Tab::make('Services Overview')
                            ->schema([
                                Forms\Components\Section::make('Section Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('services_title_en')
                                            ->label('Title (English)')
                                            ->default('GOVERNANCE SERVICES')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('services_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('خدمات الحوكمة')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('services_description_en')
                                            ->label('Description (English)')
                                            ->default('In today\'s complex financial landscape, managing and safeguarding wealth requires addressing several critical challenges:')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('services_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('في المشهد المالي المعقد اليوم، تتطلب إدارة الثروة وحمايتها معالجة عدة تحديات حاسمة:')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Service Cards')
                                    ->schema([
                                        Forms\Components\Repeater::make('services_cards')
                                            ->label('Service Cards')
                                            ->schema([
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Description (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Description (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(6)
                                            ->default([
                                                [
                                                    'title_en' => 'SETUP OF FAMILY CONSTITUTIONS',
                                                    'title_ar' => 'إعداد دساتير الأسرة',
                                                    'description_en' => 'Setup up a new investment and legal structure or strengthen an existing one for protecting and governing the current wealth.',
                                                    'description_ar' => 'إعداد هيكل استثماري وقانوني جديد أو تعزيز الهيكل الموجود لحماية وإدارة الثروة الحالية.',
                                                ],
                                                [
                                                    'title_en' => 'SETUP OF ENDOWMENTS',
                                                    'title_ar' => 'إعداد الأوقاف',
                                                    'description_en' => 'Setup of Endowments and foundation deeds. Design the investment office and Endowment fund organization structure.',
                                                    'description_ar' => 'إعداد الأوقاف وصكوك المؤسسات. تصميم مكتب الاستثمار وهيكل تنظيم صندوق الوقف.',
                                                ],
                                                [
                                                    'title_en' => 'FAMILY OFFICE SETUP',
                                                    'title_ar' => 'إعداد المكتب العائلي',
                                                    'description_en' => 'Comprehensive family office establishment including governance frameworks, operational structures, and succession planning protocols.',
                                                    'description_ar' => 'إنشاء مكتب عائلي شامل يتضمن أطر الحوكمة والهياكل التشغيلية وبروتوكولات التخطيط للخلافة.',
                                                ],
                                                [
                                                    'title_en' => 'WEALTH TRANSFER PLANNING',
                                                    'title_ar' => 'تخطيط نقل الثروة',
                                                    'description_en' => 'Strategic planning for intergenerational wealth transfer with focus on tax efficiency, legal compliance, and preservation of family values.',
                                                    'description_ar' => 'التخطيط الاستراتيجي لنقل الثروة بين الأجيال مع التركيز على الكفاءة الضريبية والامتثال القانوني والحفاظ على القيم الأسرية.',
                                                ],
                                                [
                                                    'title_en' => 'GOVERNANCE AUDITS',
                                                    'title_ar' => 'مراجعات الحوكمة',
                                                    'description_en' => 'Comprehensive assessment of existing governance structures with actionable recommendations for optimization and risk mitigation.',
                                                    'description_ar' => 'تقييم شامل لهياكل الحوكمة الحالية مع توصيات قابلة للتنفيذ للتحسين وتخفيف المخاطر.',
                                                ],
                                                [
                                                    'title_en' => 'REGULATORY COMPLIANCE',
                                                    'title_ar' => 'الامتثال التنظيمي',
                                                    'description_en' => 'Expert guidance on navigating complex regulatory environments across multiple jurisdictions to ensure full compliance and risk management.',
                                                    'description_ar' => 'إرشاد خبير للتنقل في البيئات التنظيمية المعقدة عبر ولايات قضائية متعددة لضمان الامتثال الكامل وإدارة المخاطر.',
                                                ],
                                            ]),
                                    ]),
                            ]),

                        // Approach Section Tab
                        Forms\Components\Tabs\Tab::make('Approach Section')
                            ->schema([
                                Forms\Components\Section::make('Background & Title')
                                    ->schema([
                                        ...ImageWithAlt::make('approach_background_image', 'Background Image (Desktop)', fn ($component) => $component->directory('governance-services/approach')->default('images/approach-bg.png')->columnSpan(1)),
                                        ...ImageWithAlt::make('approach_mobile_background_image', 'Background Image (Mobile)', fn ($component) => $component->directory('governance-services/approach')->columnSpan(1)),
                                        Forms\Components\TextInput::make('approach_title_en')
                                            ->label('Title (English)')
                                            ->default('GOVERNANCE APPROACH')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('approach_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('نهج الحوكمة')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Description')
                                    ->schema([
                                        CustomRichEditor::make('approach_description_en')
                                            ->label('Description 1 (English)')
                                            ->default('At Hauberk Capital, we differentiate ourselves through an innovative approach to wealth governance that prioritizes customization, strategic alignment, and sustainable outcomes.')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('approach_description_ar')
                                            ->label('Description 1 (Arabic)')
                                            ->default('في هوبرك كابيتال، نميز أنفسنا من خلال نهج مبتكر لحوكمة الثروة يعطي الأولوية للتخصيص والتوافق الاستراتيجي والنتائج المستدامة.')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Approach Items')
                                    ->schema([
                                        Forms\Components\Repeater::make('approach_items')
                                            ->label('Approach Items')
                                            ->schema([
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('content_en')
                                                    ->label('Content (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('content_ar')
                                                    ->label('Content (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\Toggle::make('is_expanded')
                                                    ->label('Initially Expanded')
                                                    ->default(false)
                                                    ->columnSpan(2),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(4)
                                            ->default([
                                                [
                                                    'title_en' => 'Personalization and Customization',
                                                    'title_ar' => 'التخصيص والتخصيص',
                                                    'content_en' => 'Our top priority is meeting our clients\' objectives and evolving needs - We align our services with the core values of our philosophy.',
                                                    'content_ar' => 'أولويتنا القصوى هي تلبية أهداف عملائنا واحتياجاتهم المتطورة - نحن نوائم خدماتنا مع القيم الأساسية لفلسفتنا.',
                                                    'is_expanded' => true,
                                                ],
                                                [
                                                    'title_en' => 'Integrated Expertise',
                                                    'title_ar' => 'الخبرة المتكاملة',
                                                    'content_en' => 'Our long-term relationships with clients and partners are built on trust and mutual respect. - We consistently provide reliable, cost-effective solutions.',
                                                    'content_ar' => 'علاقاتنا طويلة المدى مع العملاء والشركاء مبنية على الثقة والاحترام المتبادل. - نقدم باستمرار حلولاً موثوقة وفعالة من حيث التكلفة.',
                                                    'is_expanded' => false,
                                                ],
                                                [
                                                    'title_en' => 'Strategic Frameworks',
                                                    'title_ar' => 'الأطر الاستراتيجية',
                                                    'content_en' => 'Our long-term relationships with clients and partners are built on trust and mutual respect. - We consistently provide reliable, cost-effective solutions.',
                                                    'content_ar' => 'علاقاتنا طويلة المدى مع العملاء والشركاء مبنية على الثقة والاحترام المتبادل. - نقدم باستمرار حلولاً موثوقة وفعالة من حيث التكلفة.',
                                                    'is_expanded' => false,
                                                ],
                                                [
                                                    'title_en' => 'Continuous Innovation',
                                                    'title_ar' => 'الابتكار المستمر',
                                                    'content_en' => 'We stay at the forefront of technological advancements through continuous research and development. - We are committed to staying ahead of market trends and evolving investor needs.',
                                                    'content_ar' => 'نبقى في المقدمة في التطورات التكنولوجية من خلال البحث والتطوير المستمر. - نحن ملتزمون بالبقاء في المقدمة في اتجاهات السوق واحتياجات المستثمرين المتطورة.',
                                                    'is_expanded' => false,
                                                ],
                                            ]),
                                    ]),
                            ]),

                        // Steps Section Tab
                        Forms\Components\Tabs\Tab::make('Steps Section')
                            ->schema([
                                Forms\Components\Section::make('Section Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('steps_title_en')
                                            ->label('Title (English)')
                                            ->default('STEPS TO START')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('خطوات البدء')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Your Wealth Governance')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('حوكمة ثروتك')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Steps')
                                    ->schema([
                                        Forms\Components\Repeater::make('steps_items')
                                            ->label('Steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('number')
                                                    ->label('Step Number')
                                                    ->required()
                                                    ->numeric()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(4)
                                            ->default([
                                                [
                                                    'number' => 1,
                                                    'title_en' => 'INITIAL CONSULTATION',
                                                    'title_ar' => 'الاستشارة الأولية',
                                                ],
                                                [
                                                    'number' => 2,
                                                    'title_en' => 'STRATEGIC PLANNING AND FRAMEWORK DEVELOPMENT',
                                                    'title_ar' => 'التخطيط الاستراتيجي وتطوير الإطار',
                                                ],
                                                [
                                                    'number' => 3,
                                                    'title_en' => 'IMPLEMENTATION OF GOVERNANCE STRUCTURES',
                                                    'title_ar' => 'تنفيذ هياكل الحوكمة',
                                                ],
                                                [
                                                    'number' => 4,
                                                    'title_en' => 'ONGOING MONITORING AND OPTIMIZATION',
                                                    'title_ar' => 'المراقبة والتحسين المستمر',
                                                ],
                                            ]),
                                    ]),
                            ]),

                        // Why Choose Us Tab
                        Forms\Components\Tabs\Tab::make('Why Choose Us')
                            ->schema([
                                Forms\Components\Section::make('Section Title')
                                    ->schema([
                                        Forms\Components\TextInput::make('why_choose_title_en')
                                            ->label('Title (English)')
                                            ->default('WHY CHOOSE US')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('why_choose_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('لماذا تختارنا')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Reasons')
                                    ->schema([
                                        Forms\Components\Repeater::make('why_choose_items')
                                            ->label('Why Choose Us Items')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->label('Image')
                                                    ->image()
                                                    ->directory('governance-services/why-choose')
                                                    ->columnSpan(2),
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Description (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Description (Arabic)')
                                                    ->required()
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(3)
                                            ->default([
                                                [
                                                    'image' => 'images/wcu-1.png',
                                                    'title_en' => 'EXPERT ADVISORS',
                                                    'title_ar' => 'مستشارون خبراء',
                                                    'description_en' => 'Our team comprises seasoned professionals with extensive experience in wealth management, legal advisory, and family governance.',
                                                    'description_ar' => 'يتألف فريقنا من محترفين ذوي خبرة واسعة في إدارة الثروات والاستشارات القانونية وحوكمة الأسرة.',
                                                ],
                                                [
                                                    'image' => 'images/wcu-2.png',
                                                    'title_en' => 'HOLISTIC APPROACH',
                                                    'title_ar' => 'نهج شمولي',
                                                    'description_en' => 'Our integrated approach considers all aspects of wealth governance, from financial advisory to legal compliance and family dynamics.',
                                                    'description_ar' => 'نهجنا المتكامل يأخذ في الاعتبار جميع جوانب حوكمة الثروة، من الاستشارات المالية إلى الامتثال القانوني وديناميكيات الأسرة.',
                                                ],
                                                [
                                                    'image' => 'images/wcu-3.png',
                                                    'title_en' => 'TAILORED SOLUTIONS',
                                                    'title_ar' => 'حلول مخصصة',
                                                    'description_en' => 'We understand that every client is unique, and we tailor our services to meet your specific needs and goals with highest standards of ethics & transparency.',
                                                    'description_ar' => 'نحن نفهم أن كل عميل فريد، ونخصص خدماتنا لتلبية احتياجاتك وأهدافك المحددة بأعلى معايير الأخلاق والشفافية.',
                                                ],
                                            ]),
                                    ]),
                            ]),

                        // CTA Section Tab
                        Forms\Components\Tabs\Tab::make('CTA Section')
                            ->schema([
                                Forms\Components\Section::make('Background & Content')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'Background Image', fn ($component) => $component->directory('governance-services/cta')->default('images/meeting-bg.png')->columnSpan(2)),
                                        Forms\Components\TextInput::make('cta_title_en')
                                            ->label('Title (English)')
                                            ->default('READY TO START GROWING?!')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('مستعد لبدء النمو؟!')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('cta_description_en')
                                            ->label('Description (English)')
                                            ->default('Unlock the full potential of your wealth')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('cta_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('اطلق العنان للإمكانات الكاملة لثروتك')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                                    
                                Forms\Components\Section::make('Buttons')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_button_1_text_en')
                                            ->label('Button 1 Text (English)')
                                            ->default('JOIN OUR MAILING LIST')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_1_text_ar')
                                            ->label('Button 1 Text (Arabic)')
                                            ->default('انضم لقائمتنا البريدية')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_1_url')
                                            ->label('Button 1 URL')
                                            ->default('contact-us')
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text (Arabic)')
                                            ->default('اطلب اجتماع')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_2_url')
                                            ->label('Button 2 URL')
                                            ->default('request-a-meeting')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Title (EN)')
                    ->searchable()
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGovernanceServices::route('/'),
            'create' => Pages\CreateGovernanceServices::route('/create'),
            'edit' => Pages\EditGovernanceServices::route('/{record}/edit'),
        ];
    }
}

