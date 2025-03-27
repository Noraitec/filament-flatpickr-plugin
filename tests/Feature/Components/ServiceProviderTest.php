<?php

use Tests\TestCase;
use Noraitec\FilamentFlatpickrPlugin\Providers\FlatpickrPluginServiceProvider;

uses(TestCase::class);

it('registers the flatpickr plugin service provider', function () {
    expect(app()->getProvider(FlatpickrPluginServiceProvider::class))->not()->toBeNull();
});