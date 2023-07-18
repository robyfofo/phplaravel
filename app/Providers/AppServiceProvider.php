<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


use App\Models\Module;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {

        // preleva tutti i moduli
         $this->app->singleton('allModules', function () {
            $allmodules = Module::all()->sortBy("ordering");
            View::share('allModules', $allmodules);
            return $allmodules;
        });  
    
        // preleva tutti i moduli attivi
         $this->app->singleton('allModulesActive', function () {
            $allmodulesactive = Module::all()->sortBy("ordering")->where('active','=',1);
            View::share('allModulesActive', $allmodulesactive);
            return $allmodulesactive;
        });  

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
