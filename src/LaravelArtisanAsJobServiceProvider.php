<?php

namespace parzival42codes\LaravelArtisanAsJob;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelArtisanAsJobServiceProvider extends PackageServiceProvider
{
    public const PACKAGE_NAME = 'laravel-artisan-as-job';

    public const PACKAGE_NAME_SHORT = 'laravel-artisan-as-job';

    public function configurePackage(Package $package): void
    {
        $package->name(self::PACKAGE_NAME)->hasRoute('route')->hasViews();
    }

    public function registeringPackage(): void
    {
    }
}
