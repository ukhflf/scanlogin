<?php

namespace Ukhflf\Scanlogin;

use Illuminate\Support\ServiceProvider;

class ScanloginServiceProvider extends ServiceProvider
{
    use BootRoute;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('scanlogin', function ($app) {

            return new Packagetest($app['session'], $app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        ScanloginViewer::boot();
        $this->publishes([__DIR__ . '/../config/scanlogin.php' => config_path('scanlogin.php')], 'scanlogin');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'scanlogin');
        $this->publishes([__DIR__.'/../views' => base_path('resources/views/vendor/scanlogin')], 'scanlogin');
        $this->loadViewsFrom(__DIR__.'/../views', 'scanlogin');
//        $this->loadRoutesFrom(__DIR__.'/routes.php');
        //php artisan vendor:publish --provider="Ukhflf\Scanlogin\ScanloginServiceProvider"
    }

    /**
     *
     * Get the services provided by the provider.
     * @return array
     */

    public function provides()

    {
        return ['scanlogin'];
    }

}
