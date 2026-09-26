<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NewsletterResource\Pages;
use App\Filament\Admin\Resources\NewsletterResource\RelationManagers;
use App\Models\Newsletter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    protected static ?string $navigationLabel = 'Newsletter Popup';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Popup Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable or disable the newsletter popup'),
                    ])
                    ->columns(1),
                
                Forms\Components\Tabs::make('Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('tag_en')
                                    ->label('Tag (e.g., WHAT WE DO)')
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->default('OUR NEWSLETTER'),
                                
                                Forms\Components\Textarea::make('description_en')
                                    ->label('Description')
                                    ->required()
                                    ->rows(3)
                                    ->default('Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.'),
                                
                                Forms\Components\TextInput::make('placeholder_en')
                                    ->label('Email Placeholder')
                                    ->maxLength(255)
                                    ->default('Subscribe to Our Newsletter'),
                                
                                Forms\Components\TextInput::make('button_text_en')
                                    ->label('Button Text')
                                    ->maxLength(255)
                                    ->default('SUBSCRIBE'),
                            ])
                            ->columns(1),
                        
                        Forms\Components\Tabs\Tab::make('Arabic')
                            ->schema([
                                Forms\Components\TextInput::make('tag_ar')
                                    ->label('Tag (Arabic)')
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('title_ar')
                                    ->label('Title (Arabic)')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description_ar')
                                    ->label('Description (Arabic)')
                                    ->rows(3),
                                
                                Forms\Components\TextInput::make('placeholder_ar')
                                    ->label('Email Placeholder (Arabic)')
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('button_text_ar')
                                    ->label('Button Text (Arabic)')
                                    ->maxLength(255),
                            ])
                            ->columns(1),
                    ]),
                
                Forms\Components\Section::make('Popup Image')
                    ->schema([
                        Forms\Components\FileUpload::make('popup_image')
                            ->label('Popup Image')
                            ->image()
                            ->directory('newsletter')
                            ->maxSize(5120)
                            ->helperText('Upload an image for the left side of the popup'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->limit(50),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}
