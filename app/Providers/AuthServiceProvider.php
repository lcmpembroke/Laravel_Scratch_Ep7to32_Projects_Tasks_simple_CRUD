<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Project' => 'App\Policies\ProjectPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

     // autoinject Laravel's gate class by adding it as a parameter...
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        // $gate->before(function($user){
        //     // return $user->isAdmin(); or user->role() == "admin"
        //     // for now, just hardcoding....so 
        //     return $user->id == 4; // thi is the id of admin in this for sake of tutorial!!
        // });

        Gate::before(function($user){
            // return $user->isAdmin(); or user->role() == "admin"
            // for now, just hardcoding....so 
            return $user->id == 4; // thi is the id of admin in this for sake of tutorial!!
        });


        // Gate::before(function($user){
        //     return $user->isAdmin();
        // });
    }
}
