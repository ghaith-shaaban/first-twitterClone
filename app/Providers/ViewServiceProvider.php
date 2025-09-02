<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $topUsers = Cache::remember('topUsers', 60*2, function () {
                return User::withCount('ideas')
                    ->orderByDesc('ideas_count')
                    ->limit(5)
                    ->get();
            });

            $view->with('topUsers', $topUsers);
        });

    }
}
