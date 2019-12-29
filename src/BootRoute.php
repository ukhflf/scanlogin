<?php

namespace Ukhflf\Scanlogin;

use Encore\Admin\Admin;

trait BootRoute
{
    /**
     * {@inheritdoc}
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('scanlogin', __CLASS__);
    }

    /**
     * Register routes for laravel-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            $router->get('scanlogin', 'Ukhflf\Scanlogin\ScanloginController@index')->name('scanlogin');
            $router->get('userinfo', 'Ukhflf\Scanlogin\ScanloginController@userInfo')->name('userinfo');
        });
    }

}
