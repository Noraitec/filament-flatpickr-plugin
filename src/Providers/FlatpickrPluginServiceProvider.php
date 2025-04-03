<?php
namespace Noraitec\FilamentFlatpickrPlugin\Providers;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class FlatpickrPluginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
        ->name('filament-flatpickr-plugin')
        ->hasConfigFile('filament-flatpickr')
        ->hasViews('filament-flatpickr-plugin')
        ->hasAssets()
        ->hasInstallCommand(function (InstallCommand $command) {
            $command
                ->publishConfigFile()
                ->publishAssets() 
                ->askToStarRepoOnGitHub('noraitec/filament-flatpickr-plugin');
                
        });
    }
}