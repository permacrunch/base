<?php

namespace Permacrunch\Base;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Support\Facades\View;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'crud');
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../translations');

        $this->publishes([
            __DIR__ . '/../permacrunch.php' => config_path('permacrunch.php'),
        ], 'config');
    }

    public function register()
    {
    }
}
