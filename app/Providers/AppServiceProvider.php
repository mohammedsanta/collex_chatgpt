<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DomainServiceProvider::class);
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request): Limit {
            $key = strtolower((string) $request->input('email')).'|'.$request->ip();
            return Limit::perMinute(5)->by($key);
        });
        Model::preventLazyLoading(
            ! app()->isProduction()
        );

        Model::preventSilentlyDiscardingAttributes(
            ! app()->isProduction()
        );
    }
}