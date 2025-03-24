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
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;

uses(TestCase::class);


class FakeLivewireComponent implements HasForms
{
    use \Filament\Forms\Concerns\InteractsWithForms;
}

it('uses the correct view (via reflection)', function () {
    $component = Flatpickr::make('testDate');

    $reflection = new ReflectionClass($component);
    $property = $reflection->getProperty('view');
    $property->setAccessible(true);

    expect($property->getValue($component))->toBe('filament-flatpickr-plugin::components.flatpickr');
});

it('sets enableTime to true in options', function () {
    $component = Flatpickr::make('field')->enableTime();

    expect($component->getOptions())->toHaveKey('enableTime', true);
});
it('generates correct flatpickr options', function () {
    $component = Flatpickr::make('fecha')->enableTime()->inline()->altFormat('F j, Y');
    $options = $component->getOptions();

    expect($options)->toMatchArray([
        'enableTime' => true,
        'inline' => true,
        'altFormat' => 'F j, Y',
    ]);
});

it('sets and gets locale correctly', function () {
    $component = Flatpickr::make('fecha')->locale('fr');
    
    expect($component->getLocale())->toBe('fr');
});

it('sets a valid mode', function () {
    $component = Flatpickr::make('fecha')->mode('range');
    
    expect($component->getOptions())->toHaveKey('mode', 'range');
});

it('throws an exception on invalid mode', function () {
    Flatpickr::make('fecha')->mode('invalid-mode');
})->throws(InvalidArgumentException::class);

it('sets JavaScript callbacks correctly', function () {
    $component = Flatpickr::make('fecha')
        ->onChange('function() { console.log("change"); }')
        ->onOpen('function() { console.log("open"); }');

    $options = $component->getOptions();

    expect($options)->toHaveKey('onChange');
    expect($options['onChange'])->toBeArray()->toContain('function() { console.log("change"); }');
    expect($options)->toHaveKey('onOpen');
});

it('accepts multiple configuration options at once', function () {
    $component = Flatpickr::make('fecha')
        ->enableTime()
        ->enableSeconds()
        ->time24hr()
        ->altInput()
        ->dateFormat('Y-m-d');

    $options = $component->getOptions();

    expect($options)->toMatchArray([
        'enableTime' => true,
        'enableSeconds' => true,
        'time_24hr' => true,
        'altInput' => true,
        'dateFormat' => 'Y-m-d',
    ]);
});

it('stores plugins correctly', function () {
    $component = Flatpickr::make('fecha');

    $component->withPlugins([
        'rangePlugin' => ['input' => '#secondInput'],
    ]);

    expect($component->getPlugins())->toMatchArray([
        'rangePlugin' => ['input' => '#secondInput'],
    ]);
});

it('can set and get options manually', function () {
    $component = Flatpickr::make('fecha')->options([
        'enableTime' => true,
        'inline' => false,
    ]);

    expect($component->getOptions())->toMatchArray([
        'enableTime' => true,
        'inline' => false,
    ]);
});

it('sets locale in Flatpickr class directly', function () {
    $component = Flatpickr::make('fecha')->locale('it');

    expect($component->getLocale())->toBe('it');
});

it('sets disableMobile option to true', function () {
    $component = Flatpickr::make('fecha')->disableMobile();

    expect($component->getOptions())->toHaveKey('disableMobile', true);
});

it('sets disableMobile option to false', function () {
    $component = Flatpickr::make('fecha')->disableMobile(false);

    expect($component->getOptions())->toHaveKey('disableMobile', false);
});

