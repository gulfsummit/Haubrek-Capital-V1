<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\Teams;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomRichEditor;
use App\Filament\Admin\Resources\TeamsResource\Pages;
use App\Filament\Admin\Resources\TeamsResource\RelationManagers;

class TeamsResource extends Resource
{
    protected static ?string $model = Teams::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Page Builder';
    protected static ?string $navigationLabel = 'Team';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Teams Page';
    protected static ?string $pluralModelLabel = 'Teams Pages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Teams Page Content')
                ->tabs([
                    SectionVisibility::tab([
                        'hero' => 'Hero Section',
                        'leadership' => 'Leadership Section',
                        'directors' => 'Directors Section',
                        'departments' => 'Departments Section',
                        'department_details' => 'Department Details Section',
                    ]),
                    // Hero Section Tab
                    Tabs\Tab::make('Hero Section')
                        ->schema([
                            Section::make('Hero Content')
                                ->schema([
                                    TextInput::make('hero_title_en')
                                        ->label('Title (English)')
                                        ->default('BOARD OF DIRECTORS')
                                        ,
                                    TextInput::make('hero_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('hero_subtitle_en')
                                        ->label('Subtitle (English)')
                                        ->default('Discover the visionary leaders steering Hauberk Capital towards new heights')
                                        ->simple(),
                                    CustomRichEditor::make('hero_subtitle_ar')
                                        ->label('Subtitle (Arabic)')
                                        ->simple(),
                                    TextInput::make('hero_button_text_en')
                                        ->label('Button Text (English)')
                                        ->default('REQUEST A MEETING')
                                        ,
                                    TextInput::make('hero_button_text_ar')
                                        ->label('Button Text (Arabic)'),
                                    TextInput::make('hero_button_link')
                                        ->label('Button Link')
                                        ,
                                ])
                                ->columns(2),

                            Section::make('Hero Images')
                                ->schema([
                                    ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background Image', fn ($component) => $component->directory('teams/hero')),
                                    ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background Image', fn ($component) => $component->directory('teams/hero')),
                                ])
                                ->columns(2),
                        ]),

                    // Leadership Section Tab
                    Tabs\Tab::make('Leadership Section')
                        ->schema([

                            Section::make('Leadership Images')
                                ->schema([
                                    ...ImageWithAlt::make('leadership_background_image', 'Desktop Background Image', fn ($component) => $component->directory('teams/leadership')),
                                    ...ImageWithAlt::make('leadership_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('teams/leadership')),
                                ])
                                ->columns(2),
                        ]),

                    // Directors Tab
                    Tabs\Tab::make('Directors')
                        ->schema([
                            Section::make('Directors Section Header')
                                ->schema([
                                    TextInput::make('directors_section_title_en')
                                        ->label('Section Title (English)')
                                        ->default('VISIONARY LEADERSHIP, LASTING IMPACT'),
                                    TextInput::make('directors_section_title_ar')
                                        ->label('Section Title (Arabic)'),
                                    CustomRichEditor::make('directors_section_description_en')
                                        ->label('Section Description (English)')
                                        ->default('At Hauberk Capital, our Board of Directors brings unparalleled global expertise in investment and wealth management. With strategic foresight and governance excellence, they drive sustainable growth, ensuring strong risk management and long-term value for all stakeholders.')
                                        ->simple(),
                                    CustomRichEditor::make('directors_section_description_ar')
                                        ->label('Section Description (Arabic)')
                                        ->simple(),
                                ])
                                ->columns(2),


                            Section::make('Board Directors')
                                ->schema([
                                    Repeater::make('directors')
                                        ->label('Directors')
                                        ->schema([
                                            TextInput::make('name_en')
                                                ->label('Name (English)')
                                                ,
                                            TextInput::make('name_ar')
                                                ->label('Name (Arabic)'),
                                            TextInput::make('position_en')
                                                ->label('Position (English)')
                                                ,
                                            TextInput::make('position_ar')
                                                ->label('Position (Arabic)'),
                                            FileUpload::make('image')
                                                ->label('Profile Image')
                                                ->directory('teams/directors')
                                                ->image()
                                                ->imageEditor()
                                                ,
                                            FileUpload::make('popup_image')
                                                ->label('Popup Image')
                                                ->directory('teams/directors/popup')
                                                ->image()
                                                ->imageEditor(),
                                            CustomRichEditor::make('bio')
                                                ->label('Description (English)')
                                                ->default('Experienced professional with deep expertise in financial services and wealth management.')
                                                ->simple()
                                                ->helperText('Enter a comprehensive description that includes experience, current role, education, and background information.'),
                                            CustomRichEditor::make('bio_ar')
                                                ->label('Description (Arabic)')
                                                ->simple()
                                                ->helperText('Enter the Arabic version of the comprehensive description.'),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(3)
                                        ->addActionLabel('Add Director'),
                                ]),
                        ]),

                    // Departments Tab
                    Tabs\Tab::make('Departments')
                        ->schema([
                            Section::make('Departments Header')
                                ->schema([
                                    TextInput::make('departments_title_en')
                                        ->label('Title (English)')
                                        ->default('HAUBERK DEPARTMENTS')
                                        ,
                                    TextInput::make('departments_title_ar')
                                        ->label('Title (Arabic)'),
                                    TextInput::make('departments_subtitle_en')
                                        ->label('Department Subtitle (English)')
                                        ->default('Know Hauberk')
                                        ->helperText('This appears above each department title'),
                                    TextInput::make('departments_subtitle_ar')
                                        ->label('Department Subtitle (Arabic)')
                                        ->default('اعرف هوبيرك')
                                        ->helperText('This appears above each department title'),
                                    CustomRichEditor::make('departments_description_en')
                                        ->label('Description (English)')
                                        ->default('Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.')
                                        ->simple(),
                                    CustomRichEditor::make('departments_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                ])
                                ->columns(2),

                            Section::make('Departments Images')
                                ->schema([
                                    ...ImageWithAlt::make('departments_background_image', 'Desktop Background Image', fn ($component) => $component->directory('teams/departments')),
                                    ...ImageWithAlt::make('departments_mobile_background_image', 'Mobile Background Image', fn ($component) => $component->directory('teams/departments')),
                                ])
                                ->columns(2),
                        ]),

                    // Department Details Tab
                    Tabs\Tab::make('Department Details')
                        ->schema([
                            // Investment Advisory
                            Section::make('Investment Advisory')
                                ->schema([
                                    TextInput::make('investment_advisory_title_en')
                                        ->label('Title (English)')
                                        ->default('INVESTMENT ADVISORY')
                                        ,
                                    TextInput::make('investment_advisory_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('investment_advisory_description_en')
                                        ->label('Description (English)')
                                        ->default('Our Investment Advisory team creates personalized investment strategies aligned with your financial goals and risk tolerance. They continuously monitor market trends to optimize your portfolio performance.')
                                        ->simple(),
                                    CustomRichEditor::make('investment_advisory_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('investment_advisory_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/investment')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('investment_advisory_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Investment Advisory team')
                                        ,
                                    TextInput::make('investment_advisory_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('investment_advisory_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
                                ])
                                ->columns(2),

                            // Financial Planning
                            Section::make('Financial Planning')
                                ->schema([
                                    TextInput::make('financial_planning_title_en')
                                        ->label('Title (English)')
                                        ->default('FINANCIAL PLANNING')
                                        ,
                                    TextInput::make('financial_planning_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('financial_planning_description_en')
                                        ->label('Description (English)')
                                        ->default('Our Financial Planning team helps clients develop comprehensive strategies for wealth preservation, tax efficiency, retirement planning, and estate planning to ensure long-term financial security.')
                                        ->simple(),
                                    CustomRichEditor::make('financial_planning_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('financial_planning_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/financial')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('financial_planning_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Financial Planning team')
                                        ,
                                    TextInput::make('financial_planning_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('financial_planning_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
                                ])
                                ->columns(2),

                            // Research & Analysis
                            Section::make('Research & Analysis')
                                ->schema([
                                    TextInput::make('research_analysis_title_en')
                                        ->label('Title (English)')
                                        ->default('RESEARCH & ANALYSIS')
                                        ,
                                    TextInput::make('research_analysis_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('research_analysis_description_en')
                                        ->label('Description (English)')
                                        ->default('The Research and Analysis team conducts in-depth analysis of financial markets, economic trends, and specific investment opportunities. Their insights and reports support the Investment Management team in making informed investment decisions.')
                                        ->simple(),
                                    CustomRichEditor::make('research_analysis_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('research_analysis_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/research')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('research_analysis_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Research & Analysis team')
                                        ,
                                    TextInput::make('research_analysis_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('research_analysis_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
                                ])
                                ->columns(2),

                            // Client Relations
                            Section::make('Client Relations')
                                ->schema([
                                    TextInput::make('client_relations_title_en')
                                        ->label('Title (English)')
                                        ->default('CLIENT RELATIONS')
                                        ,
                                    TextInput::make('client_relations_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('client_relations_description_en')
                                        ->label('Description (English)')
                                        ->default('Our Client Relations team serves as your dedicated point of contact, ensuring prompt communication and personalized service. They work closely with all departments to address your needs efficiently.')
                                        ->simple(),
                                    CustomRichEditor::make('client_relations_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('client_relations_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/client')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('client_relations_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Client Relations team')
                                        ,
                                    TextInput::make('client_relations_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('client_relations_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
                                ])
                                ->columns(2),

                            // Compliance and Legal
                            Section::make('Compliance and Legal')
                                ->schema([
                                    TextInput::make('compliance_legal_title_en')
                                        ->label('Title (English)')
                                        ->default('COMPLIANCE AND LEGAL')
                                        ,
                                    TextInput::make('compliance_legal_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('compliance_legal_description_en')
                                        ->label('Description (English)')
                                        ->default('Our Compliance and Legal team ensures all activities adhere to regulatory requirements and best practices. They provide guidance on legal matters and risk management to protect client interests.')
                                        ->simple(),
                                    CustomRichEditor::make('compliance_legal_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('compliance_legal_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/compliance')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('compliance_legal_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Compliance and Legal team')
                                        ,
                                    TextInput::make('compliance_legal_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('compliance_legal_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
                                ])
                                ->columns(2),

                            // Operations & Administration
                            Section::make('Operations & Administration')
            ->schema([
                                    TextInput::make('operations_admin_title_en')
                                        ->label('Title (English)')
                                        ->default('OPERATIONS & ADMINISTRATION')
                                        ,
                                    TextInput::make('operations_admin_title_ar')
                                        ->label('Title (Arabic)'),
                                    CustomRichEditor::make('operations_admin_description_en')
                                        ->label('Description (English)')
                                        ->default('The Operations & Administration team manages the day-to-day processes that support our advisory services. They handle account administration, reporting, and technology infrastructure to ensure seamless client experiences.')
                                        ->simple(),
                                    CustomRichEditor::make('operations_admin_description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple(),
                                    FileUpload::make('operations_admin_image')
                                        ->label('Department Image')
                                        ->directory('teams/departments/operations')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('operations_admin_link_en')
                                        ->label('Link Text (English)')
                                        ->default('Contact Hauberk Operations & Administration team')
                                        ,
                                    TextInput::make('operations_admin_link_ar')
                                        ->label('Link Text (Arabic)'),
                                    TextInput::make('operations_admin_url')
                                        ->label('Link URL')
                                        ->default('#')
                                        ->helperText('Enter the full URL (e.g., https://example.com or /contact)'),
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
                Tables\Columns\TextColumn::make('hero_title_en')
                    ->label('Hero Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('leadership_title_en')
                    ->label('Leadership Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departments_title_en')
                    ->label('Departments Title')
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
            'index' => Pages\ListTeams::route('/'),
            'edit' => Pages\EditTeams::route('/{record}/edit'),
        ];
    }
}
