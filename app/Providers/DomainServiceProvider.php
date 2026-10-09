<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Collections\Services\AssignmentService;
use App\Domain\Collections\Services\ComplaintReferenceGenerator;
use App\Domain\Collections\Services\PromiseToPayEvaluationService;
use App\Domain\Customers\Services\ClientCodeGenerator;
use App\Domain\Employees\Services\UserPermissionService;
use App\Domain\Loans\Services\DebtCaseBalanceService;
use App\Domain\Payments\Services\PaymentReceiptNumberGenerator;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClientCodeGenerator::class);
        $this->app->singleton(PaymentReceiptNumberGenerator::class);
        $this->app->singleton(ComplaintReferenceGenerator::class);

        $this->app->singleton(DebtCaseBalanceService::class);
        $this->app->singleton(PromiseToPayEvaluationService::class);
        $this->app->singleton(AssignmentService::class);
        $this->app->singleton(UserPermissionService::class);
    }

    public function boot(): void
    {
    }
}