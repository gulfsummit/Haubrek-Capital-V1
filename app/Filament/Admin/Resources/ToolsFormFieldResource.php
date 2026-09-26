<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ToolsFormFieldResource\Pages;
use App\Filament\Admin\Resources\ToolsFormFieldResource\RelationManagers;
use App\Models\ToolsFormField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ToolsFormFieldResource extends Resource
{
    protected static ?string $model = ToolsFormField::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationLabel = 'Form Fields';
    
    protected static ?string $navigationGroup = 'Tools Management';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $modelLabel = 'Form Field';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Field Information')
                    ->schema([
                        Forms\Components\TextInput::make('label_en')
                            ->label('Field Label (English)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Name, Email, Age Group'),
                        
                        Forms\Components\TextInput::make('label_ar')
                            ->label('Field Label (Arabic)')
                            ->maxLength(255)
                            ->placeholder('e.g., الاسم، البريد الإلكتروني، الفئة العمرية'),
                        
                        Forms\Components\TextInput::make('field_name')
                            ->label('Field Name (for form submission)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., name, email, age_group')
                            ->helperText('Use lowercase with underscores. This will be used as the HTML name attribute.')
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z_]+$/'),
                        
                        Forms\Components\Select::make('field_type')
                            ->label('Field Type')
                            ->required()
                            ->options([
                                'text' => 'Text Input',
                                'email' => 'Email Input',
                                'tel' => 'Phone Number',
                                'number' => 'Number Input',
                                'textarea' => 'Text Area',
                                'radio' => 'Radio Buttons',
                                'checkbox' => 'Checkboxes',
                                'select' => 'Dropdown Select',
                            ])
                            ->default('text')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Clear options if switching to a field type that doesn't need them
                                if (!in_array($state, ['radio', 'checkbox', 'select'])) {
                                    $set('options_en', null);
                                    $set('options_ar', null);
                                }
                            }),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Field Options (for Radio/Checkbox/Select)')
                    ->schema([
                        Forms\Components\Repeater::make('options_en')
                            ->label('Options (English)')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Option Value')
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['value'] ?? null),
                        
                        Forms\Components\Repeater::make('options_ar')
                            ->label('Options (Arabic)')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Option Value')
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['value'] ?? null),
                    ])
                    ->visible(fn (callable $get) => in_array($get('field_type'), ['radio', 'checkbox', 'select']))
                    ->columns(2),
                
                Forms\Components\Section::make('Additional Settings')
                    ->schema([
                        Forms\Components\TextInput::make('placeholder_en')
                            ->label('Placeholder (English)')
                            ->maxLength(255)
                            ->placeholder('e.g., Your name, example@company.com'),
                        
                        Forms\Components\TextInput::make('placeholder_ar')
                            ->label('Placeholder (Arabic)')
                            ->maxLength(255)
                            ->placeholder('e.g., اسمك، example@company.com'),
                        
                        Forms\Components\Toggle::make('is_required')
                            ->label('Required Field')
                            ->default(false),
                        
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Fields will be displayed in ascending order'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable()
                    ->badge(),
                
                Tables\Columns\TextColumn::make('label_en')
                    ->label('Label (EN)')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('field_name')
                    ->label('Field Name')
                    ->searchable()
                    ->badge()
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('field_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text', 'email', 'tel', 'number' => 'info',
                        'textarea' => 'warning',
                        'radio', 'checkbox', 'select' => 'primary',
                        default => 'gray',
                    }),
                
                Tables\Columns\IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('field_type')
                    ->label('Field Type')
                    ->options([
                        'text' => 'Text Input',
                        'email' => 'Email Input',
                        'tel' => 'Phone Number',
                        'number' => 'Number Input',
                        'textarea' => 'Text Area',
                        'radio' => 'Radio Buttons',
                        'checkbox' => 'Checkboxes',
                        'select' => 'Dropdown Select',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_required')
                    ->label('Required'),
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
            'index' => Pages\ListToolsFormFields::route('/'),
            'create' => Pages\CreateToolsFormField::route('/create'),
            'edit' => Pages\EditToolsFormField::route('/{record}/edit'),
        ];
    }
}
