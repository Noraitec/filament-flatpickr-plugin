<?php

use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;

uses(Tests\TestCase::class);

it('returns CDN assets by default', function () {
    config(['filament-flatpickr.assets' => 'cdn']);

    $assets = Flatpickr::getAssets();

    expect($assets)->toBeArray()->toHaveCount(2);

    expect($assets[0])->toBe('https://cdn.jsdelivr.net/npm/flatpickr');
    expect($assets[1])->toBe('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
});

it('returns local assets when assets config is local', function () {
    config(['filament-flatpickr.assets' => 'local']);

    $assets = Flatpickr::getAssets();

    expect($assets)->toBeArray()->toHaveCount(2);

    expect($assets[0])->toContain('vendor/filament-flatpickr-plugin/flatpickr.js');
    expect($assets[1])->toContain('vendor/filament-flatpickr-plugin/flatpickr.css');
});

it('config() merges multiple option arrays', function () {
    $component = Flatpickr::make('test')
        ->config(['foo' => 1])
        ->config(['bar' => 2]);

    expect($component->getOptions())->toMatchArray([
        'foo' => 1,
        'bar' => 2,
    ]);
});

it('noCalendar() sets the noCalendar option to true', function () {
    $component = Flatpickr::make('test')->noCalendar();

    expect($component->getOptions())
        ->toHaveKey('noCalendar', true);
});

it('mode() sets the mode option', function () {
    $component = Flatpickr::make('test')->mode('range');

    expect($component->getOptions())
        ->toHaveKey('mode', 'range');
});

it('serializable(false) does not set any options', function () {
    $component = Flatpickr::make('test')->serializable(false);

    expect($component->getOptions())->toBeEmpty();
});

it('serializable(true) forces multiple mode and injects onChange callback', function () {
    $component = Flatpickr::make('test')->serializable();

    $opts = $component->getOptions();

    expect($opts)
        ->toHaveKey('mode', 'multiple')
        ->toHaveKey('onChange');

    // chequeamos que el callback JSON.stringify aparezca en la cadena
    expect($opts['onChange'])->toContain('JSON.stringify');
});

it('withPlugins returns same instance and getPlugins merges correctly', function () {
    $component = new class('test') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            return ['confirmDate'];
        }
    };

    $returned = $component->withPlugins(['rangePlugin', 'confirmDate']);

    expect($returned)->toBe($component);

    // getPlugins debe unificar y mantener orden: primero los config, luego los de withPlugins
    expect($component->getPlugins())->toMatchArray([
        'confirmDate',
        'rangePlugin',
    ]);
});
