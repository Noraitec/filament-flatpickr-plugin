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

namespace Tests\Feature\Components;

use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;
use Tests\TestCase;
use InvalidArgumentException;

uses(TestCase::class);

it('sets and gets date correctly', function () {
    $component = Flatpickr::make('fecha')->setDate('2024-01-01');
    expect($component->getDate())->toBe('2024-01-01');
});

it('sets and gets minDate correctly', function () {
    $component = Flatpickr::make('fecha')->setMinDate('2024-01-01');
    expect($component->getOptions())->toHaveKey('minDate', '2024-01-01');
});

it('sets and gets maxDate correctly', function () {
    $component = Flatpickr::make('fecha')->setMaxDate('2024-12-31');
    expect($component->getOptions())->toHaveKey('maxDate', '2024-12-31');
});

it('opens and closes calendar correctly', function () {
    $component = Flatpickr::make('fecha');
    $component->open();
    expect($component->getOptions())->toHaveKey('open', true);
    
    $component->close();
    expect($component->getOptions())->toHaveKey('open', false);
});

it('sets valid month selector type', function () {
    $component = Flatpickr::make('fecha')->monthSelectorType('dropdown');
    expect($component->getOptions())->toHaveKey('monthSelectorType', 'dropdown');
});

it('throws exception on invalid month selector type', function () {
    Flatpickr::make('fecha')->monthSelectorType('invalid');
})->throws(InvalidArgumentException::class);

it('sets alt input class', function () {
    $component = Flatpickr::make('fecha')->altInputClass('custom-class');
    expect($component->getOptions())->toHaveKey('altInputClass', 'custom-class');
});

it('sets conjunction separator', function () {
    $component = Flatpickr::make('fecha')->conjunctionFromLocalization(' y ');
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

it('sets valid time options', function () {
    $component = Flatpickr::make('fecha')->setTime('10:30');
    expect($component->getOptions())->toHaveKey('time', '10:30');
});

it('sets valid date format', function () {
    $component = Flatpickr::make('fecha')->dateFormat('Y-m-d');
    expect($component->getOptions())->toHaveKey('dateFormat', 'Y-m-d');
});

it('sets valid locale', function () {
    $component = Flatpickr::make('fecha')->locale('es');
    expect($component->getLocale())->toBe('es');
});
