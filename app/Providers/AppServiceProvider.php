<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// de error ... key was too long ... kan je hier fixen met schema in te laden en defaultstringlength te zetten
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
