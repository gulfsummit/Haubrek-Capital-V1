<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CareersResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\Careers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\CustomRichEditor;
use Filament\Forms\Components\Repeater;

class CareersResource extends Resource
{
    protected static ?string $model = Careers::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Careers';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 15;

    protected static ?string $modelLabel = 'Careers Page';

    protected static ?string $pluralModelLabel = 'Careers Pages';

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
                            'why_work' => 'Why Work Section',
                            'how_to_apply' => 'How to Apply Section',
                            'cta' => 'CTA Section',
                        ]),
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->schema([
                                Forms\Components\Section::make('Hero Images')
                                    ->schema([
                                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background', fn ($component) => $component->directory('careers/hero')->helperText('Recommended: 1920x1080px')),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background', fn ($component) => $component->directory('careers/hero')->helperText('Recommended: 768x1024px')),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),

                                Forms\Components\Section::make('Hero Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('JOIN OUR TEAM'),

                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('Careers that Drive your Success')
                                            ->simple(),

                                        Forms\Components\TextInput::make('hero_button_text_en')
                                            ->label('Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('MORE ABOUT US'),

                                        Forms\Components\TextInput::make('hero_button_link')
                                            ->label('Button Link')
                                            ->placeholder('/about-us or https://example.com')
                                            ->helperText('Enter a relative URL (e.g., /about-us) or full URL')
                                            ->default('/about-us'),
                                    ]),

                                Forms\Components\Section::make('Hero Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('انضم إلى فريقنا'),

                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->default('وظائف تقود نجاحك')
                                            ->simple(),

                                        Forms\Components\TextInput::make('hero_button_text_ar')
                                            ->label('Button Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('المزيد عنا'),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Why Work Section')
                            ->schema([
                                Forms\Components\Section::make('Background Image')
                                    ->schema([
                                        ...ImageWithAlt::make('why_work_bg_image', 'Background Image', fn ($component) => $component->directory('careers/why-work')->helperText('Recommended: 1920x1080px')),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('Section Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('why_work_title_en')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('WHY WORK AT HAUBERK CAPITAL?'),

                                        CustomRichEditor::make('why_work_subtitle_en')
                                            ->label('Section Subtitle')
                                            ->required()
                                            ->default('Working at Hauberk Capital means being part of a vibrant and inclusive community. Our team enjoys')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Section Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('why_work_title_ar')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('لماذا تعمل في هوبيرك كابيتال؟'),

                                        CustomRichEditor::make('why_work_subtitle_ar')
                                            ->label('Section Subtitle')
                                            ->required()
                                            ->default('العمل في هوبيرك كابيتال يعني أن تكون جزءًا من مجتمع نابض بالحياة وشامل. يستمتع فريقنا')
                                            ->simple(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Why Work Cards')
                            ->schema([
                                Forms\Components\Section::make('Why Work Cards')
                                    ->schema([
                                        Repeater::make('why_work_cards')
                                            ->label('Cards')
                                            ->schema([
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Card Title (English)')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->columnSpan(1),

                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Card Title (Arabic)')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->columnSpan(1),

                                                CustomRichEditor::make('content_en')
                                                    ->label('Card Content (English)')
                                                    ->required()
                                                    ->simple()
                                                    ->columnSpan(1),

                                                CustomRichEditor::make('content_ar')
                                                    ->label('Card Content (Arabic)')
                                                    ->required()
                                                    ->simple()
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->addActionLabel('Add Card')
                                            ->reorderable()
                                            ->defaultItems(3)
                                            ->columnSpanFull()
                                            ->helperText('Add up to 9 cards. Cards will be displayed in rows of 3.'),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('How to Apply')
                            ->schema([
                                Forms\Components\Section::make('Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('how_to_apply_title_en')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('HOW TO APPLY'),

                                        Forms\Components\TextInput::make('apply_email')
                                            ->label('Application Email')
                                            ->email()
                                            ->required()
                                            ->default('careers@hauberkcapital.com')
                                            ->helperText('Email address where applications will be sent'),

                                        CustomRichEditor::make('how_to_apply_text1_en')
                                            ->label('First Paragraph')
                                            ->required()
                                            ->default('To apply, please send your CV and cover letter to <a href="mailto:careers@hauberkcapital.com" class="text-[#D4AF37] underline hover:text-[#bfa14e] transition-colors">careers@hauberkcapital.com</a>.<br class="hidden sm:block">Or fill out this form. Our HR team will contact you after reviewing your application.')
                                            ->simple(),

                                        CustomRichEditor::make('how_to_apply_text2_en')
                                            ->label('Second Paragraph')
                                            ->required()
                                            ->default('We believe that diversity drives innovation and strengthens our company.<br class="hidden sm:block">At Hauberk Capital, we are committed to creating an inclusive workplace where everyone feels valued and respected.')
                                            ->simple(),
                                    ]),

                                Forms\Components\Section::make('Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('how_to_apply_title_ar')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('كيفية التقديم'),

                                        CustomRichEditor::make('how_to_apply_text1_ar')
                                            ->label('First Paragraph')
                                            ->required()
                                            ->default('للتقديم ، يرجى إرسال سيرتك الذاتية وخطاب التغطية إلى <a href="mailto:careers@hauberkcapital.com" class="text-[#D4AF37] underline hover:text-[#bfa14e] transition-colors">careers@hauberkcapital.com</a>.<br class="hidden sm:block">أو املأ هذا النموذج. سيتصل بك فريق الموارد البشرية لدينا بعد مراجعة طلبك.')
                                            ->simple(),

                                        CustomRichEditor::make('how_to_apply_text2_ar')
                                            ->label('Second Paragraph')
                                            ->required()
                                            ->default('نعتقد أن التنوع يدفع الابتكار ويعزز شركتنا.<br class="hidden sm:block">في هوبيرك كابيتال ، نحن ملتزمون بخلق مكان عمل شامل حيث يشعر الجميع بالتقدير والاحترام.')
                                            ->simple(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('CTA Section')
                            ->schema([
                                Forms\Components\Section::make('CTA Background')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'Background Image', fn ($component) => $component->directory('careers/cta')->helperText('Recommended: 1920x600px')),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('CTA Content (English)')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title_en')
                                            ->label('CTA Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default("READY TO\nSTART GROWING?!"),

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
                                        Forms\Components\TextInput::make('cta_button_1_url')
                                            ->label('Button 1 URL')
                                            ->placeholder('/contact-us or https://example.com')
                                            ->helperText('Enter a relative URL, route path, anchor, or full URL.')
                                            ->maxLength(255)
                                            ->default('/contact-us'),

                                        Forms\Components\TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('REQUEST A MEETING'),
                                        Forms\Components\TextInput::make('cta_button_2_url')
                                            ->label('Button 2 URL')
                                            ->placeholder('/request-meeting or https://example.com')
                                            ->helperText('Enter a relative URL, route path, anchor, or full URL.')
                                            ->maxLength(255)
                                            ->default('/request-meeting'),
                                    ]),

                                Forms\Components\Section::make('CTA Content (Arabic)')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title_ar')
                                            ->label('CTA Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->default("هل أنت مستعد\nللبدء في النمو؟!"),

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

                                        Forms\Components\TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('طلب اجتماع'),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareers::route('/create'),
            'edit' => Pages\EditCareers::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return Careers::count() === 0;
    }
}

