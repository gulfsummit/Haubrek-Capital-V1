<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CaseStudyResource\Pages;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\CustomRichEditor;
use Illuminate\Support\Str;
use App\Filament\Forms\Components\SeoTab;

class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Case Studies';
    protected static ?string $modelLabel = 'Case Study';
    protected static ?string $pluralModelLabel = 'Case Studies';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Case Study Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Section::make('Case Study Details')
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
                                            ->unique(CaseStudy::class, 'slug', ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('This will be used in the URL (e.g., /case-studies/your-slug)'),
                                        Forms\Components\TextInput::make('category')
                                            ->label('Category (English)')
                                            ->datalist(self::getCategoryDatalist())
                                            ->maxLength(255)
                                            ->helperText('Enter a category label (e.g., Family Business). Existing categories appear as suggestions.'),
                                        Forms\Components\TextInput::make('category_ar')
                                            ->label('Category (Arabic)')
                                            ->datalist(self::getCategoryArabicDatalist())
                                            ->maxLength(255)
                                            ->helperText('أدخل اسم التصنيف بالعربية.'),
                                        Forms\Components\TextInput::make('button_text_en')
                                            ->label('Post Button Text (English)')
                                            ->maxLength(255)
                                            ->helperText('Used for this case study card/link button, for example: Learn More...'),
                                        Forms\Components\TextInput::make('button_text_ar')
                                            ->label('Post Button Text (Arabic)')
                                            ->maxLength(255)
                                            ->helperText('يُستخدم لنص زر دراسة الحالة هذه في العربية.'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Sort Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first'),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Case Study Content')
                                    ->schema([
                                        CustomRichEditor::make('description_en')
                                            ->label('Short Description (English)')
                                            ->required()
                                            ->simple()
                                            ->helperText('This appears on the case studies listing page. Use the Font Size dropdown above to change text size.'),
                                        CustomRichEditor::make('description_ar')
                                            ->label('Short Description (Arabic)')
                                            ->simple(),
                                        CustomRichEditor::make('content_en')
                                            ->label('Full Content (English)')
                                            ->required()
                                            ->full()
                                            ->helperText('This appears on the individual case study page. Use the Font Size dropdown above to change text size.'),
                                        CustomRichEditor::make('content_ar')
                                            ->label('Full Content (Arabic)')
                                            ->full(),
                                    ])
                                    ->columns(1),
                            ]),
                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                Forms\Components\Section::make('Case Study Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('case-studies/featured')
                                            ->imageEditor()
                                            ->helperText('Main image for the case study'),
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
                                            ->directory('case-studies/thumbnails')
                                            ->imageEditor()
                                            ->helperText('Small image for case study listing (optional - will use featured image if not provided)'),
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
                        SeoTab::make(),
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
            'index' => Pages\ListCaseStudies::route('/'),
            'create' => Pages\CreateCaseStudy::route('/create'),
            'edit' => Pages\EditCaseStudy::route('/{record}/edit'),
        ];
    }

    protected static function getCategoryCollection()
    {
        return CaseStudy::query()
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
        return CaseStudy::query()
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

