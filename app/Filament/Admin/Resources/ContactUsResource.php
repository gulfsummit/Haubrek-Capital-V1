<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactUsResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\CustomRichEditor;
use Filament\Forms\Components\Repeater;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Contact Us';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Contact Us Page';

    protected static ?string $pluralModelLabel = 'Contact Us Pages';

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
                            'form' => 'Form Section',
                            'contact_info' => 'Contact Info Section',
                            'map' => 'Map Section',
                        ]),
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->schema([
                                Forms\Components\Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background', fn ($component) => $component->directory('contact-us/hero')->helperText('Recommended: 1920x1080px')),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background', fn ($component) => $component->directory('contact-us/hero')->helperText('Recommended: 768x1024px')),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),

                                Forms\Components\Section::make('Hero Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('CONTACT US'),

                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('<p>Your journey to financial success starts with a simple conversation</p>')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Hero Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('اتصل بنا'),

                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('<p>تبدأ رحلتك نحو النجاح المالي بمحادثة بسيطة</p>')
                                            ->simple(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Form Section')
                            ->schema([
                                Forms\Components\Section::make('Form Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('form_title_en')
                                            ->label('Form Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('GET IN TOUCH WITH US'),

                                        Forms\Components\TextInput::make('form_button_text_en')
                                            ->label('Submit Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('SEND MESSAGE'),
                                    ]),

                                Forms\Components\Section::make('Form Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('form_title_ar')
                                            ->label('Form Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('تواصل معنا'),

                                        Forms\Components\TextInput::make('form_button_text_ar')
                                            ->label('Submit Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('إرسال الرسالة'),
                                    ]),

                                Forms\Components\Section::make('Form Fields (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('name_label_en')
                                            ->label('Name Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Name'),

                                        Forms\Components\TextInput::make('name_placeholder_en')
                                            ->label('Name Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Your name'),

                                        Forms\Components\TextInput::make('email_label_en')
                                            ->label('Email Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Email'),

                                        Forms\Components\TextInput::make('email_placeholder_en')
                                            ->label('Email Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('example@company.com'),

                                        Forms\Components\TextInput::make('phone_label_en')
                                            ->label('Phone Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Phone Number'),

                                        Forms\Components\TextInput::make('phone_placeholder_en')
                                            ->label('Phone Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('+11 000 000 000'),

                                        Forms\Components\TextInput::make('message_label_en')
                                            ->label('Message Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Message'),

                                        Forms\Components\TextInput::make('message_placeholder_en')
                                            ->label('Message Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Leave us a Message'),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Form Fields (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('name_label_ar')
                                            ->label('Name Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('الاسم'),

                                        Forms\Components\TextInput::make('name_placeholder_ar')
                                            ->label('Name Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('اسمك'),

                                        Forms\Components\TextInput::make('email_label_ar')
                                            ->label('Email Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('البريد الإلكتروني'),

                                        Forms\Components\TextInput::make('email_placeholder_ar')
                                            ->label('Email Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('example@company.com'),

                                        Forms\Components\TextInput::make('phone_label_ar')
                                            ->label('Phone Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('رقم الهاتف'),

                                        Forms\Components\TextInput::make('phone_placeholder_ar')
                                            ->label('Phone Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('+11 000 000 000'),

                                        Forms\Components\TextInput::make('message_label_ar')
                                            ->label('Message Field Label')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('الرسالة'),

                                        Forms\Components\TextInput::make('message_placeholder_ar')
                                            ->label('Message Field Placeholder')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('اترك لنا رسالة'),
                                    ])
                                    ->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Contact Info')
                            ->schema([
                                Forms\Components\Section::make('Phone Section (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('phone_title_en')
                                            ->label('Phone Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Call Us'),

                                        CustomRichEditor::make('phone_subtitle_en')
                                            ->label('Phone Subtitle')
                                            ->required()
                                            ->default('<p>Mon - Fri: 9am - 6pm</p>')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Phone Section (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('phone_title_ar')
                                            ->label('Phone Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('اتصل بنا'),

                                        CustomRichEditor::make('phone_subtitle_ar')
                                            ->label('Phone Subtitle')
                                            ->required()
                                            ->default('<p>الإثنين - الجمعة: 9 صباحًا - 6 مساءً</p>')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Phone Number')
                                    ->schema([
                                        Forms\Components\TextInput::make('phone_number')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->default('+971 4 5182591 / 2')
                                            ->helperText('The actual phone number to display'),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Email Section (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('email_title_en')
                                            ->label('Email Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Email Support'),

                                        CustomRichEditor::make('email_subtitle_en')
                                            ->label('Email Subtitle')
                                            ->required()
                                            ->default('<p>Email us & we will get back to you within 24 hours</p>')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Email Section (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('email_title_ar')
                                            ->label('Email Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('دعم البريد الإلكتروني'),

                                        CustomRichEditor::make('email_subtitle_ar')
                                            ->label('Email Subtitle')
                                            ->required()
                                            ->default('<p>راسلنا عبر البريد الإلكتروني وسنرد عليك خلال 24 ساعة</p>')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Email Address')
                                    ->schema([
                                        Forms\Components\TextInput::make('email_address')
                                            ->label('Email Address')
                                            ->email()
                                            ->default('info@hauberkcapital.com')
                                            ->helperText('The actual email address to display'),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Address Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('address_title_en')
                                            ->label('Address Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('ADDRESS'),

                                        Forms\Components\TextInput::make('address_title_ar')
                                            ->label('Address Title (Arabic)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('العنوان'),

                                        CustomRichEditor::make('address_text_en')
                                            ->label('Address Text (English)')
                                            ->default('<p>Al Sila Tower, ADGM Square, Al Maryah Island, Abu Dhabi, United Arab Emirates</p>')
                                            ->simple()
                                            ->columnSpan(2),

                                        CustomRichEditor::make('address_text_ar')
                                            ->label('Address Text (Arabic)')
                                            ->default('<p>برج السلع، ساحة سوق أبوظبي العالمي، جزيرة المارية، أبوظبي، الإمارات العربية المتحدة</p>')
                                            ->simple()
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Map Section')
                                    ->schema([
                                        Forms\Components\Textarea::make('map_iframe_url')
                                            ->label('Google Maps Embed URL')
                                            ->rows(4)
                                            ->default('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.566941357565!2d54.38588827535931!3d24.50045737816608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e665491ecc069%3A0x9d9d3d9987c47f20!2sAl%20Sila%20Tower%20-%208%20Abu%20Dhabi%20Global%20Market%20-%20First%20St%20-%20Al%20Maryah%20Island%20-%20MI1%20-%20Abu%20Dhabi%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2seg!4v1756117133980!5m2!1sen!2seg')
                                            ->helperText('Paste the Google Maps embed URL used inside the iframe src attribute.')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->schema([
                                Forms\Components\Section::make('Social Media Icons')
                                    ->schema([
                                        Forms\Components\TextInput::make('social_section_title_en')
                                            ->label('Social Section Title (English)')
                                            ->default('Follow Us')
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('social_section_title_ar')
                                            ->label('Social Section Title (Arabic)')
                                            ->default('تابعنا')
                                            ->columnSpan(1),

                                        Repeater::make('social_items')
                                            ->label('Social Media Items')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Platform Name')
                                                    ->required()
                                                    ->helperText('e.g., Facebook, Instagram, LinkedIn')
                                                    ->columnSpan(1),

                                                Forms\Components\TextInput::make('url')
                                                    ->label('URL')
                                                    ->required()
                                                    ->url()
                                                    ->helperText('Full URL to the social media page')
                                                    ->columnSpan(1),

                                                Forms\Components\FileUpload::make('icon')
                                                    ->label('Icon')
                                                    ->image()
                                                    ->directory('contact-us/social-icons')
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
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return ContactUs::count() === 0;
    }
}

