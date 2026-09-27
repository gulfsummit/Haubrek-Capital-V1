<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CioFlashResource\Pages;
use App\Filament\Forms\Components\SeoTab;
use App\Forms\Components\CustomRichEditor;
use App\Models\CioFlash;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CioFlashResource extends Resource
{
    protected static ?string $model = CioFlash::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';
    protected static ?string $navigationLabel = 'CIO Flash';
    protected static ?string $modelLabel = 'CIO Flash Episode';
    protected static ?string $pluralModelLabel = 'CIO Flash';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('CIO Flash Content')
                    ->tabs([
                        // ── Tab 1: Basic Information ─────────────────────────
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('Episode Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('episode_title_en')
                                            ->label('Episode Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation !== 'create') return;
                                                $set('slug', Str::slug($state));
                                            }),
                                        Forms\Components\TextInput::make('episode_title_ar')
                                            ->label('Episode Title (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->unique(CioFlash::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('Used in URL: /resources-center/cio-flash/your-slug')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                $canonical = rtrim(config('app.url'), '/') . '/resources-center/cio-flash/' . $state;
                                                if (blank($get('seoMeta.canonical_url'))) {
                                                    $set('seoMeta.canonical_url', $canonical);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('episode_number')
                                            ->label('Episode Number')
                                            ->numeric()
                                            ->minValue(1),
                                        Forms\Components\DatePicker::make('publication_date')
                                            ->label('Publication Date'),
                                        Forms\Components\TextInput::make('duration')
                                            ->label('Duration')
                                            ->maxLength(20)
                                            ->placeholder('e.g. 12:34 or 12 min')
                                            ->helperText('Audio duration (e.g. "10:30" or "10 min")'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Sort Order')
                                            ->numeric()
                                            ->default(0),
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Speaker')
                                    ->schema([
                                        Forms\Components\TextInput::make('speaker_en')
                                            ->label('Speaker Name (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('speaker_ar')
                                            ->label('Speaker Name (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('speaker_position_en')
                                            ->label('Speaker Position (English)')
                                            ->maxLength(255)
                                            ->placeholder('e.g. Chief Investment Officer'),
                                        Forms\Components\TextInput::make('speaker_position_ar')
                                            ->label('Speaker Position (Arabic)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Key Topics')
                                    ->schema([
                                        Forms\Components\TagsInput::make('key_topics')
                                            ->label('Key Topics')
                                            ->helperText('Press Enter to add each topic'),
                                    ]),
                            ]),

                        // ── Tab 2: Content ────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Description')
                                    ->schema([
                                        CustomRichEditor::make('description_en')
                                            ->label('Description (English)')
                                            ->simple()
                                            ->helperText('Short description for listing pages'),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Description (Arabic)')
                                            ->simple(),
                                    ])
                                    ->columns(1),
                                Forms\Components\Section::make('Transcript')
                                    ->description('Adding a transcript improves SEO and accessibility.')
                                    ->schema([
                                        CustomRichEditor::make('transcript_en')
                                            ->label('Transcript (English)')
                                            ->full(),
                                        CustomRichEditor::make('transcript_ar')
                                            ->label('Transcript (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(1),
                                Forms\Components\Section::make('Related Articles')
                                    ->schema([
                                        Forms\Components\Repeater::make('related_articles')
                                            ->label('Related Articles')
                                            ->schema([
                                                Forms\Components\TextInput::make('label_en')
                                                    ->label('Label (English)')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('label_ar')
                                                    ->label('Label (Arabic)')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('url')
                                                    ->label('URL')
                                                    ->url()
                                                    ->maxLength(500),
                                            ])
                                            ->columns(3)
                                            ->addActionLabel('Add Related Article')
                                            ->collapsible(),
                                    ]),
                            ]),

                        // ── Tab 3: Media ──────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Media')
                            ->schema([
                                Forms\Components\Section::make('Audio File')
                                    ->schema([
                                        Forms\Components\FileUpload::make('audio_file')
                                            ->label('Audio File')
                                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/ogg', 'audio/mp4'])
                                            ->directory('cio-flash/audio')
                                            ->maxSize(102400) // 100MB
                                            ->helperText('Upload MP3, WAV, or OGG audio file (max 100MB)'),
                                    ]),
                                Forms\Components\Section::make('Featured Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('cio-flash/images')
                                            ->imageEditor()
                                            ->helperText('Main image. Also used as the OG image if none is set in SEO.')
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                // $state can be a TemporaryUploadedFile during upload or a
                                                // filename string after save — only sync once it's a stored path.
                                                if (blank($state) || ! is_string($state)) return;
                                                if (blank($get('seoMeta.og_image'))) {
                                                    $set('seoMeta.og_image', $state);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('featured_image_alt_en')
                                            ->label('Image Alt (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('featured_image_alt_ar')
                                            ->label('Image Alt (Arabic)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(1),
                            ]),

                        // ── Tab 4: SEO ────────────────────────────────────────
                        SeoTab::make('seoMeta', '/resources-center/cio-flash'),
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
                Tables\Columns\TextColumn::make('episode_number')
                    ->label('Ep.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('episode_title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('speaker_en')
                    ->label('Speaker')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration'),
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
            ->defaultSort('episode_number', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCioFlash::route('/'),
            'create' => Pages\CreateCioFlash::route('/create'),
            'edit'   => Pages\EditCioFlash::route('/{record}/edit'),
        ];
    }
}
