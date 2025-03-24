<?php
/**
 * This file is part of the Noraitec Filament Flatpickr Plugin.
 *
 * (c) Noraitec dsotelo@noraitec.com
 *
 * This source file is subject to the GNU Lesser General Public License (LGPL-3.0)
 * that is bundled with this source code in the LICENSE file.
 * For details see <https://www.gnu.org/licenses/lgpl-3.0.html>
 */

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
        // Vistas del componente
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-flatpickr-plugin');
        // Publicar vistas
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-flatpickr'),
        ], 'filament-flatpickr-views');

        // Publicar assets locales (JS/CSS/idiomas)
        $this->publishes([
            __DIR__.'/../resources/flatpickr/dist' => public_path('vendor/filament-flatpickr'),
        ], 'filament-flatpickr-assets');
        // Publicar assets locales (JS/CSS/idiomas)
        $this->publishes([
            __DIR__.'/../config/filament-flatpickr.php' => config_path('filament-flatpickr.php'),
        ], 'filament-flatpickr-config');

        // Registrar assets locales (sin CDN)
        FilamentAsset::register([
            Css::make('flatpickr', asset('vendor/filament-flatpickr/flatpickr.min.css')),
            Js::make('flatpickr', asset('vendor/filament-flatpickr/flatpickr.min.js')),

            Js::make('flatpickr-es', asset('vendor/filament-flatpickr/l10n/es.js')),
            Js::make('flatpickr-fr', asset('vendor/filament-flatpickr/l10n/fr.js')),
            Js::make('flatpickr-pt', asset('vendor/filament-flatpickr/l10n/pt.js')),
        ]);
    }
}