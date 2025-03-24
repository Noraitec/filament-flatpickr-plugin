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

it('sets all JS callbacks correctly', function () {
    $component = Flatpickr::make('fecha')
        ->onChange('function() { console.log("change"); }')
        ->onOpen('function() { console.log("open"); }')
        ->onClose('function() { console.log("close"); }')
        ->onReady('function() { console.log("ready"); }')
        ->onMonthChange('function() { console.log("monthChange"); }')
        ->onYearChange('function() { console.log("yearChange"); }')
        ->onValueUpdate('function() { console.log("valueUpdate"); }')
        ->onDayCreate('function() { console.log("dayCreate"); }');

    $options = $component->getOptions();

    expect($options)->toMatchArray([
        'onChange'      => ['function() { console.log("change"); }'],
        'onOpen'        => ['function() { console.log("open"); }'],
        'onClose'       => ['function() { console.log("close"); }'],
        'onReady'       => ['function() { console.log("ready"); }'],
        'onMonthChange' => ['function() { console.log("monthChange"); }'],
        'onYearChange'  => ['function() { console.log("yearChange"); }'],
        'onValueUpdate' => ['function() { console.log("valueUpdate"); }'],
        'onDayCreate'   => ['function() { console.log("dayCreate"); }'],
    ]);
});
