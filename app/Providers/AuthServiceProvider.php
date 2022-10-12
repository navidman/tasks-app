<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });

        Passport::tokensExpireIn(now()->addDays(env('TOKEN_LIFETIME', 2)));
        Passport::refreshTokensExpireIn(now()->addDays(env('REFRESH_TOKEN_LIFETIME', 90)));

        Gate::define('admin', function ($user) {
            if ($user->role == 'Admin') {
                return true;
            }
            return abort(Response::HTTP_UNAUTHORIZED);
        });
    }
}
