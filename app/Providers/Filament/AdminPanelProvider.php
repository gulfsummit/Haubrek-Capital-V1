<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Submissions')
                    ->collapsible()
                    ->icon('heroicon-o-inbox-stack'),
                \Filament\Navigation\NavigationGroup::make('Tools Management')
                    ->collapsible()
                    ->icon('heroicon-o-wrench-screwdriver'),
                \Filament\Navigation\NavigationGroup::make('Page Builder')
                    ->collapsible()
                    ->icon('heroicon-o-document-text'),
                \Filament\Navigation\NavigationGroup::make('Content Management')
                    ->collapsible()
                    ->icon('heroicon-o-folder'),
                \Filament\Navigation\NavigationGroup::make('Website Settings')
                    ->collapsible()
                    ->icon('heroicon-o-cog-6-tooth'),
                \Filament\Navigation\NavigationGroup::make('User Management')
                    ->collapsible()
                    ->icon('heroicon-o-users'),
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                'panels::body.end',
                fn () => view('filament.hooks.rich-editor-font-size')
            );
    }

    public function boot(): void
    {
        parent::boot();
        
        // Register custom assets for rich editor font size control
        FilamentAsset::register([
            Js::make('rich-editor-font-size', resource_path('js/rich-editor-font-size.js')),
            Css::make('rich-editor-custom', resource_path('css/rich-editor-custom.css')),
        ], 'app');
    }
}

