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
use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;
use Tests\TestCase;

it('configures options correctly', function () {
    $component = Flatpickr::make('fecha')->config(['inline' => true, 'weekNumbers' => true]);
    $options = $component->getOptions();
    expect($options['inline'])->toBeTrue();
    expect($options['weekNumbers'])->toBeTrue();
});

it('adds plugins correctly', function () {
    $component = Flatpickr::make('fecha')->withPlugins(['rangePlugin']);
    $plugins = $component->getPlugins();
    expect($plugins)->toContain('rangePlugin');
});

it('merges plugins with config', function () {
    $this->app['config']->set('filament-flatpickr.plugins', ['confirmDate']);
    $component = Flatpickr::make('fecha')->withPlugins(['rangePlugin']);
    $plugins = $component->getPlugins();
    expect($plugins)->toContain('confirmDate');
    expect($plugins)->toContain('rangePlugin');
});

it('sets and gets locale', function () {
    $component = Flatpickr::make('fecha')->locale('fr');
    expect($component->getLocale())->toBe('fr');
});

it('sets time options', function () {
    $component = Flatpickr::make('fecha')
        ->enableTime(true)
        ->time24hr(false)
        ->defaultHour(10);
    $options = $component->getOptions();
    expect($options['enableTime'])->toBeTrue();
    expect($options['time_24hr'])->toBeFalse();
    expect($options['defaultHour'])->toBe(10);
});

it('sets date options', function () {
    $component = Flatpickr::make('fecha')
        ->minDate('2023-01-01')
        ->maxDate('2023-12-31')
        ->defaultDate('2023-06-15');
    $options = $component->getOptions();
    expect($options['minDate'])->toBe('2023-01-01');
    expect($options['maxDate'])->toBe('2023-12-31');
    expect($options['defaultDate'])->toBe('2023-06-15');
});

it('sets UI config options', function () {
    $component = Flatpickr::make('fecha')
        ->inline(true)
        ->weekNumbers(true)
        ->showMonths(3);
    $options = $component->getOptions();
    expect($options['inline'])->toBeTrue();
    expect($options['weekNumbers'])->toBeTrue();
    expect($options['showMonths'])->toBe(3);
});