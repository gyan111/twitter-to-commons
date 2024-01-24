<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('path.public', function() {
        //     return base_path().DIRECTORY_SEPARATOR.'public_html';
        // });
        // $app->usePublicPath(__DIR__.'/../../public_html');
        $this->app->usePublicPath(__DIR__.'/../../public_html');
    }
}
