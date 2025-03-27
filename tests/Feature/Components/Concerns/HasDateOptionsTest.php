<?php

use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;
use Tests\TestCase;

it('sets minDate correctly', function () {
    $component = Flatpickr::make('fecha')->minDate('2023-01-01');
    expect($component->getOptions()['minDate'])->toBe('2023-01-01');
});

it('sets maxDate correctly', function () {
    $component = Flatpickr::make('fecha')->maxDate('2023-12-31');
    expect($component->getOptions()['maxDate'])->toBe('2023-12-31');
});

it('sets defaultDate correctly', function () {
    $component = Flatpickr::make('fecha')->defaultDate('2023-06-15');
    expect($component->getOptions()['defaultDate'])->toBe('2023-06-15');
});