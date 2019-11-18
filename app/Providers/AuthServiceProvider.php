<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forTransientTokens();
        });

        Passport::tokensExpireIn(Carbon::now('Asia/Jakarta')->addMonth()); // token expire 3 jam untuk user biasa
        Passport::personalAccessTokensExpireIn(Carbon::now('Asia/Jakarta')->addMonth()); //token expire 12jam admin
        Passport::refreshTokensExpireIn(Carbon::now('Asia/Jakarta')->addYear());
    }
}
