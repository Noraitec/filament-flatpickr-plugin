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

it('sets inline to true', function () {
    $component = Flatpickr::make('fecha')->inline();
    expect($component->getOptions())->toHaveKey('inline', true);
});

it('sets valid position', function () {
    $component = Flatpickr::make('fecha')->position('above');
    expect($component->getOptions())->toHaveKey('position', 'above');
});

it('throws exception on invalid position', function () {
    Flatpickr::make('fecha')->position('invalid-position');
})->throws(InvalidArgumentException::class);

it('sets positionElement', function () {
    $component = Flatpickr::make('fecha')->positionElement('#selector');
    expect($component->getOptions())->toHaveKey('positionElement', '#selector');
});

it('sets static to true', function () {
    $component = Flatpickr::make('fecha')->static();
    expect($component->getOptions())->toHaveKey('static', true);
});

it('sets wrap to true', function () {
    $component = Flatpickr::make('fecha')->wrap();
    expect($component->getOptions())->toHaveKey('wrap', true);
});

it('sets clickOpens to false', function () {
    $component = Flatpickr::make('fecha')->clickOpens(false);
    expect($component->getOptions())->toHaveKey('clickOpens', false);
});

it('sets allowInput to true', function () {
    $component = Flatpickr::make('fecha')->allowInput(true);
    expect($component->getOptions())->toHaveKey('allowInput', true);
});

it('sets nextArrow html', function () {
    $component = Flatpickr::make('fecha')->nextArrow('<span>Next</span>');
    expect($component->getOptions())->toHaveKey('nextArrow', '<span>Next</span>');
});

it('sets prevArrow html', function () {
    $component = Flatpickr::make('fecha')->prevArrow('<span>Prev</span>');
    expect($component->getOptions())->toHaveKey('prevArrow', '<span>Prev</span>');
});

it('sets showMonths count', function () {
    $component = Flatpickr::make('fecha')->showMonths(3);
    expect($component->getOptions())->toHaveKey('showMonths', 3);
});
