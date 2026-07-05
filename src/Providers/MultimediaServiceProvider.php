<?php

declare(strict_types=1);

namespace Misaf\VendraMultimedia\Providers;

use Filament\Panel;
use Illuminate\Foundation\Console\AboutCommand;
use Misaf\VendraMultimedia\MultimediaPlugin;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class MultimediaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vendra-multimedia')
            ->hasTranslations()
            ->hasMigrations([
                'add_tenant_id_column_to_media_table',
            ])
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->askToStarRepoOnGitHub('misaf/vendra-multimedia');
            });
    }

    public function packageRegistered(): void
    {
        Panel::configureUsing(function (Panel $panel): void {
            if ('admin' !== $panel->getId()) {
                return;
            }

            $panel->plugin(MultimediaPlugin::make());
        });
    }

    public function packageBooted(): void
    {
        AboutCommand::add('Vendra Multimedia', fn() => ['Version' => 'dev-master']);
    }
}
