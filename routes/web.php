<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Customers\ClientController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Payments\PaymentConfirmationController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Institutions\BankController;
use App\Http\Controllers\Institutions\InstallmentCompanyController;
use App\Http\Controllers\Institutions\GovernorateController;
use App\Http\Controllers\Institutions\LoanTypeController;
use App\Http\Controllers\Loans\DebtCaseController;
use App\Http\Controllers\Loans\PortfolioController;
use App\Http\Controllers\Loans\PortfolioImportController;
use App\Http\Controllers\Loans\DebtCaseAssignmentController;
use App\Http\Controllers\Collections\PromiseToPayController;
use App\Http\Controllers\Collections\VisitController;
use App\Http\Controllers\Collections\ComplaintController;
use App\Http\Controllers\Collections\ComplaintResolutionController;
use App\Http\Controllers\Reports\ReportController;
use App\Http\Controllers\Reports\ReportExportController;
use App\Http\Controllers\Reports\DailyCollectionReportController;
use App\Http\Controllers\Reports\DailyCollectionReportStatusController;
use App\Http\Controllers\Reports\MonthlyArchiveController;
use App\Http\Controllers\Employees\UserController;
use App\Http\Controllers\Employees\RoleController;
use App\Http\Controllers\Employees\PermissionController;
use App\Http\Controllers\Employees\UserBankController;
use App\Http\Controllers\Employees\UserInstallmentCompanyController;
use App\Http\Controllers\Employees\UserSupervisorController;
use App\Http\Controllers\Employees\UserRoleController;
use App\Http\Controllers\Employees\UserPermissionController;
use App\Http\Controllers\Employees\RolePermissionController;
use App\Http\Controllers\Institutions\BankWorkspaceController;
use App\Http\Controllers\Notifications\NotificationController;
use App\Http\Controllers\Notifications\NotificationReadAllController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public and authentication routes
|--------------------------------------------------------------------------
*/
Route::get('/', static fn () => auth()->check()
    ? redirect()->route('dashboard')
    : redirect()->route('login'));

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.update');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated application
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->group(function (): void {
    /* Dashboard and home */
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::view('/overview', 'overview.index')->name('overview.index');
    Route::view('/operations', 'operations.index')->name('operations.index');
    Route::view('/account', 'account.edit')->name('account.edit');

    /* Customers */
    Route::resource('clients', ClientController::class);
    Route::post('/clients/{client}/restore', [ClientController::class, 'restore'])
        ->name('clients.restore');

    /* Payments: static routes must be registered before /payments/{payment}. */
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/confirmations', [PaymentController::class, 'confirmations'])
        ->name('payments.confirmations');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::post('/payments/{payment}/confirm', [PaymentConfirmationController::class, 'confirm'])
        ->name('payments.confirm');
    Route::post('/payments/{payment}/reject', [PaymentConfirmationController::class, 'reject'])
        ->name('payments.reject');

    /* Loans and cases */
    Route::view('/loans', 'loans.index')->name('loans.index');
    Route::view('/loans/create', 'loans.create')->name('loans.create');
    Route::post('/loans', [DebtCaseController::class, 'store'])->name('loans.store');
    Route::view('/loans/{debtCase}', 'loans.show')->whereNumber('debtCase')->name('loans.show');
    Route::view('/loans/{debtCase}/edit', 'loans.edit')->whereNumber('debtCase')->name('loans.edit');
    Route::put('/loans/{debtCase}', [DebtCaseController::class, 'update'])->whereNumber('debtCase')->name('loans.update');
    Route::delete('/loans/{debtCase}', [DebtCaseController::class, 'destroy'])->whereNumber('debtCase')->name('loans.destroy');
    Route::post('/loans/{debtCase}/restore', [DebtCaseController::class, 'restore'])->whereNumber('debtCase')->name('loans.restore');

    Route::view('/portfolios', 'banks.distribution.index')->name('portfolios.index');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::post('/portfolios/{portfolio}/activate', [PortfolioController::class, 'activate'])->name('portfolios.activate');
    Route::post('/portfolios/{portfolio}/archive', [PortfolioController::class, 'archive'])->name('portfolios.archive');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    Route::post('/portfolios/{portfolio}/restore', [PortfolioController::class, 'restore'])->name('portfolios.restore');
    Route::get('/portfolios/{portfolio}/import', static fn ($portfolio) => view('banks.scope.import', compact('portfolio')))
        ->whereNumber('portfolio')->name('portfolios.import.create');
    Route::post('/portfolios/{portfolio}/import', [PortfolioImportController::class, 'store'])
        ->whereNumber('portfolio')->name('portfolios.import.store');

    Route::post('/loans/{debtCase}/assignments', [DebtCaseAssignmentController::class, 'store'])
        ->whereNumber('debtCase')->name('loans.assignments.store');
    Route::delete('/loans/{debtCase}/assignments/{assignment}', [DebtCaseAssignmentController::class, 'destroy'])
        ->whereNumber(['debtCase', 'assignment'])->name('loans.assignments.destroy');

    /* Promise to pay */
    Route::view('/ptp', 'ptp.index')->name('ptp.index');
    Route::view('/ptp/create', 'ptp.create')->name('ptp.create');
    Route::post('/ptp', [PromiseToPayController::class, 'store'])->name('ptp.store');
    Route::view('/ptp/{promise}', 'banks.ptp.show')->whereNumber('promise')->name('ptp.show');
    Route::view('/ptp/{promise}/edit', 'ptp.edit')->whereNumber('promise')->name('ptp.edit');
    Route::put('/ptp/{promise}', [PromiseToPayController::class, 'update'])->whereNumber('promise')->name('ptp.update');
    Route::delete('/ptp/{promise}', [PromiseToPayController::class, 'destroy'])->whereNumber('promise')->name('ptp.destroy');

    /* Field visits */
    Route::view('/visits', 'banks.visits.index')->name('visits.index');
    Route::view('/visits/create', 'banks.visits.create')->name('visits.create');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::view('/visits/{visit}/edit', 'banks.visits.edit')->whereNumber('visit')->name('visits.edit');
    Route::put('/visits/{visit}', [VisitController::class, 'update'])->whereNumber('visit')->name('visits.update');
    Route::delete('/visits/{visit}', [VisitController::class, 'destroy'])->whereNumber('visit')->name('visits.destroy');

    /* Complaints */
    Route::view('/complaints', 'banks.complaints.index')->name('complaints.index');
    Route::view('/complaints/create', 'banks.complaints.create')->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::view('/complaints/{complaint}', 'banks.complaints.show')->whereNumber('complaint')->name('complaints.show');
    Route::view('/complaints/{complaint}/edit', 'banks.complaints.edit')->whereNumber('complaint')->name('complaints.edit');
    Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->whereNumber('complaint')->name('complaints.update');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->whereNumber('complaint')->name('complaints.destroy');
    Route::post('/complaints/{complaint}/resolve', [ComplaintResolutionController::class, 'resolve'])->whereNumber('complaint')->name('complaints.resolve');
    Route::post('/complaints/{complaint}/reject', [ComplaintResolutionController::class, 'reject'])->whereNumber('complaint')->name('complaints.reject');

    /* Banks */

    Route::prefix('banks')
        ->name('banks.')
        ->group(function (): void {
            // Bank CRUD
            Route::get('/', [BankController::class, 'index'])->name('index');
            Route::get('/create', [BankController::class, 'create'])->name('create');
            Route::post('/', [BankController::class, 'store'])->name('store');

            // Static routes must be declared before dynamic routes.
            Route::get('/{bank}/panel', [BankController::class, 'panel'])
                ->whereNumber('bank')
                ->name('panel');

            Route::get('/{bank}/edit', [BankController::class, 'edit'])
                ->whereNumber('bank')
                ->name('edit');

            Route::put('/{bank}', [BankController::class, 'update'])
                ->whereNumber('bank')
                ->name('update');

            Route::delete('/{bank}', [BankController::class, 'destroy'])
                ->whereNumber('bank')
                ->name('destroy');

            Route::get('/{bank}', [BankController::class, 'show'])
                ->whereNumber('bank')
                ->name('show');

            // Bank clients
            Route::get('/{bank}/clients', [BankWorkspaceController::class, 'clients'])
                ->whereNumber('bank')
                ->name('clients.index');

            Route::get('/{bank}/clients/assign', [BankWorkspaceController::class, 'assignClients'])
                ->whereNumber('bank')
                ->name('clients.assign');

            Route::post('/{bank}/clients/assign', [BankWorkspaceController::class, 'storeClientAssignments'])
                ->whereNumber('bank')
                ->name('clients.assign.store');

            // Portfolio distribution
            Route::get('/{bank}/distribution', [BankWorkspaceController::class, 'distribution'])
                ->whereNumber('bank')
                ->name('distribution.index');

            Route::get('/{bank}/distribution/assign', [BankWorkspaceController::class, 'assignDistribution'])
                ->whereNumber('bank')
                ->name('distribution.assign');

            Route::post('/{bank}/distribution/assign', [BankWorkspaceController::class, 'storeDistribution'])
                ->whereNumber('bank')
                ->name('distribution.assign.store');

            // Portfolio scope
            Route::get('/{bank}/scope/import', [BankWorkspaceController::class, 'importScope'])
                ->whereNumber('bank')
                ->name('scope.import');

            Route::post('/{bank}/scope/import', [PortfolioController::class, 'store'])
                ->whereNumber('bank')
                ->name('scope.import.store');

            Route::get('/{bank}/scope/edit', [BankWorkspaceController::class, 'editScope'])
                ->whereNumber('bank')
                ->name('scope.edit');

            // Archives
            Route::get('/{bank}/archives', [BankWorkspaceController::class, 'archives'])
                ->whereNumber('bank')
                ->name('archives.index');

            Route::get('/{bank}/archives/{archive}', [BankWorkspaceController::class, 'archive'])
                ->whereNumber(['bank', 'archive'])
                ->name('archives.show');

            // Promises to pay (PTP)
            Route::get('/{bank}/ptp', [BankWorkspaceController::class, 'promises'])
                ->whereNumber('bank')
                ->name('ptp.index');

            Route::get('/{bank}/ptp/create', [BankWorkspaceController::class, 'createPromise'])
                ->whereNumber('bank')
                ->name('ptp.create');

            Route::post('/{bank}/ptp', [PromiseToPayController::class, 'store'])
                ->whereNumber('bank')
                ->name('ptp.store');

            Route::get('/{bank}/ptp/{promise}/edit', [BankWorkspaceController::class, 'editPromise'])
                ->whereNumber(['bank', 'promise'])
                ->name('ptp.edit');

            Route::put('/{bank}/ptp/{promise}', [PromiseToPayController::class, 'update'])
                ->whereNumber(['bank', 'promise'])
                ->name('ptp.update');

            // Visits
            Route::get('/{bank}/visits', [BankWorkspaceController::class, 'visits'])
                ->whereNumber('bank')
                ->name('visits.index');

            Route::get('/{bank}/visits/create', [BankWorkspaceController::class, 'createVisit'])
                ->whereNumber('bank')
                ->name('visits.create');

            Route::post('/{bank}/visits', [VisitController::class, 'store'])
                ->whereNumber('bank')
                ->name('visits.store');

            Route::get('/{bank}/visits/{visit}/edit', [BankWorkspaceController::class, 'editVisit'])
                ->whereNumber(['bank', 'visit'])
                ->name('visits.edit');

            Route::put('/{bank}/visits/{visit}', [VisitController::class, 'update'])
                ->whereNumber(['bank', 'visit'])
                ->name('visits.update');

            // Complaints
            Route::get('/{bank}/complaints', [BankWorkspaceController::class, 'complaints'])
                ->whereNumber('bank')
                ->name('complaints.index');

            Route::get('/{bank}/complaints/create', [BankWorkspaceController::class, 'createComplaint'])
                ->whereNumber('bank')
                ->name('complaints.create');

            Route::post('/{bank}/complaints', [ComplaintController::class, 'store'])
                ->whereNumber('bank')
                ->name('complaints.store');

            Route::get('/{bank}/complaints/{complaint}/edit', [BankWorkspaceController::class, 'editComplaint'])
                ->whereNumber(['bank', 'complaint'])
                ->name('complaints.edit');

            Route::put('/{bank}/complaints/{complaint}', [ComplaintController::class, 'update'])
                ->whereNumber(['bank', 'complaint'])
                ->name('complaints.update');

            Route::get('/{bank}/complaints/{complaint}', [BankWorkspaceController::class, 'complaint'])
                ->whereNumber(['bank', 'complaint'])
                ->name('complaints.show');

            // Daily Collection Reports
            Route::get('/{bank}/dcr', [BankWorkspaceController::class, 'dcr'])
                ->whereNumber('bank')
                ->name('dcr.index');
        });

    /* Installment companies */
    Route::view('/installment-companies', 'installment-companies.index')->name('installment-companies.index');
    Route::view('/installment-companies/create', 'installment-companies.create')->name('installment-companies.create');
    Route::post('/installment-companies', [InstallmentCompanyController::class, 'store'])->name('installment-companies.store');
    Route::view('/installment-companies/{installmentCompany}', 'installment-companies.show')->whereNumber('installmentCompany')->name('installment-companies.show');
    Route::view('/installment-companies/{installmentCompany}/panel', 'installment-companies.panel')->whereNumber('installmentCompany')->name('installment-companies.panel');
    Route::view('/installment-companies/{installmentCompany}/edit', 'installment-companies.edit')->whereNumber('installmentCompany')->name('installment-companies.edit');
    Route::put('/installment-companies/{installmentCompany}', [InstallmentCompanyController::class, 'update'])->whereNumber('installmentCompany')->name('installment-companies.update');
    Route::delete('/installment-companies/{installmentCompany}', [InstallmentCompanyController::class, 'destroy'])->whereNumber('installmentCompany')->name('installment-companies.destroy');

    /* Employees and users */
    Route::view('/employees', 'employees.index')->name('employees.index');
    Route::view('/employees/{employee}', 'employees.show')->whereNumber('employee')->name('employees.show');
    Route::view('/users', 'users.index')->name('users.index');
    Route::view('/users/create', 'users.create')->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::view('/users/{user}', 'users.show')->whereNumber('user')->name('users.show');
    Route::view('/users/{user}/edit', 'users.edit')->whereNumber('user')->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->whereNumber('user')->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->whereNumber('user')->name('users.destroy');
    Route::view('/users/{user}/team', 'users.team')->whereNumber('user')->name('users.team');
    Route::view('/users/{user}/assignments', 'users.assignments')->whereNumber('user')->name('users.assignments');
    Route::view('/users/{user}/permissions', 'users.permissions')->whereNumber('user')->name('users.permissions');
    Route::post('/users/{user}/banks', [UserBankController::class, 'assign'])->whereNumber('user')->name('users.banks.assign');
    Route::post('/users/{user}/installment-companies', [UserInstallmentCompanyController::class, 'assign'])->whereNumber('user')->name('users.installment-companies.assign');
    Route::post('/users/{user}/supervisor', [UserSupervisorController::class, 'assign'])->whereNumber('user')->name('users.supervisor.assign');
    Route::post('/users/{user}/role', [UserRoleController::class, 'assign'])->whereNumber('user')->name('users.role.assign');
    Route::put('/users/{user}/permissions', [UserPermissionController::class, 'update'])->whereNumber('user')->name('users.permissions.update');

    /* Roles and permissions */
    Route::view('/roles', 'roles.index')->name('roles.index');
    Route::view('/roles/create', 'roles.create')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::view('/roles/{role}/edit', 'roles.edit')->whereNumber('role')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->whereNumber('role')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->whereNumber('role')->name('roles.destroy');
    Route::put('/roles/{role}/permissions', [RolePermissionController::class, 'assign'])->whereNumber('role')->name('roles.permissions.assign');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->whereNumber('permission')->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->whereNumber('permission')->name('permissions.destroy');

    /* Reports and archives */
    Route::view('/reports', 'reports.index')->name('reports.index');
    Route::view('/reports/exports', 'reports.exports')->name('reports.exports');
    Route::view('/reports/{report}', 'reports.show')->whereNumber('report')->name('reports.show');
    Route::post('/reports/exports', [ReportExportController::class, 'store'])->name('reports.exports.store');
    Route::delete('/reports/exports/{export}', [ReportExportController::class, 'destroy'])->whereNumber('export')->name('reports.exports.destroy');
    Route::post('/daily-reports', [DailyCollectionReportController::class, 'store'])->name('daily-reports.store');
    Route::put('/daily-reports/{dailyReport}', [DailyCollectionReportController::class, 'update'])->whereNumber('dailyReport')->name('daily-reports.update');
    Route::delete('/daily-reports/{dailyReport}', [DailyCollectionReportController::class, 'destroy'])->whereNumber('dailyReport')->name('daily-reports.destroy');
    Route::post('/daily-reports/{dailyReport}/approve', [DailyCollectionReportStatusController::class, 'approve'])->whereNumber('dailyReport')->name('daily-reports.approve');
    Route::post('/daily-reports/{dailyReport}/reject', [DailyCollectionReportStatusController::class, 'reject'])->whereNumber('dailyReport')->name('daily-reports.reject');
    Route::view('/archives', 'archives.index')->name('archives.index');
    Route::view('/archives/{archive}', 'archives.show')->whereNumber('archive')->name('archives.show');
    Route::post('/archives', [MonthlyArchiveController::class, 'store'])->name('archives.store');
    Route::put('/archives/{archive}', [MonthlyArchiveController::class, 'update'])->whereNumber('archive')->name('archives.update');

    /* Activity logs and notifications */
    Route::view('/activity-logs', 'activity-logs.index')->name('activity-logs.index');
    Route::view('/notifications', 'notifications.index')->name('notifications.index');
    Route::post('/notifications/read-all', NotificationReadAllController::class)->name('notifications.read-all');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    /* Lookup/settings pages */
    Route::view('/loan-types', 'loan-types.index')->name('loan-types.index');
    Route::view('/loan-types/create', 'loan-types.create')->name('loan-types.create');
    Route::post('/loan-types', [LoanTypeController::class, 'store'])->name('loan-types.store');
    Route::view('/loan-types/{loanType}/edit', 'loan-types.edit')->whereNumber('loanType')->name('loan-types.edit');
    Route::put('/loan-types/{loanType}', [LoanTypeController::class, 'update'])->whereNumber('loanType')->name('loan-types.update');
    Route::delete('/loan-types/{loanType}', [LoanTypeController::class, 'destroy'])->whereNumber('loanType')->name('loan-types.destroy');

    Route::view('/governorates', 'governorates.index')->name('governorates.index');
    Route::view('/governorates/create', 'governorates.create')->name('governorates.create');
    Route::post('/governorates', [GovernorateController::class, 'store'])->name('governorates.store');
    Route::view('/governorates/{governorate}/edit', 'governorates.edit')->whereNumber('governorate')->name('governorates.edit');
    Route::put('/governorates/{governorate}', [GovernorateController::class, 'update'])->whereNumber('governorate')->name('governorates.update');
    Route::delete('/governorates/{governorate}', [GovernorateController::class, 'destroy'])->whereNumber('governorate')->name('governorates.destroy');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
