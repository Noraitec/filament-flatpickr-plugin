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
 
 it('enables time selection', function () {
     $component = Flatpickr::make('fecha')->enableTime(true);
     expect($component->getOptions()['enableTime'])->toBeTrue();
 });
 
 it('sets 24-hour time format', function () {
     $component = Flatpickr::make('fecha')->time24hr(true);
     expect($component->getOptions()['time_24hr'])->toBeTrue();
 });
 
 it('sets default hour', function () {
     $component = Flatpickr::make('fecha')->defaultHour(14);
     expect($component->getOptions()['defaultHour'])->toBe(14);
 });