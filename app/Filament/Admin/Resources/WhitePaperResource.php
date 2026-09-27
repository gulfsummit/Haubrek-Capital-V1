<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WhitePaperResource\Pages;
use App\Filament\Forms\Components\SeoTab;
use App\Forms\Components\CustomRichEditor;
use App\Models\WhitePaper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WhitePaperResource extends Resource
{
    protected static ?string $model = WhitePaper::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationLabel = 'White Papers';
    protected static ?string $modelLabel = 'White Paper';
    protected static ?string $pluralModelLabel = 'White Papers';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('White Paper Content')
                    ->tabs([
                        // ── Tab 1: Basic Information ─────────────────────────
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('White Paper Details')
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
                                            ->unique(WhitePaper::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('Used in the URL: /resources-center/white-papers/your-slug')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                $canonical = rtrim(config('app.url'), '/') . '/resources-center/white-papers/' . $state;
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
                                        Forms\Components\DatePicker::make('publication_date')
                                            ->label('Publication Date'),
                                        Forms\Components\TextInput::make('related_article_url')
                                            ->label('Related Article URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->helperText('Link to a related article (optional)'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Sort Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first'),
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false)
                                            ->helperText('Show on homepage or featured sections'),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Topics & Tags')
                                    ->schema([
                                        Forms\Components\TagsInput::make('topics')
                                            ->label('Topics')
                                            ->helperText('Press Enter to add each topic'),
                                        Forms\Components\TagsInput::make('tags')
                                            ->label('Tags')
                                            ->helperText('Press Enter to add each tag'),
                                    ])
                                    ->columns(2),
                            ]),

                        // ── Tab 2: Content ────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Descriptions')
                                    ->schema([
                                        CustomRichEditor::make('short_description_en')
                                            ->label('Short Description (English)')
                                            ->simple()
                                            ->helperText('Appears on listing pages'),
                                        CustomRichEditor::make('short_description_ar')
                                            ->label('Short Description (Arabic)')
                                            ->simple(),
                                        CustomRichEditor::make('executive_summary_en')
                                            ->label('Executive Summary (English)')
                                            ->full()
                                            ->helperText('Appears on the individual White Paper page'),
                                        CustomRichEditor::make('executive_summary_ar')
                                            ->label('Executive Summary (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(1),
                            ]),

                        // ── Tab 3: Files ──────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Files & Images')
                            ->schema([
                                Forms\Components\Section::make('PDF File')
                                    ->schema([
                                        Forms\Components\FileUpload::make('pdf_file')
                                            ->label('PDF File')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('white-papers/pdfs')
                                            ->maxSize(51200) // 50MB
                                            ->helperText('Upload the White Paper PDF (max 50MB)'),
                                    ]),
                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('white-papers/featured')
                                            ->imageEditor()
                                            ->helperText('Main image for listing pages. Also used as the OG image if none is set in SEO.')
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                if (blank($get('seoMeta.og_image'))) {
                                                    $set('seoMeta.og_image', $state);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('featured_image_alt_en')
                                            ->label('Featured Image Alt (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('featured_image_alt_ar')
                                            ->label('Featured Image Alt (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('cover_image')
                                            ->label('Cover Image')
                                            ->image()
                                            ->directory('white-papers/covers')
                                            ->imageEditor()
                                            ->helperText('Cover image shown on detail page'),
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
                        SeoTab::make('seoMeta', '/resources-center/white-papers'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Image')
                    ->size(60)
                    ->defaultImageUrl('/design/images/blog.png'),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author_en')
                    ->label('Author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_date')
                    ->label('Published')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Published' : 'Draft'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Status'),
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
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWhitePapers::route('/'),
            'create' => Pages\CreateWhitePaper::route('/create'),
            'edit'   => Pages\EditWhitePaper::route('/{record}/edit'),
        ];
    }
}
