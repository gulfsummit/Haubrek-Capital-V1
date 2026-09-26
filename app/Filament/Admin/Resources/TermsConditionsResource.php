<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TermsConditionsResource\Pages;
use App\Filament\Admin\Resources\TermsConditionsResource\RelationManagers;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\TermsConditions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TermsConditionsResource extends Resource
{
    protected static ?string $model = TermsConditions::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Terms & Conditions';

    protected static ?string $navigationGroup = 'Website Settings';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(1),

                SectionVisibility::section([
                    'hero' => 'Hero Section',
                    'content' => 'Content Section',
                ]),

                Forms\Components\Section::make('Hero Images')
                    ->schema([
                        ...ImageWithAlt::make('hero_desktop_image', 'Desktop Background', fn ($component) => $component->directory('terms-conditions/hero')->helperText('Recommended: 1920x1080px')),
                        ...ImageWithAlt::make('hero_mobile_image', 'Mobile Background', fn ($component) => $component->directory('terms-conditions/hero')->helperText('Recommended: 768x1024px')),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Tabs::make('Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Page Title')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\RichEditor::make('content_en')
                                    ->label('Content')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'h1',
                                        'h2',
                                        'h3',
                                        'strike',
                                        'link',
                                        'bulletList',
                                        'orderedList',
                                        'blockquote',
                                        'undo',
                                        'redo',
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Arabic')
                            ->schema([
                                Forms\Components\TextInput::make('title_ar')
                                    ->label('Page Title')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\RichEditor::make('content_ar')
                                    ->label('Content')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'h1',
                                        'h2',
                                        'h3',
                                        'strike',
                                        'link',
                                        'bulletList',
                                        'orderedList',
                                        'blockquote',
                                        'undo',
                                        'redo',
                                    ])
                                    ->columnSpanFull(),
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
                    ->label('Title (EN)')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('title_ar')
                    ->label('Title (AR)')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

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
                //
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
            'index' => Pages\ListTermsConditions::route('/'),
            'create' => Pages\CreateTermsConditions::route('/create'),
            'edit' => Pages\EditTermsConditions::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return TermsConditions::count() === 0;
    }
}
