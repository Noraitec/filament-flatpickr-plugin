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


use Tests\TestCase;
use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;

uses(TestCase::class);

class DummyHasLimitsComponent {
    use \Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLimits;

    public array $options = [];
}

it('sets minDate and maxDate in dummy component', function () {
    $component = new DummyHasLimitsComponent();
    $component->minDate('2024-01-01')->maxDate('2024-12-31');

    expect($component->options)->toMatchArray([
        'minDate' => '2024-01-01',
        'maxDate' => '2024-12-31',
    ]);
});

it('sets disableFunction in dummy component', function () {
    $component = new DummyHasLimitsComponent();
    $component->disableFunction('function() { return true; }');

    expect($component->options)->toHaveKey('disable');
    expect($component->options['disable'])->toContain('function() { return true; }');
});

it('sets enableFunction in dummy component', function () {
    $component = new DummyHasLimitsComponent();
    $component->enableFunction('function() { return true; }');

    expect($component->options)->toHaveKey('enable');
    expect($component->options['enable'])->toContain('function() { return true; }');
});

it('sets minDate and maxDate correctly', function () {
    $component = Flatpickr::make('fecha')
        ->minDate('2024-01-01')
        ->maxDate('2024-12-31');

    $options = $component->getOptions();

    expect($options)->toMatchArray([
        'minDate' => '2024-01-01',
        'maxDate' => '2024-12-31',
    ]);
});

it('sets disableFunction and enableFunction correctly', function () {
    $component = Flatpickr::make('fecha')
        ->disableFunction('function(date) { return date.getDay() === 0; }')
        ->enableFunction('function(date) { return date.getDay() !== 6; }');

    $options = $component->getOptions();

    expect($options)->toHaveKey('disable');
    expect($options['disable'])->toBeArray()->toContain('function(date) { return date.getDay() === 0; }');

    expect($options)->toHaveKey('enable');
    expect($options['enable'])->toBeArray()->toContain('function(date) { return date.getDay() !== 6; }');
});

it('sets disable function', function () {
    $component = Flatpickr::make('fecha')->disableFunction('function() { return true; }');
    expect($component->getOptions())->toHaveKey('disable', ['function() { return true; }']);
});

it('sets enable function', function () {
    $component = Flatpickr::make('fecha')->enableFunction('function() { return false; }');
    expect($component->getOptions())->toHaveKey('enable', ['function() { return false; }']);
});