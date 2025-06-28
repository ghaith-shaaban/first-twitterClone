<?php

namespace App\Providers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() : void
    {
        Gate::define('admin',function(User $user):bool{
            return $user['admin'];
        });

        // Gate::define('idea.delete',function(User $user,idea $idea):bool{
        //     return ($user['admin'] || $user['id'] == $idea['user_id']);
        // });

        // Gate::define('idea.edit',function(User $user,idea $idea):bool{
        //     return ($user['admin'] || $user['id'] == $idea['user_id']);
        // });

    }
}
