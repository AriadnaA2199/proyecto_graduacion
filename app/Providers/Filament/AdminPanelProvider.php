<?php

namespace App\Providers\Filament;

use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Panel;
use Filament\PanelProvider;
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;
use Solutionforest\FilamentScaffold\FilamentScaffoldPlugin; // Importa el plugin de Overlook
use Stephenjude\FilamentDebugger\DebuggerPlugin; // Importa el widget de Overlook

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#4b286d',
                'success' => '#66cc00',
                'warning' => '#8968a0',
                'danger' => '#54595f',
                'secondary' => '#c8b9d3',
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->resources([
                \App\Filament\Admin\Resources\AttendanceControlResource::class,
            ])
            ->widgets([
                OverlookWidget::class, // Añade el widget de Overlook
            ])
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ])
            ->authMiddleware([
                \Filament\Http\Middleware\Authenticate::class,
            ])
            ->plugin(FilamentScaffoldPlugin::make())
            ->plugins([
                GridstackDashboardPlugin::make()->columns(3),
                OverlookPlugin::make() // Añade la configuración del plugin Overlook aquí
                    ->sort(2)
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        'xl' => 5,
                        '2xl' => null,
                    ]),
            ])
            ->plugin(
                DebuggerPlugin::make()
                    ->navigationGroup(true, 'Debugger')
                    ->telescopeNavigation(
                        condition: fn () => true,
                        label: 'Telescope',
                        icon: 'heroicon-o-sparkles',
                        url: url('telescope'),
                        openInNewTab: true
                    )
            )
            ->default();
    }
}
