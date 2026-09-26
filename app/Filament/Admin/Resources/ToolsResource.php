<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ToolsResource\Pages;
use App\Filament\Admin\Resources\ToolsResource\RelationManagers;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\Tools;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomRichEditor;

class ToolsResource extends Resource
{
    protected static ?string $model = Tools::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'Tools';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 14;

    protected static ?string $modelLabel = 'Tools Page';

    protected static ?string $pluralModelLabel = 'Tools Pages';

    public static function form(Form $form): Form
    {
        // Wrap the schema in a full column span to be full width
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Tabs::make('Tools Page Content')
                            ->tabs([
                                SectionVisibility::tab([
                                    'hero' => 'Hero Section',
                                    'profile' => 'Investment Profile Section',
                                    'features' => 'Key Features Section',
                                    'how_it_works' => 'How It Works Section',
                                    'form' => 'Form Section',
                                ]),
                                // Hero Section
                                Forms\Components\Tabs\Tab::make('Hero Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title_en')
                                            ->label('Hero Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('INVESTOR RISK-RETURN PROFILING TOOL'),

                                        Forms\Components\TextInput::make('hero_title_ar')
                                            ->label('Hero Title (Arabic)')
                                            ->maxLength(255)
                                            ->default('أداة تحليل المخاطر والعوائد للمستثمرين'),

                                        ...ImageWithAlt::make('hero_desktop_image', 'Hero Background Image (Desktop)', fn ($component) => $component->directory('tools/hero')->maxSize(5120)),
                                        ...ImageWithAlt::make('hero_mobile_image', 'Hero Background Image (Mobile)', fn ($component) => $component->directory('tools/hero')->maxSize(5120)),
                                    ])
                                    ->columns(1),

                                // Investment Profile Section
                                Forms\Components\Tabs\Tab::make('Investment Profile Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('profile_title_en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('DISCOVER YOUR INVESTMENT PROFILE'),

                                        Forms\Components\TextInput::make('profile_title_ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255)
                                            ->default('اكتشف ملف الاستثمار الخاص بك'),

                                        CustomRichEditor::make('profile_description_en')
                                            ->label('Description (English)')
                                            ->required()
                                            ->simple(),

                                        CustomRichEditor::make('profile_description_ar')
                                            ->label('Description (Arabic)')
                                            ->simple(),

                                        Forms\Components\FileUpload::make('profile_image')
                                            ->label('Profile Image')
                                            ->image()
                                            ->directory('tools/profile')
                                            ->maxSize(5120),
                                    ])
                                    ->columns(1),

                                // Key Features Section
                                Forms\Components\Tabs\Tab::make('Key Features Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('features_title_en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('KEY FEATURES'),

                                        Forms\Components\TextInput::make('features_title_ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255)
                                            ->default('الميزات الرئيسية'),

                                        Forms\Components\Repeater::make('features_list_en')
                                            ->label('Features List (English)')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Feature Title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Feature Description')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->defaultItems(5)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),

                                        Forms\Components\Repeater::make('features_list_ar')
                                            ->label('Features List (Arabic)')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Feature Title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Feature Description')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->defaultItems(5)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),

                                        ...ImageWithAlt::make('features_background_image', 'Background Image', fn ($component) => $component->directory('tools/features')->maxSize(5120)),
                                    ])
                                    ->columns(1),

                                // How It Works Section
                                Forms\Components\Tabs\Tab::make('How It Works Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('how_it_works_title_en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('HOW IT WORKS:'),

                                        Forms\Components\TextInput::make('how_it_works_title_ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255)
                                            ->default('كيف يعمل:'),

                                        Forms\Components\Repeater::make('how_it_works_steps_en')
                                            ->label('Steps (English)')
                                            ->schema([
                                                Forms\Components\Textarea::make('step')
                                                    ->label('Step Description')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->defaultItems(6)
                                            ->collapsible(),

                                        Forms\Components\Repeater::make('how_it_works_steps_ar')
                                            ->label('Steps (Arabic)')
                                            ->schema([
                                                Forms\Components\Textarea::make('step')
                                                    ->label('Step Description')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->defaultItems(6)
                                            ->collapsible(),
                                    ])
                                    ->columns(1),

                                // Form Section
                                Forms\Components\Tabs\Tab::make('Form Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('form_title_en')
                                            ->label('Form Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('START YOUR RISK-RETURN ASSESSMENT'),

                                        Forms\Components\TextInput::make('form_title_ar')
                                            ->label('Form Title (Arabic)')
                                            ->maxLength(255)
                                            ->default('ابدأ تقييم المخاطر والعوائد'),

                                        Forms\Components\TextInput::make('form_button_text_en')
                                            ->label('Submit Button Text (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('SEND MESSAGE'),

                                        Forms\Components\TextInput::make('form_button_text_ar')
                                            ->label('Submit Button Text (Arabic)')
                                            ->maxLength(255)
                                            ->default('إرسال الرسالة'),

                                        ...ImageWithAlt::make('form_background_image', 'Form Background Image', fn ($component) => $component->directory('tools/form')->maxSize(5120)),
                                    ])
                                    ->columns(1),
                            ])
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Hero Title')
                    ->limit(50)
                    ->searchable(),

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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTools::route('/'),
            'edit' => Pages\EditTools::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
