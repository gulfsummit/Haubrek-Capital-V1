<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WhitePaperDownloadResource\Pages;
use App\Models\WhitePaperDownload;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WhitePaperDownloadResource extends Resource
{
    protected static ?string $model = WhitePaperDownload::class;

    protected static ?string $navigationIcon  = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'White Paper Downloads';
    protected static ?string $modelLabel      = 'White Paper Download';
    protected static ?string $pluralModelLabel = 'White Paper Downloads';
    protected static ?string $navigationGroup = 'Submissions';
    protected static ?int    $navigationSort  = 11;

    // Read-only — downloads are submitted by front-end users
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Applicant Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('First Name')
                            ->disabled(),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Last Name')
                            ->disabled(),
                        Forms\Components\TextInput::make('business_email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->disabled(),
                        Forms\Components\TextInput::make('job_title')
                            ->label('Job Title')
                            ->disabled(),
                        Forms\Components\TextInput::make('company')
                            ->label('Company')
                            ->disabled(),
                        Forms\Components\TextInput::make('country')
                            ->label('Country')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('White Paper')
                    ->schema([
                        Forms\Components\TextInput::make('whitePaper.title_en')
                            ->label('White Paper Title')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('downloaded_at')
                            ->label('Downloaded At')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('business_email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title'),
                Tables\Columns\TextColumn::make('company')
                    ->label('Company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('Country'),
                Tables\Columns\TextColumn::make('whitePaper.title_en')
                    ->label('White Paper')
                    ->searchable(),
                Tables\Columns\TextColumn::make('downloaded_at')
                    ->label('Downloaded At')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('whitePaper')
                    ->relationship('whitePaper', 'title_en')
                    ->label('Filter by White Paper'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhitePaperDownloads::route('/'),
            'view'  => Pages\ViewWhitePaperDownload::route('/{record}'),
        ];
    }
}
