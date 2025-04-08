<?php

namespace Noraitec\FilamentFlatpickrPlugin\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlatpickrPluginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-flatpickr-plugin')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponents('filament-flatpickr-plugin');
            // 👇 NO INCLUIMOS ->hasAssets() porque no usas /resources/dist
    }

    public function packageBooted(): void
    {
        // Publicación manual de assets
        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('vendor/filament-flatpickr-plugin'),
        ], 'filament-flatpickr-plugin-assets');

        // Publicación de config
        $this->publishes([
            __DIR__ . '/../../config/filament-flatpickr.php' => config_path('filament-flatpickr.php'),
        ], 'filament-flatpickr-plugin-config');

        // Cargar assets según configuración
        if (config('filament-flatpickr.assets', 'cdn') === 'cdn') {
            FilamentAsset::register([
                Css::make('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'),
            ]);

            FilamentView::registerRenderHook('scripts.end', fn () => <<<'HTML'
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            HTML);
        } else {
            FilamentAsset::register([
                Css::make('flatpickr', asset('vendor/filament-flatpickr-plugin/flatpickr.min.css')),
                Js::make('flatpickr', asset('vendor/filament-flatpickr-plugin/flatpickr.min.js')),
            ]);
        }
    }
}