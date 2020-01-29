<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

        // NOTES: Gate is to do with authorization (permissions) rather than authentication (user logged in)
        //      : returning FALSE from this Gate check would stop all further authorization checks e.g. policies which we don't want...
        Gate::before(function($user) {            
            // hardcoding a "super admin" user to have the word "test" in their email so they don't go through the other checks in the Project Policy!
            if (strpos($user->email,"test") !== false    ) {
                return true;
            }
        });

    }
}
