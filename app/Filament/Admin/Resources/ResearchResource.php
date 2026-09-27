<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ResearchResource\Pages;
use App\Filament\Forms\Components\SeoTab;
use App\Models\Research;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ResearchResource extends Resource
{
    protected static ?string $model = Research::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Research';
    protected static ?string $modelLabel = 'Research Report';
    protected static ?string $pluralModelLabel = 'Research';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 23;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Research Content')
                    ->tabs([
                        // ── Tab 1: Basic Information ─────────────────────────
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('Research Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('title_en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation !== 'create') return;
                                                $set('slug', Str::slug($state));
                                            }),
                                        Forms\Components\TextInput::make('title_ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->unique(Research::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('Used in URL: /resources-center/research/your-slug')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                $canonical = rtrim(config('app.url'), '/') . '/resources-center/research/' . $state;
                                                if (blank($get('seoMeta.canonical_url'))) {
                                                    $set('seoMeta.canonical_url', $canonical);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('author_en')
                                            ->label('Author (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('author_ar')
                                            ->label('Author (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('research_type_en')
                                            ->label('Research Type (English)')
                                            ->maxLength(255)
                                            ->placeholder('e.g. Market Research, Investment Report'),
                                        Forms\Components\TextInput::make('research_type_ar')
                                            ->label('Research Type (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\DatePicker::make('publication_date')
                                            ->label('Publication Date'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Sort Order')
                                            ->numeric()
                                            ->default(0),
                                        Forms\Components\Toggle::make('form_required')
                                            ->label('Require Form Before Download')
                                            ->default(true)
                                            ->helperText('If enabled, users must fill in their details before downloading the PDF'),
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Topics')
                                    ->schema([
                                        Forms\Components\TagsInput::make('topics')
                                            ->label('Topics')
                                            ->helperText('Press Enter to add each topic'),
                                    ]),
                            ]),

                        // ── Tab 2: Description ────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Description')
                            ->schema([
                                Forms\Components\Section::make('Short Description')
                                    ->schema([
                                        Forms\Components\Textarea::make('short_description_en')
                                            ->label('Short Description (English)')
                                            ->rows(4)
                                            ->helperText('Appears on listing and detail pages'),
                                        Forms\Components\Textarea::make('short_description_ar')
                                            ->label('Short Description (Arabic)')
                                            ->rows(4),
                                    ])
                                    ->columns(1),
                            ]),

                        // ── Tab 3: Files & Images ─────────────────────────────
                        Forms\Components\Tabs\Tab::make('Files & Images')
                            ->schema([
                                Forms\Components\Section::make('PDF File')
                                    ->schema([
                                        Forms\Components\FileUpload::make('pdf_file')
                                            ->label('PDF File')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('research/pdfs')
                                            ->maxSize(51200) // 50MB
                                            ->helperText('Upload the Research PDF (max 50MB)'),
                                    ]),
                                Forms\Components\Section::make('Cover Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cover_image')
                                            ->label('Cover Image')
                                            ->image()
                                            ->directory('research/covers')
                                            ->imageEditor()
                                            ->helperText('Main cover image. Also used as the OG image if none is set in SEO.')
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                // $state can be a TemporaryUploadedFile during upload or a
                                                // filename string after save — only sync once it's a stored path.
                                                if (blank($state) || ! is_string($state)) return;
                                                if (blank($get('seoMeta.og_image'))) {
                                                    $set('seoMeta.og_image', $state);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('cover_image_alt_en')
                                            ->label('Cover Image Alt (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('cover_image_alt_ar')
                                            ->label('Cover Image Alt (Arabic)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(1),
                            ]),

                        // ── Tab 4: SEO ────────────────────────────────────────
                        SeoTab::make('seoMeta', '/resources-center/research'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->size(60)
                    ->defaultImageUrl('/design/images/blog.png'),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('research_type_en')
                    ->label('Type')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('author_en')
                    ->label('Author'),
                Tables\Columns\TextColumn::make('publication_date')
                    ->label('Published')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('form_required')
                    ->label('Form Required')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Published' : 'Draft'),
                Tables\Columns\TextColumn::make('downloads_count')
                    ->label('Downloads')
                    ->counts('downloads')
                    ->badge()
                    ->color('success'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Status'),
                Tables\Filters\TernaryFilter::make('form_required')
                    ->label('Form Required'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('publication_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListResearch::route('/'),
            'create' => Pages\CreateResearch::route('/create'),
            'edit'   => Pages\EditResearch::route('/{record}/edit'),
        ];
    }
}
