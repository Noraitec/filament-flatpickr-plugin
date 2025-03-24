<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Noraitec\FilamentFlatpickrPlugin\FlatpickrPluginServiceProvider;
use Filament\Forms\FormsServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
           FlatpickrPluginServiceProvider::class,
            FormsServiceProvider::class,
            \Filament\FilamentServiceProvider::class,
            \Livewire\LivewireServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // Plugin views
        $app['view']->addNamespace(
            'filament-flatpickr-plugin',
            __DIR__ . '/../resources/views'
        );
    
        // Filament core views
        $app['view']->addNamespace(
            'filament',
            base_path('vendor/filament/filament/resources/views')
        );
    
        // Filament forms
        $app['view']->addNamespace(
            'filament-forms',
            base_path('vendor/filament/forms/resources/views')
        );
    
        // 🆕 Registrar componentes Blade (por si acaso)
        $app['view']->addNamespace(
            'filament-support',
            base_path('vendor/filament/support/resources/views')
        );
    
        // 🆕 Agregar la carpeta shared
        $app['view']->addNamespace(
            'filament::components',
            base_path('vendor/filament/support/resources/views/components')
        );
    
        // 🆕 Registrar rutas necesarias para los componentes blade compartidos
        $app['view']->addNamespace(
            'filament-forms::components',
            base_path('vendor/filament/forms/resources/views/components')
        );
    }
}