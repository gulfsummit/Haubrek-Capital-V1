<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WealthServicesResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\WealthServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Forms\Components\CustomRichEditor;
use Filament\Tables;
use Filament\Tables\Table;

class WealthServicesResource extends Resource
{
    protected static ?string $model = WealthServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?string $navigationLabel = 'Wealth';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Wealth Services Content')
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
                                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background Image', fn ($component) => $component->directory('wealth-services/hero')->default('images/wealth-innerpage-bg.png')->columnSpan(1)),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background Image', fn ($component) => $component->directory('wealth-services/hero')->default('images/mobile-wealth-innerpage-bg.png')->columnSpan(1)),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Hero Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Title (English)')
                                            ->default('WEALTH PLANNING SERVICES')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('hero_subtitle_en')
                                        ->label('Subtitle (English)')
                                            ->default('Secure Your Future with Expert Financial Guidance')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_text_en')
                                            ->label('Button Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_text_ar')
                                            ->label('Button Text (Arabic)')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('hero_button_url')
                                            ->label('Button URL')
                                            ->helperText('Enter a relative path (e.g., /contact, contact) or full URL')
                                            ->default('#')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ]),

                        // Services Overview Tab
                        Forms\Components\Tabs\Tab::make('Services Overview')
                            ->schema([
                                Forms\Components\Section::make('Overview Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('overview_title_en')
                                            ->label('Title (English)')
                                            ->default('WEALTH PLANNING SERVICES')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('overview_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('overview_description_en')
                                            ->label('Description (English)')
                                            ->default('At Hauberk Capital, we understand that your financial journey is unique. Our Wealth Planning Services are designed to provide you with personalized and comprehensive financial strategies to secure your future and achieve your goals.')
                                            ->columnSpan(2),
                                        CustomRichEditor::make('overview_description_ar')
                                            ->label('Description (Arabic)')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Overview Items')
                                    ->schema([
                                        Forms\Components\Repeater::make('overview_items')
                                            ->label('Service Cards')
                                            ->schema([
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Description (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Description (Arabic)')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(6)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Approach Section Tab
                        Forms\Components\Tabs\Tab::make('Approach Section')
                            ->schema([
                                Forms\Components\Section::make('Approach Background')
                                    ->schema([
                                        ...ImageWithAlt::make('approach_background_image', 'Background Image (Desktop)', fn ($component) => $component->directory('wealth-services/approach')->default('images/approach-bg.png')->columnSpan(1)),
                                        ...ImageWithAlt::make('approach_mobile_background_image', 'Background Image (Mobile)', fn ($component) => $component->directory('wealth-services/approach')->columnSpan(1)),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Approach Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('approach_title_en')
                                            ->label('Title (English)')
                                            ->default('INVESTMENT ANALYSIS')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('approach_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('approach_description_en')
                                            ->label('Description (English)')
                                            ->default('Our experts perform a meticulous review of your current financial status to identify strengths, weaknesses, opportunities, and gaps in your investment portfolio.')
                                            ->columnSpan(2),
                                        CustomRichEditor::make('approach_description_ar')
                                            ->label('Description (Arabic)')
                                            ->columnSpan(2),
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
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Description (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Description (Arabic)')
                                                    ->columnSpan(1),
                                                Forms\Components\Toggle::make('is_expanded')
                                                    ->label('Show Expanded by Default')
                                                    ->default(false)
                                                    ->columnSpan(2),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(8)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Steps Section Tab
                        Forms\Components\Tabs\Tab::make('Steps Section')
                            ->schema([
                                Forms\Components\Section::make('Steps Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('steps_title_en')
                                            ->label('Title (English)')
                                            ->default('STEPS TO START')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Your Wealth Governance')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('steps_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Steps Items')
                                    ->schema([
                                        Forms\Components\Repeater::make('steps_items')
                                            ->label('Steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(4)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Why Choose Us Tab
                        Forms\Components\Tabs\Tab::make('Why Choose Us')
                            ->schema([
                                Forms\Components\Section::make('Why Choose Us Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('why_choose_title_en')
                                            ->label('Title (English)')
                                            ->default('WHY CHOOSE US')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('why_choose_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Why Choose Us Items')
                                    ->schema([
                                        Forms\Components\Repeater::make('why_choose_items')
                                            ->label('Why Choose Us Items')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->label('Image')
                                                    ->image()
                                                    ->directory('wealth-services/why-choose-us')
                                                    ->columnSpan(2),
                                                Forms\Components\TextInput::make('title_en')
                                                    ->label('Title (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('title_ar')
                                                    ->label('Title (Arabic)')
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_en')
                                                    ->label('Description (English)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                CustomRichEditor::make('description_ar')
                                                    ->label('Description (Arabic)')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // CTA Section Tab
                        Forms\Components\Tabs\Tab::make('CTA Section')
                            ->schema([
                                Forms\Components\Section::make('CTA Background')
                                    ->schema([
                                        ...ImageWithAlt::make('cta_background_image', 'Background Image', fn ($component) => $component->directory('wealth-services/cta')->default('images/meeting-bg.png')->columnSpanFull()),
                                    ]),

                                Forms\Components\Section::make('CTA Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title_en')
                                            ->label('Title (English)')
                                            ->default('READY TO START GROWING?!')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_title_ar')
                                            ->label('Title (Arabic)')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('cta_description_en')
                                            ->label('Description (English)')
                                            ->default('Unlock the full potential of your wealth')
                                            ->columnSpan(1),
                                        CustomRichEditor::make('cta_description_ar')
                                            ->label('Description (Arabic)')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('CTA Buttons')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_button_1_text_en')
                                            ->label('Button 1 Text (English)')
                                            ->default('JOIN OUR MAILING LIST')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_1_text_ar')
                                            ->label('Button 1 Text (Arabic)')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_1_url')
                                            ->label('Button 1 URL')
                                            ->helperText('Enter a relative path (e.g., /contact, contact) or full URL')
                                            ->default('/contact')
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('cta_button_2_text_en')
                                            ->label('Button 2 Text (English)')
                                            ->default('REQUEST A MEETING')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_2_text_ar')
                                            ->label('Button 2 Text (Arabic)')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('cta_button_2_url')
                                            ->label('Button 2 URL')
                                            ->helperText('Enter a relative path (e.g., /contact, contact) or full URL')
                                            ->default('/request-meeting')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Hero Title')
                    ->limit(50),
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
            'index' => Pages\ListWealthServices::route('/'),
            'create' => Pages\CreateWealthServices::route('/create'),
            'edit' => Pages\EditWealthServices::route('/{record}/edit'),
        ];
    }
}
