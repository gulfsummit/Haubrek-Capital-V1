<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AppResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\App;
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

class AppResource extends Resource
{
    protected static ?string $model = App::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationGroup = 'Page Builder';
    protected static ?string $navigationLabel = 'App';
    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'App Page';

    protected static ?string $pluralModelLabel = 'App Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('App Page Content')
                    ->tabs([
                        SectionVisibility::tab([
                            'hero' => 'Hero Section',
                            'promo' => 'Investment App Promo Section',
                            'bottom' => 'Bottom Half Section',
                            'connect' => 'Connect Section',
                            'documentation' => 'Documentation Section',
                            'knowledge' => 'Knowledge Section',
                            'security' => 'Security Section',
                            'cta' => 'CTA Section',
                        ]),
                        // Hero Section
                        Tabs\Tab::make('Hero Section')
                            ->schema([
                                Section::make('Hero Content')
                                    ->schema([
                                        TextInput::make('hero_title_en')
                                            ->label('Title (English)')
                                            ->default('HAUBERK CAPITAL APP'),
                                        TextInput::make('hero_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('تطبيق هوبيرك كابيتال'),
                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Your Portfolio in Your Pocket')
                                            ->simple(),
                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('محفظتك في جيبك')
                                            ->simple(),
                                    ])
                                    ->columns(2),
                                Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/hero')),
                                        ...ImageWithAlt::make('hero_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/hero')),
                                    ])
                                    ->columns(2),
                            ]),

                        // Investment App Promo Section
                        Tabs\Tab::make('Investment App Promo')
                            ->schema([
                                Section::make('Promo Content')
                                    ->schema([
                                        TextInput::make('promo_title_en')
                                            ->label('Title (English)')
                                            ->default('INVESTMENT MADE SIMPLE ONE APP, TOTAL CONTROL'),
                                        TextInput::make('promo_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('الاستثمار مبسط في تطبيق واحد، تحكم كامل'),
                                        CustomRichEditor::make('promo_description_en')
                                            ->label('Description (English)')
                                            ->default('Take full control of your investments with the Hauberk Capital mobile app—your ultimate financial companion designed for efficiency, security, and real-time decision-making.')
                                            ->simple(),
                                        CustomRichEditor::make('promo_description_ar')
                                            ->label('Description (Arabic)')
                                            ->default('تحكم كامل في استثماراتك مع تطبيق هوبيرك كابيتال المحمول—رفيقك المالي الأمثل المصمم للكفاءة والأمان واتخاذ القرارات في الوقت الفعلي.')
                                            ->simple(),
                                    ])
                                    ->columns(2),
                                Section::make('Promo Images')
                                    ->schema([
                                        ...ImageWithAlt::make('promo_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/promo')),
                                        ...ImageWithAlt::make('promo_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/promo')),
                                        ...ImageWithAlt::make('promo_mobile_1_image', 'Mobile Image 1', fn ($component) => $component->directory('app/promo')),
                                        ...ImageWithAlt::make('promo_mobile_3_image', 'Mobile Image 3', fn ($component) => $component->directory('app/promo')),
                                    ])
                                    ->columns(2),
                            ]),

                        // Bottom Half Section
                        Tabs\Tab::make('Bottom Half Section')
                            ->schema([
                                Section::make('Bottom Content')
                                    ->schema([
                                        TextInput::make('bottom_title_en')
                                            ->label('Title (English)')
                                            ->default('EFFORTLESSLY MONITOR YOUR INVESTMENTS'),
                                        TextInput::make('bottom_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('راقب استثماراتك بسهولة'),
                                        TextInput::make('bottom_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Managing Portfolio, Always Accessible'),
                                        TextInput::make('bottom_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('إدارة المحفظة، متاحة دائماً'),
                                    ])
                                    ->columns(2),
                                Section::make('Bottom Bullet Points')
                                    ->schema([
                                        Repeater::make('bottom_bullet_points_en')
                                            ->label('Bullet Points (English)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('24/7 account access to manage your wealth seamlessly.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => '24/7 account access to manage your wealth seamlessly.'],
                                                ['point' => 'Real-time portfolio insights with interactive dashboards.'],
                                                ['point' => 'Performance analytics to help you make informed decisions.']
                                            ]),
                                        Repeater::make('bottom_bullet_points_ar')
                                            ->label('Bullet Points (Arabic)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('وصول 24/7 للحساب لإدارة ثروتك بسلاسة.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'وصول 24/7 للحساب لإدارة ثروتك بسلاسة.'],
                                                ['point' => 'رؤى المحفظة في الوقت الفعلي مع لوحات تفاعلية.'],
                                                ['point' => 'تحليلات الأداء لمساعدتك في اتخاذ قرارات مدروسة.']
                                            ]),
                                    ])
                                    ->columns(2),
                                Section::make('Bottom Images')
                                    ->schema([
                                        ...ImageWithAlt::make('bottom_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/bottom')),
                                        ...ImageWithAlt::make('bottom_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/bottom')),
                                        ...ImageWithAlt::make('bottom_mobile_image', 'Mobile Phone Image', fn ($component) => $component->directory('app/bottom')->columnSpanFull()),
                                    ])
                                    ->columns(2),
                            ]),

                        // Connect Section
                        Tabs\Tab::make('Connect Section')
                            ->schema([
                                Section::make('Connect Content')
                                    ->schema([
                                        TextInput::make('connect_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('ENGAGE DIRECTLY WITH OUR TEAM'),
                                        TextInput::make('connect_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('تواصل مباشرة مع فريقنا'),
                                        TextInput::make('connect_title_en')
                                            ->label('Title (English)')
                                            ->default('Connect with Your Investment Experts'),
                                        TextInput::make('connect_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('تواصل مع خبراء الاستثمار لديك'),
                                    ])
                                    ->columns(2),
                                Section::make('Connect Bullet Points')
                                    ->schema([
                                        Repeater::make('connect_bullet_points_en')
                                            ->label('Bullet Points (English)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('Instant chat & video calls with your dedicated investment manager.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'Instant chat & video calls with your dedicated investment manager.'],
                                                ['point' => 'Access expert recommendations tailored to your financial goals.'],
                                                ['point' => 'Join exclusive discussions on market trends and strategies.']
                                            ]),
                                        Repeater::make('connect_bullet_points_ar')
                                            ->label('Bullet Points (Arabic)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('دردشة فورية ومكالمات فيديو مع مدير الاستثمار المخصص لك.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'دردشة فورية ومكالمات فيديو مع مدير الاستثمار المخصص لك.'],
                                                ['point' => 'احصل على توصيات خبيرة مخصصة لأهدافك المالية.'],
                                                ['point' => 'انضم إلى مناقشات حصرية حول اتجاهات السوق والاستراتيجيات.']
                                            ]),
                                    ])
                                    ->columns(2),
                                Section::make('Connect Images')
                                    ->schema([
                                        ...ImageWithAlt::make('connect_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/connect')),
                                        ...ImageWithAlt::make('connect_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/connect')),
                                        ...ImageWithAlt::make('connect_mobile_image', 'Mobile Image', fn ($component) => $component->directory('app/connect')),
                                    ])
                                    ->columns(2),
                            ]),

                        // Documentation Section
                        Tabs\Tab::make('Documentation Section')
                            ->schema([
                                Section::make('Documentation Content')
                                    ->schema([
                                        TextInput::make('docs_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Manage all your financial documents'),
                                        TextInput::make('docs_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('أدر جميع مستنداتك المالية'),
                                        TextInput::make('docs_title_en')
                                            ->label('Title (English)')
                                            ->default('Secure & Smart Documentation'),
                                        TextInput::make('docs_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('توثيق آمن وذكي'),
                                    ])
                                    ->columns(2),
                                Section::make('Documentation Bullet Points')
                                    ->schema([
                                        Repeater::make('docs_bullet_points_en')
                                            ->label('Bullet Points (English)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('E-signature support for quick approvals.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'E-signature support for quick approvals.'],
                                                ['point' => 'Safe digital archive for legal and investment documents.'],
                                                ['point' => 'Online KYC & regulatory compliance—fast and hassle-free.']
                                            ]),
                                        Repeater::make('docs_bullet_points_ar')
                                            ->label('Bullet Points (Arabic)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('دعم التوقيع الإلكتروني للموافقات السريعة.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'دعم التوقيع الإلكتروني للموافقات السريعة.'],
                                                ['point' => 'أرشيف رقمي آمن للمستندات القانونية والاستثمارية.'],
                                                ['point' => 'التحقق من الهوية والامتثال التنظيمي عبر الإنترنت—سريع وخالي من المتاعب.']
                                            ]),
                                    ])
                                    ->columns(2),
                                Section::make('Documentation Images')
                                    ->schema([
                                        ...ImageWithAlt::make('docs_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/docs')),
                                        ...ImageWithAlt::make('docs_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/docs')),
                                        ...ImageWithAlt::make('docs_mobile_image', 'Mobile Image', fn ($component) => $component->directory('app/docs')),
                                    ])
                                    ->columns(2),
                            ]),

                        // Knowledge Section
                        Tabs\Tab::make('Knowledge Section')
                            ->schema([
                                Section::make('Knowledge Content')
                                    ->schema([
                                        TextInput::make('knowledge_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('access to premium financial education and industry expertise.'),
                                        TextInput::make('knowledge_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('الوصول إلى التعليم المالي المميز والخبرة الصناعية.'),
                                        TextInput::make('knowledge_title_en')
                                            ->label('Title (English)')
                                            ->default('Exclusive Knowledge & Investment Insights'),
                                        TextInput::make('knowledge_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('معرفة حصرية ورؤى استثمارية'),
                                    ])
                                    ->columns(2),
                                Section::make('Knowledge Bullet Points')
                                    ->schema([
                                        Repeater::make('knowledge_bullet_points_en')
                                            ->label('Bullet Points (English)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('Live & recorded webinars with market leaders.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'Live & recorded webinars with market leaders.'],
                                                ['point' => 'Interactive learning circles covering investment strategies.'],
                                                ['point' => 'Personalized market updates tailored to your portfolio.']
                                            ]),
                                        Repeater::make('knowledge_bullet_points_ar')
                                            ->label('Bullet Points (Arabic)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('ندوات عبر الإنترنت مباشرة ومسجلة مع قادة السوق.'),
                                            ])
                                            ->defaultItems(3)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'ندوات عبر الإنترنت مباشرة ومسجلة مع قادة السوق.'],
                                                ['point' => 'دوائر تعليمية تفاعلية تغطي استراتيجيات الاستثمار.'],
                                                ['point' => 'تحديثات السوق المخصصة لمحفظتك.']
                                            ]),
                                    ])
                                    ->columns(2),
                                Section::make('Knowledge Images')
                                    ->schema([
                                        ...ImageWithAlt::make('knowledge_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/knowledge')),
                                        ...ImageWithAlt::make('knowledge_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/knowledge')),
                                        ...ImageWithAlt::make('knowledge_mobile_image', 'Mobile Image', fn ($component) => $component->directory('app/knowledge')),
                                    ])
                                    ->columns(2),
                            ]),

                        // Security Section
                        Tabs\Tab::make('Security Section')
                            ->schema([
                                Section::make('Security Content')
                                    ->schema([
                                        TextInput::make('security_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('with advanced encryption and multi-layered security protocols.'),
                                        TextInput::make('security_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('مع التشفير المتقدم وبروتوكولات الأمان متعددة الطبقات.'),
                                        TextInput::make('security_title_en')
                                            ->label('Title (English)')
                                            ->default('Security You Can Trust'),
                                        TextInput::make('security_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('أمان يمكنك الوثوق به'),
                                    ])
                                    ->columns(2),
                                Section::make('Security Bullet Points')
                                    ->schema([
                                        Repeater::make('security_bullet_points_en')
                                            ->label('Bullet Points (English)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('Biometric authentication for secure logins.'),
                                            ])
                                            ->defaultItems(2)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'Biometric authentication for secure logins.'],
                                                ['point' => 'Real-time fraud detection & alerts.']
                                            ]),
                                        Repeater::make('security_bullet_points_ar')
                                            ->label('Bullet Points (Arabic)')
                                            ->schema([
                                                TextInput::make('point')
                                                    ->label('Point')
                                                    ->required()
                                                    ->default('المصادقة البيومترية لتسجيلات الدخول الآمنة.'),
                                            ])
                                            ->defaultItems(2)
                                            ->addActionLabel('Add Point')
                                            ->default([
                                                ['point' => 'المصادقة البيومترية لتسجيلات الدخول الآمنة.'],
                                                ['point' => 'كشف الاحتيال في الوقت الفعلي والتنبيهات.']
                                            ]),
                                    ])
                                    ->columns(2),
                                Section::make('Security Images')
                                    ->schema([
                                        ...ImageWithAlt::make('security_background_image', 'Desktop Background Image', fn ($component) => $component->directory('app/security')),
                                        ...ImageWithAlt::make('security_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('app/security')),
                                        ...ImageWithAlt::make('security_mobile_image', 'Mobile Image', fn ($component) => $component->directory('app/security')),
                                    ])
                                    ->columns(2),
                            ]),

                        // CTA Section
                        Tabs\Tab::make('CTA Section')
                            ->schema([
                                Section::make('CTA Content')
                                    ->schema([
                                        TextInput::make('cta_title_en')
                                            ->label('Title (English)')
                                            ->default('READY TO START GROWING?!'),
                                        TextInput::make('cta_title_ar')
                                            ->label('Title (Arabic)')
                                            ->default('مستعد لبدء النمو؟!'),
                                        CustomRichEditor::make('cta_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Unlock the full potential of your wealth')
                                            ->simple(),
                                        CustomRichEditor::make('cta_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->default('أطلق العنان لإمكانات ثروتك الكاملة')
                                            ->simple(),
                                    ])
                                    ->columns(2),
                                Section::make('CTA Buttons')
                                    ->schema([
                                        TextInput::make('cta_button_1_text_en')
                                            ->label('Button 1 Text (English)')
                                            ->default('JOIN OUR MAILING LIST'),
                                        TextInput::make('cta_button_1_text_ar')
                                            ->label('Button 1 Text (Arabic)')
                                            ->default('انضم إلى قائمة البريد الإلكتروني'),
                                        TextInput::make('cta_button_1_url')
                                            ->label('Button 1 URL')
                                            ->default('/contact-us'),
                                        TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text (English)')
                                            ->default('REQUEST A MEETING'),
                                        TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text (Arabic)')
                                            ->default('اطلب اجتماعاً'),
                                        TextInput::make('cta_button_2_url')
                                            ->label('Button 2 URL')
                                            ->default('/request-meeting'),
                                    ])
                                    ->columns(2),
                                Section::make('CTA Images')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'Background Image', fn ($component) => $component->directory('app/cta')),
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
                    ->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApps::route('/'),
            'create' => Pages\CreateApp::route('/create'),
            'edit' => Pages\EditApp::route('/{record}/edit'),
        ];
    }
}
