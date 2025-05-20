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
            ->name('filament-flatpickr')
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted(): void
    {
        // Publicar assets al path correcto
        $this->publishes([
            __DIR__ . '/../../resources/flatpickr' => public_path('vendor/filament-flatpickr'),
            __DIR__ . '/../../resources/js' => public_path('vendor/filament-flatpickr'),
        ], 'filament-flatpickr-assets');

        // Cargar assets
        if (! config('filament-flatpickr.use_cdn', true)) {
            $base = asset('vendor/filament-flatpickr');

            $assets = [
                Css::make('flatpickr-css', "{$base}/flatpickr.min.css"),
                Js::make('flatpickr-js', "{$base}/flatpickr.min.js")->module(false),
                Js::make('flatpickr-init', "{$base}/flatpickr-init.js")->module(false),
            ];

            // Idioma
            $locale = config('filament-flatpickr.default_locale', 'en');
            if ($locale) {
                $localePath = "{$base}/l10n/{$locale}.js";
                if (file_exists(public_path("vendor/filament-flatpickr/l10n/{$locale}.js"))) {
                    $assets[] = Js::make('flatpickr-locale', $localePath)->module(false);
                }
            }

            // Plugins
            $plugins = config('filament-flatpickr.plugins', []);
            if (! is_array($plugins)) {
                $plugins = [];
            }

            foreach ($plugins as $plugin) {
                // Plugin en subcarpeta
                if (file_exists(public_path("vendor/filament-flatpickr/plugins/{$plugin}/{$plugin}.js"))) {
                    $assets[] = Js::make("flatpickr-plugin-{$plugin}", "{$base}/plugins/{$plugin}/{$plugin}.js")->module(false);
                }
                if (file_exists(public_path("vendor/filament-flatpickr/plugins/{$plugin}/{$plugin}.css"))) {
                    $assets[] = Css::make("flatpickr-plugin-{$plugin}", "{$base}/plugins/{$plugin}/{$plugin}.css");
                }

                // Plugin como archivo suelto
                if (file_exists(public_path("vendor/filament-flatpickr/plugins/{$plugin}.js"))) {
                    $assets[] = Js::make("flatpickr-plugin-{$plugin}", "{$base}/plugins/{$plugin}.js")->module(false);
                }
                if (file_exists(public_path("vendor/filament-flatpickr/plugins/{$plugin}.css"))) {
                    $assets[] = Css::make("flatpickr-plugin-{$plugin}", "{$base}/plugins/{$plugin}.css");
                }
            }

            FilamentAsset::register($assets);
        } else {
            // CDN
            $cdn = config('filament-flatpickr.cdn_url', 'https://cdn.jsdelivr.net/npm/flatpickr');

            FilamentAsset::register([
                Css::make('flatpickr-css', "{$cdn}/dist/flatpickr.min.css"),
            ]);
            $locale = config('filament-flatpickr.default_locale', 'en');
            FilamentView::registerRenderHook(
                'scripts.end',
                fn() => <<<HTML
    <script src="{$cdn}"></script>
    <script src="{$cdn}/dist/l10n/{$locale}.js"></script>
HTML
            );
        }
    }
}
