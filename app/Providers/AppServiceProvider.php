<?php

namespace App\Providers;

use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
// use Illuminate\Contracts\Pagination\Paginator;
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
      Paginator::useBootstrapFive();

    //   Debugbar::enable();

      $topUsers= Cache::remember('topUsers',60*2,function(){
        return User::withCount('ideas')->orderBy('ideas_count','DESC')->limit(5)->get();
      });

      View::share('topUsers',$topUsers);
    }
}
