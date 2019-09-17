<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\SoftwareSetting;
use App\Models\User;

use App\Observers\MenuItemObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //    User::observe(UserObserver::class);
        MenuItem::observe(MenuItemObserver::class);
        $print_bill=$print_kot=1;
        $print_bill=SoftwareSetting::where('slug','print-bill')->first()->value==1?true:false;
        $print_kot=SoftwareSetting::where('slug','print-kot')->first()->value==1?true:false;

        View::share('print_bill', $print_bill);
        View::share('print_kot', $print_kot);
    }
}
