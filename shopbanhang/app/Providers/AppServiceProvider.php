<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Carbon;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            Carbon::macro('setLastErrors', function ($lastErrors = null) {
                return Carbon::getLastErrors();
            });
        }
    }
   
}
?>