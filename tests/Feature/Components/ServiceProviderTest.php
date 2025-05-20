<?php

use Noraitec\FilamentFlatpickrPlugin\Providers\FlatpickrPluginServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->provider = new FlatpickrPluginServiceProvider(app());
});

it('registers local assets when use_cdn is false', function () {
    config([
        'filament-flatpickr.use_cdn' => false,
    ]);

    FilamentAsset::shouldReceive('register')
        ->once()
        ->withArgs(function (array $assets) {
            // CSS + flatpickr.js + init.js
            expect($assets)->toHaveCount(3);

            // Primer asset: CSS
            expect($assets[0])->toBeInstanceOf(Css::class);
            expect($assets[0]->getHref())->toContain('vendor/filament-flatpickr/flatpickr.min.css');

            // Segundo asset: flatpickr JS
            expect($assets[1])->toBeInstanceOf(Js::class);
            expect($assets[1]->getSrc())->toContain('vendor/filament-flatpickr/flatpickr.min.js');

            // Tercer asset: init JS
            expect($assets[2])->toBeInstanceOf(Js::class);
            expect($assets[2]->getSrc())->toContain('vendor/filament-flatpickr/flatpickr-init.js');

            return true;
        });

    $this->provider->packageBooted();
});

it('registers CDN assets and view hook when use_cdn is true', function () {
    config([
        'filament-flatpickr.use_cdn'        => true,
        'filament-flatpickr.cdn_url'        => 'https://cdn.example.com/flatpickr',
        'filament-flatpickr.default_locale' => 'fr',
    ]);

    FilamentAsset::shouldReceive('register')
        ->once()
        ->withArgs(function (array $assets) {
            expect($assets)->toHaveCount(1);
            expect($assets[0])->toBeInstanceOf(Css::class);
            expect($assets[0]->getHref())->toBe('https://cdn.example.com/flatpickr/dist/flatpickr.min.css');
            return true;
        });

    FilamentView::shouldReceive('registerRenderHook')
        ->once()
        ->withArgs(function (string $name, Closure $hook, $scopes) {
            // El hook debe registrarse en 'scripts.end' con scopes null
            expect($name)->toBe('scripts.end');
            expect($scopes)->toBeNull();

            // Ejecutamos el closure para comprobar su salida HTML
            $html = $hook();
            expect($html)->toContain('<script src="https://cdn.example.com/flatpickr"></script>');
            expect($html)->toContain('<script src="https://cdn.example.com/flatpickr/dist/l10n/fr.js"></script>');

            return true;
        });

    $this->provider->packageBooted();
});