<?php

declare(strict_types=1);

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch): void {
            $switch
                ->circular()
                ->flags([
                    'pl' => asset('flags/1x1/pl.svg'),
                    'en' => asset('flags/1x1/gb.svg'),
                ])
                ->locales(['pl', 'en']);
        });
    }
}
