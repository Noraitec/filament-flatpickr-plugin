<?php

namespace Noraitec\FilamentFlatpickrPlugin;

use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Spatie\LaravelPackageTools\Package;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class FlatpickrPluginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
    ->name('filament-flatpickr-plugin')
    ->hasConfigFile()
    ->hasViews()
    ->hasAssets()
    ->hasInstallCommand(function (InstallCommand $command) {
        $command
            ->publishConfigFile()
            ->publishAssets()
            ->askToStarRepoOnGitHub('noraitec/filament-flatpickr-plugin');
    });
    }

    public function bootingPackage()
    {
        FilamentAsset::register([
            Css::make('flatpickr', asset('vendor/filament-flatpickr/flatpickr.min.css')),
            Js::make('flatpickr', asset('vendor/filament-flatpickr/flatpickr.min.js')),

            Js::make('flatpickr-es', asset('vendor/filament-flatpickr/l10n/es.js')),
            Js::make('flatpickr-fr', asset('vendor/filament-flatpickr/l10n/fr.js')),
            Js::make('flatpickr-pt', asset('vendor/filament-flatpickr/l10n/pt.js')),
        ]);
    }
}