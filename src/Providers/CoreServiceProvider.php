<?php

namespace Seeme\Components\Providers;

use Seeme\Components\Services\BlocksService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../../config/sm-components.php';
    const VIEWS_PATH = __DIR__ . '/../../resources/views';
    const NAMESPACE = 'seeme';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'sm-components');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->handlePublishes();
        $this->handleViews();
        $this->handleBlocks();
        $this->handleComposers();
    }

    /**
     * Registers paths to be published by publish command
     * 
     * @return void
     */
    public function handlePublishes(): void
    {
        $this->publishes([
            self::CONFIG_PATH => $this->app->configPath('sm-components.php'),
        ], 'config');

        $this->publishes([
            self::VIEWS_PATH => $this->app->resourcePath('views/vendor/sm-components')
        ], 'views');
    }

    /**
     * Register views and components namespace
     * 
     * @return void
     */
    public function handleViews(): void
    {
        $this->loadViewsFrom(self::VIEWS_PATH, self::NAMESPACE);
        Blade::componentNamespace('Seeme\\Components\\View\\Components', self::NAMESPACE);
    }

    /**
     * Create and initialize Seeme\Components\BlocksService
     * 
     * @return void
     */
    public function handleBlocks(): void
    {
        $this->app->make(BlocksService::class)->init();
    }

    public function handleComposers(): void
    {
        $composers = glob(__DIR__ . '/../View/Composers/*.php');

        foreach($composers as $composer) {
            $class = 'Seeme\\Components\\View\\Composers\\' . basename($composer, '.php');
            View::composer($class::views(), $class);
        }
    }
}
