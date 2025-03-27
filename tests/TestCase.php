<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Filament\Forms\FormsServiceProvider;
use Livewire\LivewireServiceProvider;
use Filament\FilamentServiceProvider;
use Noraitec\FilamentFlatpickrPlugin\Providers\FlatpickrPluginServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            FlatpickrPluginServiceProvider::class,
            FormsServiceProvider::class,
            FilamentServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['view']->addNamespace('filament-flatpickr-plugin', __DIR__ . '/../resources/views');
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('filament-flatpickr', [
            'plugins' => [],
        ]);
    }
}
