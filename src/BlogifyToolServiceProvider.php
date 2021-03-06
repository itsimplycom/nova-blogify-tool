<?php

namespace Its\NovaBlogifyTool;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Its\NovaBlogifyTool\Bootstrap\Blogify;
use Its\NovaBlogifyTool\Http\Middleware\Authorize;

class BlogifyToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-blogify-tool');

        $this->app->booted(function () {
            $this->routes();

            Blogify::injectToolResources();
        });

        $this->publishes([
            $this->configPath() => config_path('nova-blogify.php'),
        ], 'nova-blogify-config');

	    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the tool's routes.
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-blogify-tool')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'nova-blogify');
    }

    /**
     * @return string
     */
    protected function configPath()
    {
        return __DIR__.'/../config/nova-blogify.php';
    }
}
