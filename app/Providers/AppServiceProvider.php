<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\Entities\User;
use Laravel\Cashier\Cashier;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        if(str_contains('admin',request()->getpathInfo()))
        Paginator::useBootstrap();
        else
        Paginator::useTailwind();
        }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

/**
 * Bootstrap any application services.
 */
public function boot(): void
{
    Cashier::useCustomerModel(User::class);
}


}
