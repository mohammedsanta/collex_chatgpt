<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/** Routes are registered by bootstrap/app.php in Laravel 12. */
final class RouteServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void {}
}
