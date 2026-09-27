<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BlogResource\Pages;
use App\Filament\Admin\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\WhitePaper;
use App\Models\CioFlash;
use App\Models\MondayWindow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\CustomRichEditor;
use Illuminate\Support\Str;
use App\Filament\Forms\Components\SeoTab;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Blog Posts';
    protected static ?string $modelLabel = 'Blog Post';
    protected static ?string $pluralModelLabel = 'Blog Posts';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 14;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Blog Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('Blog Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('title_en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                if ($operation !== 'create') {
                                                    return;
                                                }
                                                $set('slug', \Illuminate\Support\Str::slug($state));
                                            }),
                                        Forms\Components\TextInput::make('title_ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('URL Slug')
                                            ->required()
                                            ->unique(Blog::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('This will be used in the URL (e.g., /blog/your-slug)')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                                if (blank($state)) return;
                                                $canonical = rtrim(config('app.url'), '/') . '/blog/' . $state;
                                                // Only auto-fill if the canonical is currently empty
                                                if (blank($get('seoMeta.canonical_url'))) {
                                                    $set('seoMeta.canonical_url', $canonical);
                                                }
                                            }),
                                        Forms\Components\TextInput::make('category')
                                            ->label('Category (English)')
                                            ->datalist(self::getCategoryDatalist())
                                            ->maxLength(255)
                                            ->helperText('Enter a category label (e.g., News, Market Updates). Existing categories appear as suggestions.'),
                                        Forms\Components\TextInput::make('category_ar')
                                            ->label('Category (Arabic)')
                                            ->datalist(self::getCategoryArabicDatalist())
                                            ->maxLength(255)
                                            ->helperText('أدخل اسم التصنيف بالعربية.'),
                                        Forms\Components\TextInput::make('button_text_en')
                                            ->label('Post Button Text (English)')
                                            ->maxLength(255)
                                            ->helperText('Used for this post card/link button, for example: Learn More...'),
                                        Forms\Components\TextInput::make('button_text_ar')
                                            ->label('Post Button Text (Arabic)')
                                            ->maxLength(255)
                                            ->helperText('يُستخدم لنص زر هذه المقالة في العربية.'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Sort Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first'),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true),
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false)
                                            ->helperText('Show in featured sections'),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Author & Publication')
                                    ->schema([
                                        Forms\Components\TextInput::make('author_en')
                                            ->label('Author (English)')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('author_ar')
                                            ->label('Author (Arabic)')
                                            ->maxLength(255),
                                        Forms\Components\DatePicker::make('publication_date')
                                            ->label('Publication Date'),
                                        Forms\Components\TextInput::make('reading_time')
                                            ->label('Reading Time (minutes)')
                                            ->numeric()
                                            ->minValue(1)
                                            ->helperText('Estimated reading time in minutes'),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make('Related Content')
                                    ->schema([
                                        Forms\Components\Select::make('related_white_paper_id')
                                            ->label('Related White Paper')
                                            ->options(fn () => WhitePaper::published()->ordered()->pluck('title_en', 'id'))
                                            ->searchable()
                                            ->nullable()
                                            ->placeholder('Select a White Paper'),
                                        Forms\Components\Select::make('related_cio_flash_id')
                                            ->label('Related CIO Flash Episode')
                                            ->options(fn () => CioFlash::published()->ordered()->pluck('episode_title_en', 'id'))
                                            ->searchable()
                                            ->nullable()
                                            ->placeholder('Select a CIO Flash Episode'),
                                        Forms\Components\Select::make('related_monday_window_id')
                                            ->label('Related Monday Window')
                                            ->options(fn () => MondayWindow::published()->ordered()->pluck('title_en', 'id'))
                                            ->searchable()
                                            ->nullable()
                                            ->placeholder('Select a Monday Window'),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),
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
                                    ])
                                    ->collapsible(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Blog Content')
                                    ->schema([
                                        CustomRichEditor::make('description_en')
                                            ->label('Short Description (English)')
                                            ->required()
                                            ->simple()
                                            ->helperText('This appears on the blog listing page. Use the Font Size dropdown above to change text size.'),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Short Description (Arabic)')
                                            ->simple(),
                                        CustomRichEditor::make('content_en')
                                            ->label('Full Content (English)')
                                            ->required()
                                            ->full()
                                            ->helperText('This appears on the individual blog page. Use the Font Size dropdown above to change text size.'),
                                        CustomRichEditor::make('content_ar')
                                            ->label('Full Content (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(1),
                            ]),
                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                Forms\Components\Section::make('Blog Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('blogs/featured')
                                            ->imageEditor()
                                            ->helperText('Main image for the blog post. Also used as OG image if none is set in SEO.'),
                                        Forms\Components\TextInput::make('featured_image_alt_en')
                                            ->label('Featured Image Alt (English)')
                                            ->maxLength(255)
                                            ->helperText('Describe the featured image in English.'),
                                        Forms\Components\TextInput::make('featured_image_alt_ar')
                                            ->label('Featured Image Alt (Arabic)')
                                            ->maxLength(255)
                                            ->helperText('صف الصورة البارزة باللغة العربية.'),
                                        Forms\Components\FileUpload::make('thumbnail_image')
                                            ->label('Thumbnail Image')
                                            ->image()
                                            ->directory('blogs/thumbnails')
                                            ->imageEditor()
                                            ->helperText('Small image for blog listing (optional - will use featured image if not provided)'),
                                        Forms\Components\TextInput::make('thumbnail_image_alt_en')
                                            ->label('Thumbnail Image Alt (English)')
                                            ->maxLength(255)
                                            ->helperText('Describe the thumbnail image in English.'),
                                        Forms\Components\TextInput::make('thumbnail_image_alt_ar')
                                            ->label('Thumbnail Image Alt (Arabic)')
                                            ->maxLength(255)
                                            ->helperText('صف صورة المعاينة باللغة العربية.'),
                                    ])
                                    ->columns(1),
                            ]),
                        SeoTab::make('seoMeta', '/blog'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_image')
                    ->label('Thumbnail')
                    ->size(60)
                    ->defaultImageUrl('/design/images/blog.png'),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ? Str::headline($state) : 'Uncategorized')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Published')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Published' : 'Draft'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('publication_date')
                    ->label('Date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(self::getCategoryFilterOptions()),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    protected static function getCategoryCollection()
    {
        return Blog::query()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category')
            ->unique()
            ->filter()
            ->values();
    }

    protected static function getCategoryDatalist(): array
    {
        return self::getCategoryCollection()->toArray();
    }

    protected static function getCategoryArabicDatalist(): array
    {
        return Blog::query()
            ->whereNotNull('category_ar')
            ->orderBy('category_ar')
            ->pluck('category_ar')
            ->unique()
            ->filter()
            ->values()
            ->toArray();
    }

    protected static function getCategoryFilterOptions(): array
    {
        return self::getCategoryCollection()
            ->mapWithKeys(fn ($category) => [$category => Str::headline($category)])
            ->toArray();
    }
}
