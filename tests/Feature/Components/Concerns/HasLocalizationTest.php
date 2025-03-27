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
 
 it('sets locale correctly', function () {
     $component = Flatpickr::make('fecha')->locale('es');
     expect($component->getLocale())->toBe('es');
 });
 
 it('enables altInput', function () {
     $component = Flatpickr::make('fecha')->altInput(true);
     expect($component->getOptions()['altInput'])->toBeTrue();
 });
 
 it('sets altFormat correctly', function () {
     $component = Flatpickr::make('fecha')->altFormat('F j, Y');
     expect($component->getOptions()['altFormat'])->toBe('F j, Y');
 });