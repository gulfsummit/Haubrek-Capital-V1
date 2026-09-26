<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ToolsSubmissionResource\Pages;
use App\Filament\Admin\Resources\ToolsSubmissionResource\RelationManagers;
use App\Models\ToolsSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ToolsSubmissionResource extends Resource
{
    protected static ?string $model = ToolsSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Submissions';
    
    protected static ?string $navigationGroup = 'Tools Management';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $modelLabel = 'Tools Submission';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone')
                            ->disabled(),
                    ])
                    ->columns(3),
                
                Forms\Components\Section::make('Form Data')
                    ->schema([
                        Forms\Components\KeyValue::make('form_data')
                            ->label('Submitted Data')
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListToolsSubmissions::route('/'),
            'view' => Pages\ViewToolsSubmission::route('/{record}'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false;
    }
}
