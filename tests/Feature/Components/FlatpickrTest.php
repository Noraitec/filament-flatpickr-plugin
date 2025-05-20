<?php

namespace Tests\Feature\Components;

use Tests\TestCase;
use ReflectionClass;
use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;

uses(TestCase::class);

beforeEach(function () {
    // Asegurarnos de partir siempre de la configuración por defecto
    config()->offsetUnset('filament-flatpickr.assets');
    config()->offsetUnset('filament-flatpickr.plugins');
    config()->offsetUnset('filament-flatpickr.test');
});

it('uses the correct view name', function () {
    $ref  = new ReflectionClass(Flatpickr::class);
    $prop = $ref->getProperty('view');
    $prop->setAccessible(true);

    expect($prop->getValue(Flatpickr::make('foo')))
        ->toBe('filament-flatpickr::components.flatpickr');
});

it('returns local assets when assets config is local or missing by default', function () {
    // Por omisión (no hay clave) debe ser "local"
    $assets = Flatpickr::getAssets();

    expect($assets)
        ->toHaveCount(2)
        ->and($assets[0])->toContain('vendor/filament-flatpickr-plugin/flatpickr.js')
        ->and($assets[1])->toContain('vendor/filament-flatpickr-plugin/flatpickr.css');

    // Explicitamente local
    config(['filament-flatpickr.assets' => 'local']);
    $assets2 = Flatpickr::getAssets();

    expect($assets2)->toMatchArray($assets);
});

it('returns CDN assets when assets config is cdn', function () {
    config(['filament-flatpickr.assets' => 'cdn']);

    $assets = Flatpickr::getAssets();

    expect($assets)->toBe([
        'https://cdn.jsdelivr.net/npm/flatpickr',
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
    ]);
});

it('config() merges multiple option arrays', function () {
    $c = Flatpickr::make('foo')
        ->config(['x' => 1])
        ->config(['y' => 2]);

    expect($c->getOptions())->toMatchArray(['x' => 1, 'y' => 2]);
});

it('noCalendar() toggles noCalendar option', function () {
    $c1 = Flatpickr::make('foo')->noCalendar();
    expect($c1->getOptions())->toHaveKey('noCalendar', true);

    $c2 = Flatpickr::make('foo')->noCalendar(false);
    expect($c2->getOptions())->toHaveKey('noCalendar', false);
});

it('mode() sets the mode option', function () {
    $c = Flatpickr::make('foo')->mode('range');
    expect($c->getOptions())->toHaveKey('mode', 'range');
});

it('serializable(false) leaves options empty', function () {
    $c = Flatpickr::make('foo')->serializable(false);
    expect($c->getOptions())->toBeEmpty();
});

it('serializable(true) enforces multiple mode and injects JSON callback', function () {
    $c    = Flatpickr::make('foo')->serializable();
    $opts = $c->getOptions();

    expect($opts)
        ->toHaveKey('mode', 'multiple')
        ->toHaveKey('onChange')
        ->and($opts['onChange'])->toContain('JSON.stringify');
});

it('withPlugins returns self and merges uniquely with configured plugins', function () {
    config(['filament-flatpickr.plugins' => ['p1', 'p2']]);

    $c   = Flatpickr::make('foo');
    $ret = $c->withPlugins(['p2', 'p3', 'p3']);

    expect($ret)->toBe($c);
    expect($c->getPlugins())->toMatchArray(['p1', 'p2', 'p3']);
});

it('getPlugins handles missing or non-array config gracefully', function () {
    // Sin configuración → vacío
    $c1 = Flatpickr::make('foo');
    expect($c1->getPlugins())->toBe([]);

    // Config nula → vacío
    config(['filament-flatpickr.plugins' => null]);
    $c2 = Flatpickr::make('foo');
    expect($c2->getPlugins())->toBe([]);
});

it('getConfig returns value or default when missing', function () {
    config(['filament-flatpickr.test' => 'VALUE']);

    $c1 = new class('foo') extends Flatpickr {
        public function testGetConfig()
        {
            return $this->getConfig('filament-flatpickr.test', 'fallback');
        }
    };
    expect($c1->testGetConfig())->toBe('VALUE');

    config()->offsetUnset('filament-flatpickr.test');

    $c2 = new class('foo') extends Flatpickr {
        public function testGetConfig()
        {
            return $this->getConfig('filament-flatpickr.test', 'fallback');
        }
    };
    expect($c2->testGetConfig())->toBe('fallback');
});

it('getConfiguredPlugins returns config array or empty when missing', function () {
    config(['filament-flatpickr.plugins' => ['x','y']]);

    $c1 = new class('foo') extends Flatpickr {
        public function testGetConf(): array
        {
            return $this->getConfiguredPlugins();
        }
    };
    expect($c1->testGetConf())->toMatchArray(['x','y']);

    config()->offsetUnset('filament-flatpickr.plugins');

    $c2 = new class('foo') extends Flatpickr {
        public function testGetConf(): array
        {
            return $this->getConfiguredPlugins();
        }
    };
    expect($c2->testGetConf())->toBe([]);
});
