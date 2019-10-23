<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Cost;
use App\Income;


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
        $cost = Cost::sum('amount');
        $income = Income::sum('amount');
        $left = $income - $cost;
        view()->share('left', $left);
        
    }
}
