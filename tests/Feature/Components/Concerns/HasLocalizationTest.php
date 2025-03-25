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

it('sets locale via trait', function () {
    $component = Flatpickr::make('fecha')->locale('fr');
    expect($component->getLocale())->toBe('fr');
});

it('sets and gets locale correctly', function () {
    $component = Flatpickr::make('fecha')->locale('es');
    expect($component->getLocale())->toBe('es');
});

it('sets altInput correctly', function () {
    $component = Flatpickr::make('fecha')->altInput();
    expect($component->getOptions())->toHaveKey('altInput', true);
});

it('sets altFormat correctly', function () {
    $component = Flatpickr::make('fecha')->altFormat('F j, Y');
    expect($component->getOptions())->toHaveKey('altFormat', 'F j, Y');
});

it('sets altInputClass correctly', function () {
    $component = Flatpickr::make('fecha')->altInputClass('custom-class');
    expect($component->getOptions())->toHaveKey('altInputClass', 'custom-class');
});

it('sets dateFormat correctly', function () {
    $component = Flatpickr::make('fecha')->dateFormat('Y-m-d');
    expect($component->getOptions())->toHaveKey('dateFormat', 'Y-m-d');
});

it('sets ariaDateFormat correctly', function () {
    $component = Flatpickr::make('fecha')->ariaDateFormat('Y/m/d');
    expect($component->getOptions())->toHaveKey('ariaDateFormat', 'Y/m/d');
});

it('sets conjunction separator correctly', function () {
    $component = Flatpickr::make('fecha')->conjunctionFromLocalization(' y ');
    expect($component->getOptions())->toHaveKey('conjunction', ' y ');
});

it('sets shorthandCurrentMonth correctly', function () {
    $component = Flatpickr::make('fecha')->shorthandCurrentMonth();
    expect($component->getOptions())->toHaveKey('shorthandCurrentMonth', true);
});

it('enables weekNumbers correctly', function () {
    $component = Flatpickr::make('fecha')->weekNumbers();
    expect($component->getOptions())->toHaveKey('weekNumbers', true);
});

it('sets valid monthSelectorType', function () {
    $component = Flatpickr::make('fecha')->monthSelectorType('dropdown');
    expect($component->getOptions())->toHaveKey('monthSelectorType', 'dropdown');
});

it('throws exception on invalid monthSelectorType', function () {
    Flatpickr::make('fecha')->monthSelectorType('invalid');
})->throws(InvalidArgumentException::class);

it('sets firstDayOfWeek correctly', function () {
    $component = Flatpickr::make('fecha')->firstDayOfWeek(0); // Domingo
    expect($component->getOptions())->toHaveKey('firstDayOfWeek', 0);
});

it('throws exception on invalid firstDayOfWeek', function () {
    Flatpickr::make('fecha')->firstDayOfWeek(7); // Invalid
})->throws(InvalidArgumentException::class);

it('sets showMonths correctly', function () {
    $component = Flatpickr::make('fecha')->showMonths(2);
    expect($component->getOptions())->toHaveKey('showMonths', 2);
});

it('throws exception on invalid showMonths value', function () {
    Flatpickr::make('fecha')->showMonths(0); // Invalid
})->throws(InvalidArgumentException::class);
