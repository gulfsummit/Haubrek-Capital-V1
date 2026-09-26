<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CareerApplicationResource\Pages;
use App\Filament\Admin\Resources\CareerApplicationResource\RelationManagers;
use App\Models\CareerApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerApplicationResource extends Resource
{
    protected static ?string $model = CareerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Career Applications';

    protected static ?string $modelLabel = 'Career Application';

    protected static ?string $pluralModelLabel = 'Career Applications';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application Details')
                    ->schema([
                        Forms\Components\RichEditor::make('name')
                            ->label('Full Name')
                            ->required()
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\RichEditor::make('mobile')
                            ->label('Mobile Number')
                            ->required()
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\FileUpload::make('cv_path')
                            ->label('CV File')
                            ->disabled()
                            ->dehydrated(false)
                            ->downloadable()
                            ->openable(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Application Date')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cv_path')
                    ->label('CV File')
                    ->formatStateUsing(fn (string $state): string => basename($state))
                    ->url(fn ($record) => $record->cv_url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Applied Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Until Date'),
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
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListCareerApplications::route('/'),
            'view' => Pages\ViewCareerApplication::route('/{record}'),
        ];
    }
}
