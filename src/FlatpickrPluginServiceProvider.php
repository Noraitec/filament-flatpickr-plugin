<?php
namespace Noraitec\FilamentFlatpickrPlugin;

use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;

class FlatpickrPluginServiceProvider extends ServiceProvider
{
    /**
     * Arranque de aplicaciones.
     *
     * @return void
     */
    public function register(): void
    {

    }
        
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-flatpickr');
    
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-flatpickr'),
        ], 'filament-flatpickr-views');
    
        FilamentAsset::register([
            // Flatpickr core
            Css::make('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'),
            Js::make('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr'),
    
            // Locales que vamos a soportar
            Js::make('flatpickr-es', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js'),
            Js::make('flatpickr-fr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js'),
            Js::make('flatpickr-de', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/de.js'),
        ]);
    }
}