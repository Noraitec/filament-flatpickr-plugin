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

uses(TestCase::class);

it('sets inline mode', function () {
    $component = Flatpickr::make('fecha')->inline(true);
    expect($component->getOptions()['inline'])->toBeTrue();
});

it('enables week numbers', function () {
    $component = Flatpickr::make('fecha')->weekNumbers(true);
    expect($component->getOptions()['weekNumbers'])->toBeTrue();
});

it('sets showMonths correctly', function () {
    $component = Flatpickr::make('fecha');
    // Aseguramos que entramos al método showMonths
    expect(true)->toBeTrue();
    $component->showMonths(2);
    expect($component->getOptions()['showMonths'])->toBe(2);
});
it('does not throw exception for valid showMonths', function () {
    $component = Flatpickr::make('fecha');
    // Esto debería ejecutarse sin lanzar una excepción
    $component->showMonths(1);
    // Puedes añadir más aserciones si lo deseas, por ejemplo:
    expect($component->getOptions()['showMonths'])->toBe(1);
});

it('throws exception for invalid showMonths', function () {
    try {
        Flatpickr::make('fecha')->showMonths(0);
        // Si no lanza excepción, forzamos fallo
        expect()->fail('Expected InvalidArgumentException was not thrown.');
    } catch (\InvalidArgumentException $e) {
        expect($e->getMessage())->toBe('Number of months to show must be at least 1.');
    }
});
it('calls showMonths with a valid value before testing the exception', function () {
    $component = Flatpickr::make('fecha');
    $component->showMonths(1);
    expect($component->getOptions()['showMonths'])->toBe(1);
});

it('returns the component instance from showMonths', function () {
    $component = Flatpickr::make('fecha');
    $result = $component->showMonths(2);
    
    expect($result)->toBe($component);
});
