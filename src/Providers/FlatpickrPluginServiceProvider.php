<?php

namespace Noraitec\FilamentFlatpickrPlugin\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlatpickrPluginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-flatpickr') // Este define el nombre del config: config/filament-flatpickr.php
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponents('filament-flatpickr-plugin');
    }

    public function packageBooted(): void
    {
        // Publicar assets
        $this->publishes([
            __DIR__ . '/../../resources/flatpickr' => public_path('vendor/filament-flatpickr-plugin'),
        ], 'filament-flatpickr-plugin-assets');

        // Publicar config
        $this->publishes([
            __DIR__ . '/../../config/filament-flatpickr.php' => config_path('filament-flatpickr.php'),
        ], 'filament-flatpickr-plugin-config');

        // Cargar assets dependiendo de la configuración
        if (!config('filament-flatpickr.use_cdn', true)) {
            $base = asset('vendor/filament-flatpickr-plugin');

            $assets = [
                Css::make('flatpickr-css', "$base/flatpickr.min.css"),
                Js::make('flatpickr-js', "$base/flatpickr.min.js"),
            ];

            // Idioma
            $locale = config('filament-flatpickr.default_locale');
            if ($locale) {
                $assets[] = Js::make("flatpickr-locale", "$base/l10n/{$locale}.js");
            }

            // Plugins
            $plugins = config('filament-flatpickr.plugins', []);
            if (!is_array($plugins)) {
                $plugins = [];
            }

            foreach ($plugins as $plugin) {
                $pluginDir = public_path("vendor/filament-flatpickr-plugin/plugins/$plugin");

                // Caso: plugin como carpeta (e.g., plugins/confirmDate/confirmDate.js)
                if (file_exists("$pluginDir/$plugin.js")) {
                    $assets[] = Js::make("flatpickr-plugin-$plugin", "$base/plugins/$plugin/$plugin.js");
                }

                if (file_exists("$pluginDir/$plugin.css")) {
                    $assets[] = Css::make("flatpickr-plugin-$plugin", "$base/plugins/$plugin/$plugin.css");
                }

                // Caso: plugin como archivo suelto (e.g., plugins/rangePlugin.js)
                if (file_exists(public_path("vendor/filament-flatpickr-plugin/plugins/$plugin.js"))) {
                    $assets[] = Js::make("flatpickr-plugin-$plugin", "$base/plugins/$plugin.js");
                }

                if (file_exists(public_path("vendor/filament-flatpickr-plugin/plugins/$plugin.css"))) {
                    $assets[] = Css::make("flatpickr-plugin-$plugin", "$base/plugins/$plugin.css");
                }
            }

            FilamentAsset::register($assets);
        } else {
            // Cargar desde CDN
            $cdn = config('filament-flatpickr.cdn_url', 'https://cdn.jsdelivr.net/npm/flatpickr');

            FilamentAsset::register([
                Css::make('flatpickr-css', "$cdn/dist/flatpickr.min.css"),
            ]);

            FilamentView::registerRenderHook('scripts.end', fn () => <<<HTML
                <script src="$cdn"></script>
            HTML);
        }
    }
}
