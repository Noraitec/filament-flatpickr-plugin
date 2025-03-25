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

it('sets time correctly', function () {
    $component = Flatpickr::make('fecha')->setTime('10:30');
    expect($component->getOptions())->toHaveKey('time', '10:30');
});

it('sets time format correctly', function () {
    $component = Flatpickr::make('fecha')->setTimeFormat('H:i');
    expect($component->getOptions())->toHaveKey('timeFormat', 'H:i');
});

it('gets the correct time value', function () {
    $component = Flatpickr::make('fecha')->setTime('15:45');
    expect($component->getTime())->toBe('15:45');
});

it('throws exception on invalid time format', function () {
    Flatpickr::make('fecha')->setTimeFormat('invalid-format');
})->throws(InvalidArgumentException::class);

it('sets and gets 24-hour time format', function () {
    $component = Flatpickr::make('fecha')->setTimeFormat('H:i');
    expect($component->getOptions())->toHaveKey('timeFormat', 'H:i');
});

it('sets and gets 12-hour time format', function () {
    $component = Flatpickr::make('fecha')->setTimeFormat('h:i A');
    expect($component->getOptions())->toHaveKey('timeFormat', 'h:i A');
});
