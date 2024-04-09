<?php

namespace Seeme\Components\Providers;

use Illuminate\Support\Facades\Blade;
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
        $this->publishes([
            self::CONFIG_PATH => $this->app->configPath('sm-components.php'),
        ], 'config');

        $this->loadViewsFrom(self::VIEWS_PATH, self::NAMESPACE);
        Blade::componentNamespace('Seeme\\Components\\View\\Components', self::NAMESPACE);
    }
}
