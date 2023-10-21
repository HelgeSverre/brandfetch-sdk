<?php

namespace HelgeSverre\Brandfetch;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BrandfetchServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('brandfetch-sdk')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('helgesverre/brandfetch-php');
            });
    }

    public function registeringPackage()
    {
        $this->app->bind(Brandfetch::class, fn ($app) => new Brandfetch(
            apiKey: config('brandfetch-sdk.api_key')
        ));
    }
}
