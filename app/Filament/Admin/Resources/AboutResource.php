<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Support\SectionVisibility;
use Filament\Forms;
use Filament\Tables;
use App\Models\About;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomRichEditor;
use App\Filament\Admin\Resources\AboutResource\Pages;
use App\Filament\Admin\Resources\AboutResource\RelationManagers;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Page Builder';
    protected static ?string $navigationLabel = 'About Us';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('About Us Content')
                    ->tabs([
                        SectionVisibility::tab([
                            'hero' => 'Hero Section',
                            'who_we_are' => 'Who We Are Section',
                            'concept' => 'Hauberk Capital Concept Section',
                            'mission_vision' => 'Mission & Vision Section',
                            'values' => 'Our Values Section',
                            'approach' => 'Approach Section',
                        ]),
                        // Hero Section Tab
                        Tabs\Tab::make('Hero Section')
                            ->schema([
                                Section::make('Hero Content')
                                    ->schema([
                                        TextInput::make('hero_title_en')
                                            ->label('Title (English)')
                                            ->default('ABOUT US'),
                                        TextInput::make('hero_title_ar')
                                            ->label('Title (Arabic)'),
                                        CustomRichEditor::make('hero_subtitle_en')
                                            ->label('Subtitle (English)')
                                            ->default('Uncover the story behind Hauberk Capital for Wealth Advisory')
                                            ->simple(),
                                        CustomRichEditor::make('hero_subtitle_ar')
                                            ->label('Subtitle (Arabic)')
                                            ->simple(),
                                        TextInput::make('hero_button_text_en')
                                            ->label('Button Text (English)')
                                            ->default('REQUEST A MEETING'),
                                        TextInput::make('hero_button_text_ar')
                                            ->label('Button Text (Arabic)')
                                            ->default('طلب اجتماع'),
                                        TextInput::make('hero_button_link')
                                            ->label('Button Link')
                                            ->default('request-a-meeting'),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Hero Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('hero_desktop_image')
                                            ->label('Desktop Background Image')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor()
                                            ->imagePreviewHeight('250')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth(null)
                                            ->imageResizeTargetHeight(null)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                        Forms\Components\TextInput::make('hero_desktop_image_alt_en')
                                            ->label('Desktop Image Alt (English)')
                                            ->default('About hero desktop image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('hero_desktop_image_alt_ar')
                                            ->label('Desktop Image Alt (Arabic)')
                                            ->default('صورة عن قسم من نحن (سطح المكتب)')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('hero_mobile_image')
                                            ->label('Mobile Background Image')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor()
                                            ->imagePreviewHeight('250')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth(null)
                                            ->imageResizeTargetHeight(null)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                        Forms\Components\TextInput::make('hero_mobile_image_alt_en')
                                            ->label('Mobile Image Alt (English)')
                                            ->default('About hero mobile image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('hero_mobile_image_alt_ar')
                                            ->label('Mobile Image Alt (Arabic)')
                                            ->default('صورة عن قسم من نحن (الجوال)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        // Who We Are Tab
                        Tabs\Tab::make('Who We Are')
                            ->schema([
                                Section::make('Who We Are Content')
                                    ->schema([
                                        TextInput::make('who_we_are_title_en')
                                            ->label('Title (English)')
                                            ->default('WHO WE ARE'),
                                        TextInput::make('who_we_are_title_ar')
                                            ->label('Title (Arabic)'),
                                        CustomRichEditor::make('who_we_are_description_1_en')
                                            ->label('Description 1 (English)')
                                            ->default('Hauberk Capital is an external Wealth Advisory firm that support High-Net-Worth Individuals, Family Offices, and Endowments by providing top-notch Wealth Advisory services.')
                                            ->full(),
                                        CustomRichEditor::make('who_we_are_description_1_ar')
                                            ->label('Description 1 (Arabic)')
                                            ->full(),
                                        CustomRichEditor::make('who_we_are_description_2_en')
                                            ->label('Description 2 (English)')
                                            ->default('We believe in a holistic approach to wealth Advisory and strive for every aspect of the wealth life cycle, including governance of wealth structure, wealth planning, current situation analysis, and investment policy statement development that aligns with the client objectives and risk profile.')
                                            ->full(),
                                        CustomRichEditor::make('who_we_are_description_2_ar')
                                            ->label('Description 2 (Arabic)')
                                            ->full(),
                                        CustomRichEditor::make('who_we_are_description_3_en')
                                            ->label('Description 3 (English)')
                                            ->default('Additionally, we offer CIO office outsourcing services, in which we act as a dedicated investment department for our clients, obliging them with strategy advisors search and selection process, portfolio performance monitoring services, submitting essential periodic reports and executing rebalancing based on macroeconomic conditions for nourishing their tremendous wealth journey.')
                                            ->full(),
                                        CustomRichEditor::make('who_we_are_description_3_ar')
                                            ->label('Description 3 (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Who We Are Background Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('who_we_are_desktop_bg')
                                            ->label('Desktop Background')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('who_we_are_desktop_bg_alt_en')
                                            ->label('Desktop Background Alt (English)')
                                            ->default('Who we are background (desktop)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('who_we_are_desktop_bg_alt_ar')
                                            ->label('Desktop Background Alt (Arabic)')
                                            ->default('خلفية من نحن (سطح المكتب)')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('who_we_are_mobile_bg')
                                            ->label('Mobile Background')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('who_we_are_mobile_bg_alt_en')
                                            ->label('Mobile Background Alt (English)')
                                            ->default('Who we are background (mobile)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('who_we_are_mobile_bg_alt_ar')
                                            ->label('Mobile Background Alt (Arabic)')
                                            ->default('خلفية من نحن (الجوال)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        // Concept Tab
                        Tabs\Tab::make('Hauberk Capital Concept')
                            ->schema([
                                Section::make('Concept Content')
                                    ->schema([
                                        TextInput::make('concept_title_en')
                                            ->label('Title (English)')
                                            ->default('HAUBERK CAPITAL AS A CONCEPT'),
                                        TextInput::make('concept_title_ar')
                                            ->label('Title (Arabic)'),
                                        CustomRichEditor::make('concept_intro_en')
                                            ->label('Introduction (English)')
                                            ->default('Historically, the hauberk was the armor that provided maximum and balanced protection for knights. Inspired by this, Hauberk Capital has developed a Wealth Advisory Philosophy that mirrors this concept. We aim to create a protective framework for our clients\' wealth through strategic defensive allocations. Our model is built on four main pillars, as reflected in our logo:')
                                            ->full(),
                                        CustomRichEditor::make('concept_intro_ar')
                                            ->label('Introduction (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Four Pillars')
                                    ->schema([
                                        // Yield Section
                                        TextInput::make('yield_title_en')
                                            ->label('Yield Title (English)')
                                            ->default('Yield'),
                                        TextInput::make('yield_title_ar')
                                            ->label('Yield Title (Arabic)')
                                            ->default('العائد'),
                                        TextInput::make('yield_description_en')
                                            ->label('Yield Description (English)')
                                            ->default('In terms of financial investment philosophy, looking for real yields is our main objective to create wealth through capital investment strategies.'),
                                        TextInput::make('yield_description_ar')
                                            ->label('Yield Description (Arabic)'),
                                        
                                        // Defence Section
                                        TextInput::make('defence_title_en')
                                            ->label('Defence Title (English)')
                                            ->default('Defence'),
                                        TextInput::make('defence_title_ar')
                                            ->label('Defence Title (Arabic)')
                                            ->default('الدفاع'),
                                        TextInput::make('defence_description_en')
                                            ->label('Defence Description (English)')
                                            ->default('We prioritize effectively protecting our clients\' wealth through defensive investment allocations that stringently identify risk and security.'),
                                        TextInput::make('defence_description_ar')
                                            ->label('Defence Description (Arabic)'),
                                        
                                        // Appreciation Section
                                        TextInput::make('appreciation_title_en')
                                            ->label('Appreciation Title (English)')
                                            ->default('Appreciation'),
                                        TextInput::make('appreciation_title_ar')
                                            ->label('Appreciation Title (Arabic)')
                                            ->default('التقدير'),
                                        TextInput::make('appreciation_description_en')
                                            ->label('Appreciation Description (English)')
                                            ->default('We aim to enhance the value of assets and investments over time to generate substantive gains for our clients.'),
                                        TextInput::make('appreciation_description_ar')
                                            ->label('Appreciation Description (Arabic)'),
                                        
                                        // Liquidity Section
                                        TextInput::make('liquidity_title_en')
                                            ->label('Liquidity Title (English)')
                                            ->default('Liquidity'),
                                        TextInput::make('liquidity_title_ar')
                                            ->label('Liquidity Title (Arabic)')
                                            ->default('السيولة'),
                                        TextInput::make('liquidity_description_en')
                                            ->label('Liquidity Description (English)')
                                            ->default('We ensure adequate liquidity for our clients, allowing them easy and timely access to their funds when needed.'),
                                        TextInput::make('liquidity_description_ar')
                                            ->label('Liquidity Description (Arabic)'),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Concept Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('concept_bg_image')
                                            ->label('Concept Background (Desktop)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_bg_image_alt_en')
                                            ->label('Concept Background Alt (English)')
                                            ->default('Concept background image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_bg_image_alt_ar')
                                            ->label('Concept Background Alt (Arabic)')
                                            ->default('صورة خلفية المفهوم')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('concept_bg_mobile_image')
                                            ->label('Concept Background (Mobile)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_bg_mobile_image_alt_en')
                                            ->label('Concept Background Mobile Alt (English)')
                                            ->default('Concept background mobile image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_bg_mobile_image_alt_ar')
                                            ->label('Concept Background Mobile Alt (Arabic)')
                                            ->default('صورة خلفية المفهوم للجوال')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('concept_diagram_image')
                                            ->label('Concept Diagram (Desktop)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_diagram_image_alt_en')
                                            ->label('Concept Diagram Alt (English)')
                                            ->default('Concept diagram image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_diagram_image_alt_ar')
                                            ->label('Concept Diagram Alt (Arabic)')
                                            ->default('صورة مخطط المفهوم')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('concept_diagram_mobile_image')
                                            ->label('Concept Diagram (Mobile)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_diagram_mobile_image_alt_en')
                                            ->label('Concept Diagram Mobile Alt (English)')
                                            ->default('Concept diagram mobile image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_diagram_mobile_image_alt_ar')
                                            ->label('Concept Diagram Mobile Alt (Arabic)')
                                            ->default('صورة مخطط المفهوم للجوال')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('concept_diagram_image_ar')
                                            ->label('Concept Diagram (Arabic Desktop)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_diagram_image_ar_alt_en')
                                            ->label('Concept Diagram Arabic Alt (English)')
                                            ->default('Concept diagram Arabic image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_diagram_image_ar_alt_ar')
                                            ->label('Concept Diagram Arabic Alt (Arabic)')
                                            ->default('صورة مخطط المفهوم باللغة العربية')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('concept_diagram_mobile_image_ar')
                                            ->label('Concept Diagram (Arabic Mobile)')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('concept_diagram_mobile_image_ar_alt_en')
                                            ->label('Concept Diagram Arabic Mobile Alt (English)')
                                            ->default('Concept diagram Arabic mobile image')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('concept_diagram_mobile_image_ar_alt_ar')
                                            ->label('Concept Diagram Arabic Mobile Alt (Arabic)')
                                            ->default('صورة مخطط المفهوم باللغة العربية للجوال')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        // Mission & Vision Tab
                        Tabs\Tab::make('Mission & Vision')
                            ->schema([
                                Section::make('Mission')
                                    ->schema([
                                        TextInput::make('mission_title_en')
                                            ->label('Mission Title (English)')
                                            ->default('MISSION'),
                                        TextInput::make('mission_title_ar')
                                            ->label('Mission Title (Arabic)')
                                            ->default('المهمة'),
                                        TextInput::make('mission_text_en')
                                            ->label('Mission Text (English)')
                                            ->default('Develop HNWI, Family Offices and Endowment\'s investment experience.'),
                                        TextInput::make('mission_text_ar')
                                            ->label('Mission Text (Arabic)'),
                                        Forms\Components\FileUpload::make('mission_icon')
                                            ->label('Mission Icon')
                                            ->directory('about-us/icons')
                                        ->image()
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('mission_icon_alt_en')
                                        ->label('Mission Icon Alt (English)')
                                        ->default('Mission icon')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('mission_icon_alt_ar')
                                        ->label('Mission Icon Alt (Arabic)')
                                        ->default('أيقونة المهمة')
                                        ->maxLength(255),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Vision')
                                    ->schema([
                                        TextInput::make('vision_title_en')
                                            ->label('Vision Title (English)')
                                            ->default('VISION'),
                                        TextInput::make('vision_title_ar')
                                            ->label('Vision Title (Arabic)')
                                            ->default('الرؤية'),
                                        TextInput::make('vision_text_en')
                                            ->label('Vision Text (English)')
                                            ->default('To provide outstanding, cohesive & sustainable investment approach.'),
                                        TextInput::make('vision_text_ar')
                                            ->label('Vision Text (Arabic)'),
                                        Forms\Components\FileUpload::make('vision_icon')
                                            ->label('Vision Icon')
                                            ->directory('about-us/icons')
                                        ->image()
                                        ->imageEditor(),
                                    Forms\Components\TextInput::make('vision_icon_alt_en')
                                        ->label('Vision Icon Alt (English)')
                                        ->default('Vision icon')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('vision_icon_alt_ar')
                                        ->label('Vision Icon Alt (Arabic)')
                                        ->default('أيقونة الرؤية')
                                        ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        // Values Tab
                        Tabs\Tab::make('Our Values')
                            ->schema([
                                Section::make('Values Content')
                                    ->schema([
                                        TextInput::make('values_title_en')
                                            ->label('Values Title (English)')
                                            ->default('OUR VALUES'),
                                        TextInput::make('values_title_ar')
                                            ->label('Values Title (Arabic)'),
                                    ])
                                    ->columns(2),
                                
                                Repeater::make('values')
                                    ->label('Values')
                                    ->schema([
                                        TextInput::make('title_en')
                                            ->label('Value Title (English)')
                                            ->required(),
                                        TextInput::make('title_ar')
                                            ->label('Value Title (Arabic)')
                                            ->required(),
                                        CustomRichEditor::make('description_en')
                                            ->label('Description (English)')
                                            ->required()
                                            ->simple(),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Description (Arabic)')
                                            ->required()
                                            ->simple(),
                                        Forms\Components\FileUpload::make('icon')
                                            ->label('Value Icon')
                                            ->directory('about-us')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('icon_alt_en')
                                            ->label('Value Icon Alt (English)')
                                            ->default('Value icon')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('icon_alt_ar')
                                            ->label('Value Icon Alt (Arabic)')
                                            ->default('أيقونة القيمة')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(5)
                                    ->addActionLabel('Add Value'),
                            ]),
                        
                        // Approach Tab
                        Tabs\Tab::make('Our Approach')
                            ->schema([
                                Section::make('Approach Content')
                                    ->schema([
                                        TextInput::make('approach_title_en')
                                            ->label('Title (English)')
                                            ->default('OUR APPROACH'),
                                        TextInput::make('approach_title_ar')
                                            ->label('Title (Arabic)'),
                                        CustomRichEditor::make('approach_description_1_en')
                                            ->label('Description 1 (English)')
                                            ->default('We recognize the complexities of wealth advisory and are committed to providing top-tier service and expertise, assisting clients in making informed investment decisions. Our relationships are built on trust, mutual respect, and a dedication to quality service.')
                                            ->full(),
                                        CustomRichEditor::make('approach_description_1_ar')
                                            ->label('Description 1 (Arabic)')
                                            ->full(),
                                        CustomRichEditor::make('approach_description_2_en')
                                            ->label('Description 2 (English)')
                                            ->default('By leveraging advanced technology and continuous research and development, we deliver reliable, cost-effective solutions. We seek new investment opportunities, navigate economic fluctuations, and maximize returns through balanced, diversified portfolios.')
                                            ->full(),
                                        CustomRichEditor::make('approach_description_2_ar')
                                            ->label('Description 2 (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Approach Background Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('approach_bg_image')
                                            ->label('Background Image')
                                            ->directory('about-us/approach')
                                            ->image()
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('approach_bg_image_alt_en')
                                            ->label('Background Image Alt (English)')
                                            ->default('Approach section background')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('approach_bg_image_alt_ar')
                                            ->label('Background Image Alt (Arabic)')
                                            ->default('خلفية قسم المنهج')
                                            ->maxLength(255),
                                    ])
                                    ->columns(1),
                                
                                Repeater::make('approach_items')
                                    ->label('Approach Items')
                                    ->schema([
                                        TextInput::make('title_en')
                                            ->label('Item Title (English)')
                                            ->required(),
                                        TextInput::make('title_ar')
                                            ->label('Item Title (Arabic)')
                                            ->required(),
                                        CustomRichEditor::make('description_en')
                                            ->label('Description (English)')
                                            ->required()
                                            ->simple(),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Description (Arabic)')
                                            ->required()
                                            ->simple(),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(8)
                                    ->addActionLabel('Add Approach Item'),
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
                Tables\Columns\TextColumn::make('who_we_are_title_en')
                    ->label('Who We Are Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('concept_title_en')
                    ->label('Concept Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('values_title_en')
                    ->label('Values Title')
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn ($record): string => static::getUrl('edit', ['record' => $record])),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
