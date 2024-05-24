<?php

namespace App\Providers;

use App\View\Components\layouts\admin;
use App\View\Components\layouts\general;
use App\View\Components\layouts\user;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::component('layouts.admin', admin::class);
        Blade::component('layouts.user', user::class);
        Blade::component('layouts.general', general::class);
    }
}
