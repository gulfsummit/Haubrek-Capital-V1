<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MondayWindowResource\Pages;
use App\Filament\Forms\Components\SeoTab;
use App\Forms\Components\CustomRichEditor;
use App\Models\MondayWindow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MondayWindowResource extends Resource
{
    protected static ?string $model = MondayWindow::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Monday Window';
    protected static ?string $modelLabel = 'Monday Window';
    protected static ?string $pluralModelLabel = 'Monday Window';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Monday Window Content')
                    ->tabs([
                        // ── Tab 1: Basic Information ─────────────────────────
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('Monday Window Details')
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
                                            ->unique(MondayWindow::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('Used in URL: /resources-center/monday-window/your-slug')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                $canonical = rtrim(config('app.url'), '/') . '/resources-center/monday-window/' . $state;
                                                if (blank($get('seoMeta.canonical_url'))) {
                                                    $set('seoMeta.canonical_url', $canonical);
                                                }
                                            }),
                                        Forms\Components\DatePicker::make('week_date')
                                            ->label('Week Date')
                                            ->helperText('The Monday date this edition covers')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                                                if ($operation !== 'create' || empty($state)) return;
                                                $slug = \Carbon\Carbon::parse($state)->format('Y-m-d');
                                                $set('slug', $slug);
                                                $canonical = rtrim(config('app.url'), '/') . '/resources-center/monday-window/' . $slug;
                                                if (blank($get('seoMeta.canonical_url'))) {
                                                    $set('seoMeta.canonical_url', $canonical);
                                                }
                                            }),
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
                                Forms\Components\Section::make('Market Topics')
                                    ->schema([
                                        Forms\Components\TagsInput::make('market_topics')
                                            ->label('Market Topics')
                                            ->helperText('Press Enter to add each topic'),
                                    ]),
                            ]),

                        // ── Tab 2: Content ────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Summary & Content')
                                    ->schema([
                                        CustomRichEditor::make('short_summary_en')
                                            ->label('Short Summary (English)')
                                            ->simple()
                                            ->helperText('Brief summary shown on listing pages'),
                                        CustomRichEditor::make('short_summary_ar')
                                            ->label('Short Summary (Arabic)')
                                            ->simple(),
                                        CustomRichEditor::make('content_en')
                                            ->label('Full Content (English)')
                                            ->full(),
                                        CustomRichEditor::make('content_ar')
                                            ->label('Full Content (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(1),
                                Forms\Components\Section::make('External Sources')
                                    ->schema([
                                        Forms\Components\Repeater::make('external_sources')
                                            ->label('External Sources')
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
                                            ->addActionLabel('Add Source')
                                            ->collapsible(),
                                    ]),
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
                                            ->addActionLabel('Add Article')
                                            ->collapsible(),
                                    ]),
                            ]),

                        // ── Tab 3: Images ─────────────────────────────────────
                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                Forms\Components\Section::make('Featured Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('monday-window/images')
                                            ->imageEditor()
                                            ->helperText('Main image. Also used as OG image if none is set in SEO.'),
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
                        SeoTab::make('seoMeta', '/resources-center/monday-window'),
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
                Tables\Columns\TextColumn::make('week_date')
                    ->label('Week Date')
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('week_date')
                    ->form([
                        Forms\Components\DatePicker::make('week_date_from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('week_date_until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['week_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('week_date', '>=', $date),
                            )
                            ->when(
                                $data['week_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('week_date', '<=', $date),
                            );
                    }),
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
            ->defaultSort('week_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMondayWindows::route('/'),
            'create' => Pages\CreateMondayWindow::route('/create'),
            'edit'   => Pages\EditMondayWindow::route('/{record}/edit'),
        ];
    }
}
