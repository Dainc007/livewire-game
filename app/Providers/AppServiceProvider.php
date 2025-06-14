<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\LogService;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Carbon\CarbonImmutable;
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;
use Filament\Infolists\Components\Entry;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
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
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configureVite();
        $this->configureTranslationKeysLogging();
        $this->configureFilamentTranslations();
        $this->forceHttps();
        $this->configureFilamentPlugins();
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    /**
     * Configure the application's dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configure the application's models.
     */
    private function configureModels(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();
    }

    /**
     * Configure the application's Vite instance.
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    private function forceHttps(): void
    {
        URL::forceScheme('https');
    }

    private function configureFilamentPlugins(): void
    {
        $this->configureFilamentLanguageSwitcher();
    }

    private function configureFilamentLanguageSwitcher(): void
    {
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

    private function configureTranslationKeysLogging(): void
    {
        LogService::shouldLogMissingTranslationKeys(! $this->app->isProduction());
    }

    private function configureFilamentTranslations(): void
    {
        array_map(
            fn ($class) => $class::configureUsing(fn ($instance) => $instance->translateLabel()),
            [Column::class, Filter::class, Field::class, Entry::class, Action::class, Component::class]
        );
    }
}
