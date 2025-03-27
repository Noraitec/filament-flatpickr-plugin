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

it('sets inline mode', function () {
    $component = Flatpickr::make('fecha')->inline(true);
    expect($component->getOptions()['inline'])->toBeTrue();
});

it('enables week numbers', function () {
    $component = Flatpickr::make('fecha')->weekNumbers(true);
    expect($component->getOptions()['weekNumbers'])->toBeTrue();
});

it('sets showMonths correctly', function () {
    $component = Flatpickr::make('fecha')->showMonths(2);
    expect($component->getOptions()['showMonths'])->toBe(2);
});

it('throws exception for invalid showMonths', function () {
    expect(fn () => Flatpickr::make('fecha')->showMonths(0))
        ->toThrow(\InvalidArgumentException::class, 'Number of months to show must be at least 1.');
});