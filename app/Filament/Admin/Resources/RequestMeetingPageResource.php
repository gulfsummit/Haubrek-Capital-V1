<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RequestMeetingPageResource\Pages;
use Filament\Forms\Form;

class RequestMeetingPageResource extends BasePageCopyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Request Meeting Page';

    protected static ?string $modelLabel = 'Request Meeting Page';

    protected static ?string $pluralModelLabel = 'Request Meeting Page';

    protected static ?int $navigationSort = 18;

    public static function form(Form $form): Form
    {
        return $form->schema([
            static::identitySection(),
            \Filament\Forms\Components\Tabs::make('Request Meeting Page Content')
                ->tabs([
                    static::visibilityTab([
                        'hero' => 'Hero Section',
                        'form' => 'Form Section',
                    ]),
                    static::heroTab(),
                    static::requestMeetingTab(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestMeetingPages::route('/'),
            'edit' => Pages\EditRequestMeetingPage::route('/{record}/edit'),
        ];
    }

    protected static function getManagedSlugs(): array
    {
        return ['request-meeting'];
    }
}
