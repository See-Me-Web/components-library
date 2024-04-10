<?php

namespace Seeme\Components\Providers;

use Seeme\Components\Services\BlocksService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Log1x\AcfComposer\AcfComposer;

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
        $this->publishes([
            self::CONFIG_PATH => $this->app->configPath('sm-components.php'),
            self::VIEWS_PATH => $this->app->resourcePath('views/vendor/sm-components')
        ], 'config');

        $this->loadViewsFrom(self::VIEWS_PATH, self::NAMESPACE);
        Blade::componentNamespace('Seeme\\Components\\View\\Components', self::NAMESPACE);

        $this->app->make(BlocksService::class)->registerActions();
        $this->app->make(AcfComposer::class);
    }
}
