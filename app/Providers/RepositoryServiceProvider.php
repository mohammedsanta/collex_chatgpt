<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositories are intentionally not used.
        // Eloquent models and domain queries provide the data-access abstraction.
    }

    public function boot(): void
    {
    }
}