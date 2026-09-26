<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WebsiteSettingsResource\Pages;
use App\Models\WebsiteSettings;
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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;

class WebsiteSettingsResource extends Resource
{
    protected static ?string $model = WebsiteSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Website Settings';

    protected static ?string $navigationLabel = 'Website Settings';

    protected static ?string $modelLabel = 'Website Settings';

    protected static ?string $pluralModelLabel = 'Website Settings';

    protected static ?string $slug = 'website-settings';

    protected static ?string $panel = 'admin';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Website Settings')
                    ->columnSpanFull()
                    ->tabs([
                        // Header Tab
                        Tabs\Tab::make('Header')
                            ->schema([
                                Section::make('Header Logo')
                                    ->schema([
                                        FileUpload::make('header_logo')
                                            ->label('Header Logo')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('website/header')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                            ->helperText('Upload your header logo. Recommended size: 200x60px')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Header Settings')
                                    ->schema([
                                        Select::make('header_background_type')
                                            ->label('Header Background Type')
                                            ->options([
                                                'transparent' => 'Transparent (Default)',
                                                'solid' => 'Solid Color',
                                                'gradient' => 'Gradient',
                                            ])
                                            ->default('transparent')
                                            ->reactive()
                                            ->columnSpan(1),

                                        Toggle::make('header_backdrop_blur')
                                            ->label('Enable Backdrop Blur for Header')
                                            ->default(true)
                                            ->helperText('This applies backdrop blur effect to the header across all pages')
                                            ->columnSpan(1),

                                        ColorPicker::make('header_background_color')
                                            ->label('Header Background Color')
                                            ->visible(fn (callable $get) => $get('header_background_type') === 'solid')
                                            ->columnSpan(1),

                                        ColorPicker::make('header_background_gradient_start')
                                            ->label('Gradient Start Color')
                                            ->visible(fn (callable $get) => $get('header_background_type') === 'gradient')
                                            ->columnSpan(1),

                                        ColorPicker::make('header_background_gradient_end')
                                            ->label('Gradient End Color')
                                            ->visible(fn (callable $get) => $get('header_background_type') === 'gradient')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3),



                                Section::make('Header CTA Button')
                                    ->schema([
                                        TextInput::make('header_cta_text')
                                            ->label('Button Text (English)')
                                            ->default('CLIENT\'S HUB')
                                            ->required()
                                            ->columnSpan(1),

                                        TextInput::make('header_cta_text_ar')
                                            ->label('Button Text (Arabic)')
                                            ->default('مركز العملاء')
                                            ->columnSpan(1),

                                        TextInput::make('header_cta_url')
                                            ->label('Button URL')
                                            ->default('https://hauberkcapital.moxo.com/web/910')
                                            ->required()
                                            ->columnSpan(1),

                                        ColorPicker::make('header_cta_background_color')
                                            ->label('Button Background Color')
                                            ->default('#D4AF37')
                                            ->columnSpan(1),

                                        ColorPicker::make('header_cta_text_color')
                                            ->label('Button Text Color')
                                            ->default('#FFFFFF')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Section::make('Navigation Links')
                                    ->schema([
                                        Repeater::make('navigation_links')
                                            ->label('Navigation Items')
                                            ->schema([
                                                TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),

                                                TextInput::make('route')
                                                    ->label('Route Name')
                                                    ->required()
                                                    ->helperText('Laravel route name (e.g., home, about-us)')
                                                    ->columnSpan(1),

                                                Toggle::make('has_dropdown')
                                                    ->label('Has Dropdown Menu')
                                                    ->default(false)
                                                    ->reactive()
                                                    ->columnSpan(1),

                                                Repeater::make('dropdown_items')
                                                    ->label('Dropdown Items')
                                                    ->visible(fn (callable $get) => $get('has_dropdown'))
                                                    ->schema([
                                                        TextInput::make('title_en')
                                                            ->label('Item Title (English)')
                                                            ->required()
                                                            ->columnSpan(1),

                                                        TextInput::make('title_ar')
                                                            ->label('Item Title (Arabic)')
                                                            ->columnSpan(1),

                                                        TextInput::make('route')
                                                            ->label('Item Route')
                                                            ->required()
                                                            ->columnSpan(1),
                                                    ])
                                                    ->columns(3)
                                                    ->addActionLabel('Add Dropdown Item')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columns(4)
                                            ->addActionLabel('Add Navigation Item')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ]),


                                Section::make('Language & Mobile Settings')
                                    ->schema([
                                        Select::make('default_language')
                                            ->label('Default Language')
                                            ->options([
                                                'en' => 'English',
                                                'ar' => 'Arabic',
                                            ])
                                            ->default('en')
                                            ->columnSpan(1),

                                        Toggle::make('show_language_switcher')
                                            ->label('Show Language Switcher')
                                            ->default(true)
                                            ->columnSpan(1),

                                        Toggle::make('show_mobile_menu')
                                            ->label('Show Mobile Menu')
                                            ->default(true)
                                            ->columnSpan(1),

                                        ColorPicker::make('mobile_menu_background_color')
                                            ->label('Mobile Menu Background Color')
                                            ->default('#1a1f2e')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                            ]),

                        // Contact Page Tab
                        Tabs\Tab::make('Contact Page')
                            ->schema([
                                Section::make('Contact Page Social Media')
                                    ->schema([
                                        TextInput::make('contact_social_section_title_en')
                                            ->label('Social Section Title (English)')
                                            ->default('Follow Us')
                                            ->columnSpan(1),

                                        TextInput::make('contact_social_section_title_ar')
                                            ->label('Social Section Title (Arabic)')
                                            ->default('تابعنا')
                                            ->columnSpan(1),

                                        Repeater::make('contact_social_items')
                                            ->label('Social Media Items')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Platform Name')
                                                    ->required()
                                                    ->helperText('e.g., Facebook, Instagram, LinkedIn')
                                                    ->columnSpan(1),

                                                TextInput::make('url')
                                                    ->label('URL')
                                                    ->required()
                                                    ->url()
                                                    ->helperText('Full URL to the social media page')
                                                    ->columnSpan(1),

                                                FileUpload::make('icon')
                                                    ->label('Icon')
                                                    ->image()
                                                    ->directory('website/contact-social-icons')
                                                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                                    ->helperText('Upload custom icon or leave empty for default')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(3)
                                            ->addActionLabel('Add Social Media Item')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),
                            ]),

                        // General Settings Tab
                        Tabs\Tab::make('General Settings')
                            ->schema([
                                Section::make('Website Title & Favicon')
                                    ->schema([
                                        TextInput::make('website_title_en')
                                            ->label('Website Title (English)')
                                            ->default('Hauberk Capital')
                                            ->required()
                                            ->maxLength(255)
                                            ->helperText('This appears in the browser tab and search results')
                                            ->columnSpan(1),

                                        TextInput::make('website_title_ar')
                                            ->label('Website Title (Arabic)')
                                            ->default('هاوبيرك كابيتال')
                                            ->required()
                                            ->maxLength(255)
                                            ->helperText('Arabic version of the website title')
                                            ->columnSpan(1),

                                        FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('website/favicon')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg', 'image/ico'])
                                            ->helperText('Upload your favicon. Recommended size: 32x32px or 16x16px. Supported formats: PNG, JPG, JPEG, SVG, ICO')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),

                        // Footer Tab
                        Tabs\Tab::make('Footer')
                            ->schema([
                                Section::make('Footer Layout')
                                    ->schema([
                                        ColorPicker::make('footer_settings.background_color')
                                            ->label('Footer Background Color')
                                            ->default('#041B44')
                                            ->columnSpan(1),

                                        ColorPicker::make('footer_settings.text_color')
                                            ->label('Footer Text Color')
                                            ->default('#FFFFFF')
                                            ->columnSpan(1),

                                        ColorPicker::make('footer_settings.accent_color')
                                            ->label('Footer Accent Color')
                                            ->default('#D4AF37')
                                            ->columnSpan(1),

                                        FileUpload::make('footer_settings.logo_image')
                                            ->label('Footer Logo')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('website/footer')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                            ->columnSpan(1),

                                        Toggle::make('footer_settings.show_logo_mobile')
                                            ->label('Show Logo on Mobile')
                                            ->default(true)
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3),

                                Section::make('Home Section')
                                    ->schema([
                                        TextInput::make('footer_settings.home_section_title_en')
                                            ->label('Home Section Title (English)')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.home_section_title_ar')
                                            ->label('Home Section Title (Arabic)')
                                            ->columnSpan(1),

                                        Repeater::make('footer_settings.home_items')
                                            ->label('Home Section Items')
                                            ->schema([
                                                TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),

                                                TextInput::make('url')
                                                    ->label('URL/Route')
                                                    ->required()
                                                    ->helperText('Laravel route name (e.g., about-us, faq)')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(3)
                                            ->addActionLabel('Add Home Item')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),

                                Section::make('Services Section')
                                    ->schema([
                                        TextInput::make('footer_settings.services_section_title_en')
                                            ->label('Services Section Title (English)')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.services_section_title_ar')
                                            ->label('Services Section Title (Arabic)')
                                            ->columnSpan(1),

                                        Repeater::make('footer_settings.services_items')
                                            ->label('Services Section Items')
                                            ->schema([
                                                TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),

                                                TextInput::make('url')
                                                    ->label('URL/Route')
                                                    ->required()
                                                    ->helperText('Laravel route name (e.g., services, governance-services)')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(3)
                                            ->addActionLabel('Add Service Item')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),

                                Section::make('Contact Information')
                                    ->schema([
                                        TextInput::make('footer_settings.contact_section_title_en')
                                            ->label('Contact Section Title (English)')
                                            ->default('Contact Us')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.contact_section_title_ar')
                                            ->label('Contact Section Title (Arabic)')
                                            ->default('اتصل بنا')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.phone')
                                            ->label('Phone Number')
                                            ->default('+971 4 5182591 / 2')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.email')
                                            ->label('Email Address')
                                            ->email()
                                            ->default('info@hauberkcapital.com')
                                            ->columnSpan(1),

                                        CustomRichEditor::make('footer_settings.address')
                                            ->label('Address (English)')
                                            ->default('Al Sila Tower, ADGM Square, Al Maryah Island, Abu Dhabi, United Arab Emirates')
                                            ->simple()
                                            ->columnSpan(1),

                                        CustomRichEditor::make('footer_settings.address_ar')
                                            ->label('Address (Arabic)')
                                            ->default('برج السلع، ساحة سوق أبوظبي العالمي، جزيرة المارية، أبوظبي، الإمارات العربية المتحدة')
                                            ->simple()
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Section::make('Social Media')
                                    ->schema([
                                        TextInput::make('footer_settings.social_section_title_en')
                                            ->label('Social Section Title (English)')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.social_section_title_ar')
                                            ->label('Social Section Title (Arabic)')
                                            ->columnSpan(1),

                                        Repeater::make('footer_settings.social_items')
                                            ->label('Social Media Items')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Platform Name')
                                                    ->required()
                                                    ->helperText('e.g., Facebook, Instagram, LinkedIn')
                                                    ->columnSpan(1),

                                                TextInput::make('url')
                                                    ->label('URL')
                                                    ->required()
                                                    ->url()
                                                    ->helperText('Full URL to the social media page')
                                                    ->columnSpan(1),

                                                FileUpload::make('icon')
                                                    ->label('Icon')
                                                    ->image()
                                                    ->directory('website/social-icons')
                                                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                                    ->helperText('Upload custom icon or leave empty for default')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(3)
                                            ->addActionLabel('Add Social Media Item')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),

                                Section::make('Analytics & Tracking')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('gtm_id')
                                            ->label('Google Tag Manager ID')
                                            ->placeholder('GTM-XXXXXXX')
                                            ->helperText('Paste the container ID only (e.g., GTM-XXXXXXX).'),
                                        TextInput::make('google_analytics_id')
                                            ->label('Google Analytics ID')
                                            ->placeholder('G-XXXXXXXXXX')
                                            ->helperText('GA4 Measurement ID.'),
                                        TextInput::make('search_console_verification')
                                            ->label('Google Search Console Verification Code')
                                            ->helperText('Provide the verification code (content value) for the meta tag.'),
                                        TextInput::make('facebook_pixel_id')
                                            ->label('Facebook Pixel ID')
                                            ->placeholder('1234567890'),
                                        TextInput::make('twitter_pixel_id')
                                            ->label('Twitter Pixel ID')
                                            ->placeholder('o0a1b'),
                                        TextInput::make('linkedin_pixel_id')
                                            ->label('LinkedIn Insight Tag ID')
                                            ->placeholder('123456'),
                                        TextInput::make('tiktok_pixel_id')
                                            ->label('TikTok Pixel ID')
                                            ->placeholder('ABCDEF1234567890'),
                                        Textarea::make('additional_head_scripts')
                                            ->label('Additional Head Scripts')
                                            ->helperText('Any custom scripts to render inside <head>. Include full script tags.')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        Textarea::make('additional_body_scripts')
                                            ->label('Additional Body Scripts')
                                            ->helperText('Scripts to inject before </body> (e.g., chat widgets). Include full script tags.')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('App Download')
                                    ->schema([
                                        Toggle::make('footer_settings.show_app_download')
                                            ->label('Show App Download Section')
                                            ->default(true)
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.app_download_text_en')
                                            ->label('App Download Text (English)')
                                            ->default('Download App')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.app_download_text_ar')
                                            ->label('App Download Text (Arabic)')
                                            ->default('تحميل التطبيق')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.ios_app_link')
                                            ->label('iOS App Store Link')
                                            ->url()
                                            ->default('#')
                                            ->columnSpan(1),

                                        FileUpload::make('footer_settings.ios_app_icon')
                                            ->label('iOS App Icon')
                                            ->image()
                                            ->directory('website/app-icons')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.android_app_link')
                                            ->label('Android Play Store Link')
                                            ->url()
                                            ->default('#')
                                            ->columnSpan(1),

                                        FileUpload::make('footer_settings.android_app_icon')
                                            ->label('Android App Icon')
                                            ->image()
                                            ->directory('website/app-icons')
                                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/svg'])
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3),

                                Section::make('Newsletter')
                                    ->schema([
                                        Toggle::make('footer_settings.show_newsletter')
                                            ->label('Show Newsletter Subscription')
                                            ->default(true)
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.newsletter_placeholder_en')
                                            ->label('Newsletter Placeholder (English)')
                                            ->default('Subscribe to Our Newsletter')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.newsletter_placeholder_ar')
                                            ->label('Newsletter Placeholder (Arabic)')
                                            ->default('اشترك في نشرتنا الإخبارية')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.newsletter_button_text_en')
                                            ->label('Subscribe Button Text (English)')
                                            ->default('Subscribe')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.newsletter_button_text_ar')
                                            ->label('Subscribe Button Text (Arabic)')
                                            ->default('اشترك')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3),

                                Section::make('Copyright & Legal')
                                    ->schema([
                                        TextInput::make('footer_settings.company_name')
                                            ->label('Company Name')
                                            ->default('Hauberk Capital')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.regulation_text')
                                            ->label('Regulation Text')
                                            ->default('')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.regulation_text_ar')
                                            ->label('Regulation Text (Arabic)')
                                            ->default('')
                                            ->columnSpan(1),

                                        Toggle::make('footer_settings.show_current_year')
                                            ->label('Show Current Year')
                                            ->default(true)
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.privacy_policy_text_en')
                                            ->label('Privacy Policy Text (English)')
                                            ->default('Privacy Policy')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.privacy_policy_text_ar')
                                            ->label('Privacy Policy Text (Arabic)')
                                            ->default('سياسة الخصوصية')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.privacy_policy_url')
                                            ->label('Privacy Policy URL')
                                            ->default('privacy-policy.html')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.terms_conditions_text_en')
                                            ->label('Terms & Conditions Text (English)')
                                            ->default('Terms & Conditions')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.terms_conditions_text_ar')
                                            ->label('Terms & Conditions Text (Arabic)')
                                            ->default('الشروط والأحكام')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.terms_conditions_url')
                                            ->label('Terms & Conditions URL')
                                            ->default('terms-conditions.html')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.cookie_policy_text_en')
                                            ->label('Cookie Policy Text (English)')
                                            ->default('Cookie Policy')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.cookie_policy_text_ar')
                                            ->label('Cookie Policy Text (Arabic)')
                                            ->default('سياسة ملفات تعريف الارتباط')
                                            ->columnSpan(1),

                                        TextInput::make('footer_settings.cookie_policy_url')
                                            ->label('Cookie Policy URL')
                                            ->default('cookie-policy.html')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('header_logo')
                    ->label('Logo')
                    ->formatStateUsing(fn ($state) => $state ? 'Uploaded' : 'Not Set'),
                Tables\Columns\TextColumn::make('header_background_type')
                    ->label('Background Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'transparent' => 'gray',
                        'solid' => 'blue',
                        'gradient' => 'purple',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('header_cta_text')
                    ->label('CTA Button'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated'),
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
            'index' => Pages\ListWebsiteSettings::route('/'),
            'create' => Pages\CreateWebsiteSettings::route('/create'),
            'edit' => Pages\EditWebsiteSettings::route('/{record}/edit'),
        ];
    }
}
