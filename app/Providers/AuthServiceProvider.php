<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Collections\Models\CaseAssignment;
use App\Domain\Collections\Models\CaseInteraction;
use App\Domain\Collections\Models\Complaint;
use App\Domain\Collections\Models\Visit;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Models\ClientPhone;
use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Institutions\Models\Governorate;
use App\Domain\Institutions\Models\InstallmentCompany;
use App\Domain\Institutions\Models\LoanType;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\Portfolio;
use App\Domain\Loans\Models\PortfolioImport;
use App\Domain\Payments\Models\Payment;
use App\Domain\Notifications\Models\Notification;
use App\Domain\Reports\Models\ActivityLog;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Domain\Reports\Models\MonthlyArchive;
use App\Domain\Reports\Models\PerformanceSnapshot;
use App\Domain\Reports\Models\ReportExport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Client::class => \App\Domain\Customers\Policies\ClientPolicy::class,
        ClientPhone::class => \App\Domain\Customers\Policies\ClientPhonePolicy::class,
        Portfolio::class => \App\Domain\Loans\Policies\PortfolioPolicy::class,
        DebtCase::class => \App\Domain\Loans\Policies\DebtCasePolicy::class,
        PortfolioImport::class => \App\Domain\Loans\Policies\PortfolioImportPolicy::class,
        Payment::class => \App\Domain\Payments\Policies\PaymentPolicy::class,
        Notification::class => \App\Domain\Notifications\Policies\NotificationPolicy::class,
        PromiseToPay::class => \App\Domain\Collections\Policies\PromiseToPayPolicy::class,
        CaseInteraction::class => \App\Domain\Collections\Policies\CaseInteractionPolicy::class,
        Visit::class => \App\Domain\Collections\Policies\VisitPolicy::class,
        Complaint::class => \App\Domain\Collections\Policies\ComplaintPolicy::class,
        User::class => \App\Domain\Employees\Policies\UserPolicy::class,
        Role::class => \App\Domain\Employees\Policies\RolePolicy::class,
        Permission::class => \App\Domain\Employees\Policies\PermissionPolicy::class,
        Bank::class => \App\Domain\Institutions\Policies\BankPolicy::class,
        InstallmentCompany::class => \App\Domain\Institutions\Policies\InstallmentCompanyPolicy::class,
        Governorate::class => \App\Domain\Institutions\Policies\GovernoratePolicy::class,
        LoanType::class => \App\Domain\Institutions\Policies\LoanTypePolicy::class,
        DailyCollectionReport::class => \App\Domain\Reports\Policies\DailyCollectionReportPolicy::class,
        PerformanceSnapshot::class => \App\Domain\Reports\Policies\PerformanceSnapshotPolicy::class,
        MonthlyArchive::class => \App\Domain\Reports\Policies\MonthlyArchivePolicy::class,
        ReportExport::class => \App\Domain\Reports\Policies\ReportExportPolicy::class,
        ActivityLog::class => \App\Domain\Reports\Policies\ActivityLogPolicy::class,
        CaseAssignment::class => \App\Domain\Collections\Policies\CaseAssignmentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function (User $user): ?bool {
            return $user->is_system_account ? true : null;
        });
    }
}