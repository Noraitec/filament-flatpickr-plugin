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
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLocalization;

uses(TestCase::class);

class DummyLocalizationComponent {
    use HasLocalization;

    public array $options = [];
}

it('sets locale via trait', function () {
    $component = new DummyLocalizationComponent();
    $component->locale('fr');

    expect($component->getLocale())->toBe('fr');
});

it('sets and gets locale correctly', function () {
    $component = Flatpickr::make('fecha')->locale('es');
    expect($component->getLocale())->toBe('es');
});

it('sets localization options correctly', function () {
    $component = Flatpickr::make('fecha')
        ->altInput()
        ->altFormat('F j, Y')
        ->altInputClass('custom-class')
        ->dateFormat('Y-m-d')
        ->ariaDateFormat('Y/m/d')
        ->conjunction(' y ')
        ->shorthandCurrentMonth()
        ->weekNumbers();

    $options = $component->getOptions();

    expect($options)->toMatchArray([
        'altInput' => true,
        'altFormat' => 'F j, Y',
        'altInputClass' => 'custom-class',
        'dateFormat' => 'Y-m-d',
        'ariaDateFormat' => 'Y/m/d',
        'conjunction' => ' y ',
        'shorthandCurrentMonth' => true,
        'weekNumbers' => true,
    ]);
});

it('sets valid monthSelectorType', function () {
    $component = Flatpickr::make('fecha')->monthSelectorType('dropdown');
    expect($component->getOptions())->toHaveKey('monthSelectorType', 'dropdown');
});

it('throws exception on invalid monthSelectorType', function () {
    Flatpickr::make('fecha')->monthSelectorType('invalid');
})->throws(InvalidArgumentException::class);

it('sets alt input class', function () {
    $component = Flatpickr::make('fecha')->altInputClass('custom-class');
    expect($component->getOptions())->toHaveKey('altInputClass', 'custom-class');
});

it('sets conjunction separator', function () {
    $component = Flatpickr::make('fecha')->conjunction(' y ');
    expect($component->getOptions())->toHaveKey('conjunction', ' y ');
});

it('sets aria date format', function () {
    $component = Flatpickr::make('fecha')->ariaDateFormat('Y-m-d');
    expect($component->getOptions())->toHaveKey('ariaDateFormat', 'Y-m-d');
});

it('sets shorthand current month', function () {
    $component = Flatpickr::make('fecha')->shorthandCurrentMonth();
    expect($component->getOptions())->toHaveKey('shorthandCurrentMonth', true);
});

it('enables week numbers', function () {
    $component = Flatpickr::make('fecha')->weekNumbers();
    expect($component->getOptions())->toHaveKey('weekNumbers', true);
});

it('sets a valid month selector type', function () {
    $component = Flatpickr::make('fecha')->monthSelectorType('dropdown');
    expect($component->getOptions())->toHaveKey('monthSelectorType', 'dropdown');
});

it('throws exception on invalid month selector type', function () {
    Flatpickr::make('fecha')->monthSelectorType('invalid-type');
})->throws(InvalidArgumentException::class);

it('sets altInputClass via trait', function () {
    $component = new DummyLocalizationComponent();
    $component->altInputClass('from-trait');

    expect($component->options)->toHaveKey('altInputClass', 'from-trait');
});

it('sets conjunction via trait', function () {
    $component = new DummyLocalizationComponent();
    $component->conjunction(' y ');

    expect($component->options)->toHaveKey('conjunction', ' y ');
});