<?php
namespace Noraitec\FilamentFlatpickrPlugin\Providers;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlatpickrPluginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-flatpickr')
            ->hasConfigFile('filament-flatpickr')
            ->hasViews('filament-flatpickr-plugin');
    }
}