<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GlossaryResource\Pages;
use App\Models\Category;
use App\Models\Glossary;
use App\Forms\Components\CustomRichEditor;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GlossaryResource extends Resource
{
    protected static ?string $model = Glossary::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationLabel = 'Glossaries';

    protected static ?string $modelLabel = 'Glossary';

    protected static ?string $pluralModelLabel = 'Glossaries';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Glossary Content')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Content')
                        ->schema([
                            Forms\Components\Section::make('Glossary Details')
                                ->schema([
                                    Forms\Components\TextInput::make('title_en')
                                        ->label('Title (English)')
                                        ->required(),
                                    Forms\Components\TextInput::make('title_ar')
                                        ->label('Title (Arabic)')
                                        ->required(),
                                    Forms\Components\Select::make('category_id')
                                        ->label('Category')
                                        ->options(fn () => self::getCategoryOptions())
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('name_en')
                                                ->label('Category (English)')
                                                ->required(),
                                            Forms\Components\TextInput::make('name_ar')
                                                ->label('Category (Arabic)')
                                                ->required(),
                                        ])
                                        ->createOptionUsing(fn (array $data): int => Category::create($data)->getKey())
                                        ->editOptionForm([
                                            Forms\Components\TextInput::make('name_en')
                                                ->label('Category (English)')
                                                ->required(),
                                            Forms\Components\TextInput::make('name_ar')
                                                ->label('Category (Arabic)')
                                                ->required(),
                                        ])
                                        ->updateOptionUsing(function (array $data, $state): int {
                                            $category = Category::findOrFail($state);
                                            $category->update($data);

                                            return $category->getKey();
                                        })
                                        ->required(),
                                    CustomRichEditor::make('description_en')
                                        ->label('Description (English)')
                                        ->simple()
                                        ->required()
                                        ->columnSpanFull(),
                                    CustomRichEditor::make('description_ar')
                                        ->label('Description (Arabic)')
                                        ->simple()
                                        ->required()
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    Forms\Components\Tabs\Tab::make('Image')
                        ->schema([
                            Forms\Components\Section::make('Main Image')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('glossary_image')
                                        ->collection('glossary_image')
                                        ->image()
                                        ->imageEditor(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name_en')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
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
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGlossaries::route('/'),
            'create' => Pages\CreateGlossary::route('/create'),
            'edit' => Pages\EditGlossary::route('/{record}/edit'),
        ];
    }

    protected static function getCategoryOptions(): array
    {
        return Category::query()
            ->orderBy('name_en')
            ->get()
            ->mapWithKeys(fn (Category $category) => [
                $category->id => trim(($category->name_en ?? '') . ' / ' . ($category->name_ar ?? ''), ' /'),
            ])
            ->toArray();
    }
}
