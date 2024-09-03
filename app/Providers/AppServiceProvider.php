<?php

namespace App\Providers;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //        Gate::define('update-talk', function (User $user, Talk $talk) {
        //            return $user->is($talk->user);
        //        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        RateLimiter::for('public_api', function (Request $request) {
            return $request->user() ? Limit::perMinute(100)->by($request->user()->id) : Limit::perMinute(10)->by($request->ip());
        });
    }
}
