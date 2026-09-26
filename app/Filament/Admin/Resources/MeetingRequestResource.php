<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MeetingRequestResource\Pages;
use App\Filament\Admin\Resources\MeetingRequestResource\RelationManagers;
use App\Models\MeetingRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetingRequestResource extends Resource
{
    protected static ?string $model = MeetingRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Meeting Requests';

    protected static ?string $modelLabel = 'Meeting Request';

    protected static ?string $pluralModelLabel = 'Meeting Requests';

    protected static ?string $navigationGroup = 'Submissions';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\RichEditor::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Investment Profile')
                    ->schema([
                        Forms\Components\Select::make('percentage')
                            ->label('Risk Investment Percentage')
                            ->options([
                                'Less than 25%' => 'Less than 25%',
                                '25-50%' => '25-50%',
                                '50-75%' => '50-75%',
                                'More than 75%' => 'More than 75%',
                            ])
                            ->required(),
                        Forms\Components\Select::make('age_group')
                            ->options([
                                'Under 30' => 'Under 30',
                                '30-45' => '30-45',
                                '46-60' => '46-60',
                                'Over 60' => 'Over 60',
                            ])
                            ->required(),
                        Forms\Components\Select::make('investment_experience')
                            ->options([
                                'None' => 'None',
                                'Limited' => 'Limited',
                                'Moderate' => 'Moderate',
                                'Extensive' => 'Extensive',
                            ])
                            ->required(),
                        Forms\Components\Select::make('wealth_size')
                            ->options([
                                'Less than USD 1 million' => 'Less than USD 1 million',
                                'USD 1 million - USD 10 million' => 'USD 1 million - USD 10 million',
                                'USD 10 million - USD 50 million' => 'USD 10 million - USD 50 million',
                                'USD 50 million - USD 500 million' => 'USD 50 million - USD 500 million',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Investment Details')
                    ->schema([
                        Forms\Components\CheckboxList::make('investment_goal')
                            ->options([
                                'Capital Preservation' => 'Capital Preservation',
                                'Income Generation' => 'Income Generation',
                                'Capital Growth' => 'Capital Growth',
                            ])
                            ->required(),
                        Forms\Components\Select::make('investment_horizon')
                            ->options([
                                'Less than 3 years' => 'Less than 3 years',
                                '3-5 years' => '3-5 years',
                                'More than 5 years' => 'More than 5 years',
                            ])
                            ->required(),
                        Forms\Components\CheckboxList::make('investment_reaction')
                            ->label('Reaction to 10% Loss')
                            ->options([
                                'Sell all investments' => 'Sell all investments',
                                'Sell some investments' => 'Sell some investments',
                                'Do nothing' => 'Do nothing',
                                'Buy more investments' => 'Buy more investments',
                            ])
                            ->required(),
                        Forms\Components\CheckboxList::make('income_source')
                            ->options([
                                'Salary' => 'Salary',
                                'Business Income' => 'Business Income',
                                'Investment Income' => 'Investment Income',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Investment Style & Allocation')
                    ->schema([
                        Forms\Components\CheckboxList::make('investment_style')
                            ->options([
                                'Conservative (low risk, lower returns)' => 'Conservative (low risk, lower returns)',
                                'Balanced (moderate risk, moderate returns)' => 'Balanced (moderate risk, moderate returns)',
                                'Aggressive (high risk, higher returns)' => 'Aggressive (high risk, higher returns)',
                            ])
                            ->required(),
                        Forms\Components\CheckboxList::make('asset_allocation')
                            ->options([
                                'Equities' => 'Equities',
                                'Bonds' => 'Bonds',
                                'Real Estate' => 'Real Estate',
                                'Cash' => 'Cash',
                                'Family Business' => 'Family Business',
                                'Other Investments' => 'Other Investments',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wealth_size')
                    ->label('Wealth Size')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Less than USD 1 million' => 'gray',
                        'USD 1 million - USD 10 million' => 'success',
                        'USD 10 million - USD 50 million' => 'warning',
                        'USD 50 million - USD 500 million' => 'danger',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('investment_experience')
                    ->label('Experience')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'None' => 'gray',
                        'Limited' => 'warning',
                        'Moderate' => 'info',
                        'Extensive' => 'success',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('Risk %')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Less than 25%' => 'success',
                        '25-50%' => 'info',
                        '50-75%' => 'warning',
                        'More than 75%' => 'danger',
                    })
                    ->sortable(),
                Tables\Columns\IconColumn::make('meets_requirements')
                    ->label('Eligible')
                    ->boolean()
                    ->getStateUsing(function ($record) {
                        return self::checkEligibilityConditions($record);
                    })
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('wealth_size')
                    ->options([
                        'Less than USD 1 million' => 'Less than USD 1 million',
                        'USD 1 million - USD 10 million' => 'USD 1 million - USD 10 million',
                        'USD 10 million - USD 50 million' => 'USD 10 million - USD 50 million',
                        'USD 50 million - USD 500 million' => 'USD 50 million - USD 500 million',
                    ]),
                Tables\Filters\SelectFilter::make('investment_experience')
                    ->options([
                        'None' => 'None',
                        'Limited' => 'Limited',
                        'Moderate' => 'Moderate',
                        'Extensive' => 'Extensive',
                    ]),
                Tables\Filters\TernaryFilter::make('meets_requirements')
                    ->label('Eligible for Appointment')
                    ->placeholder('All requests')
                    ->trueLabel('Eligible')
                    ->falseLabel('Not Eligible')
                    ->queries(
                        true: fn (Builder $query) => $query->where(function ($q) {
                            $q->where('percentage', '!=', 'More than 75%')
                              ->where('investment_experience', '!=', 'None')
                              ->where('wealth_size', '!=', 'Less than USD 1 million');
                        }),
                        false: fn (Builder $query) => $query->where(function ($q) {
                            $q->where('percentage', 'More than 75%')
                              ->orWhere('investment_experience', 'None')
                              ->orWhere('wealth_size', 'Less than USD 1 million');
                        }),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    /**
     * Check if user meets eligibility conditions for appointment
     */
    private static function checkEligibilityConditions($record)
    {
        // Condition 1: Percentage of assets for higher-risk investments
        // TRUE: Less than 25%, 25-50%, 50-75%
        // FALSE: More than 75%
        $percentageCondition = $record->percentage !== 'More than 75%';

        // Condition 2: Investment experience
        // TRUE: Limited, Moderate, Extensive
        // FALSE: None
        $experienceCondition = $record->investment_experience !== 'None';

        // Condition 3: Total wealth size
        // TRUE: USD 1 million - USD 10 million, USD 10 million - USD 50 million, USD 50 million - USD 500 million
        // FALSE: Less than USD 1 million
        $wealthCondition = $record->wealth_size !== 'Less than USD 1 million';

        // All conditions must be true for eligibility
        return $percentageCondition && $experienceCondition && $wealthCondition;
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
            'index' => Pages\ListMeetingRequests::route('/'),
            'create' => Pages\CreateMeetingRequest::route('/create'),
            'edit' => Pages\EditMeetingRequest::route('/{record}/edit'),
        ];
    }
}
