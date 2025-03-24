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

it('enables time selection', function () {
    $component = Flatpickr::make('fecha')->enableTime();
    expect($component->getOptions())->toHaveKey('enableTime', true);
});

it('enables seconds selection', function () {
    $component = Flatpickr::make('fecha')->enableSeconds();
    expect($component->getOptions())->toHaveKey('enableSeconds', true);
});

it('sets time to 24hr format', function () {
    $component = Flatpickr::make('fecha')->time24hr();
    expect($component->getOptions())->toHaveKey('time_24hr', true);
});

it('sets default hour', function () {
    $component = Flatpickr::make('fecha')->defaultHour(10);
    expect($component->getOptions())->toHaveKey('defaultHour', 10);
});

it('sets default minute', function () {
    $component = Flatpickr::make('fecha')->defaultMinute(30);
    expect($component->getOptions())->toHaveKey('defaultMinute', 30);
});

it('sets default seconds', function () {
    $component = Flatpickr::make('fecha')->defaultSeconds(45);
    expect($component->getOptions())->toHaveKey('defaultSeconds', 45);
});

it('sets hour increment', function () {
    $component = Flatpickr::make('fecha')->hourIncrement(2);
    expect($component->getOptions())->toHaveKey('hourIncrement', 2);
});

it('sets minute increment', function () {
    $component = Flatpickr::make('fecha')->minuteIncrement(5);
    expect($component->getOptions())->toHaveKey('minuteIncrement', 5);
});
