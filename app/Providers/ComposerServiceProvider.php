<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //dd('something2');
        View::composer(['admin.index', 'admin.uc.leftmenu', 'admin.uc.header'], 'App\Http\ViewComposers\LeftMenuComposer');
        //view()->composer(['admin.index', 'admin.uc.leftmenu', 'admin.uc.header'], 'App\Http\ViewComposers\LeftMenuComposer');
        //$this->app['view']->composer(['admin.index', 'admin.uc.leftmenu', 'admin.uc.header'], 'App\Http\ViewComposers\LeftMenuComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
