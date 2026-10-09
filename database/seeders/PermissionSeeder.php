<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Employees\Models\Permission;
use Illuminate\Database\Seeder;

final class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'activity_logs.view','banks.view','banks.create','banks.update','banks.delete','banks.restore','banks.activate','banks.deactivate',
            'clients.view','clients.create','clients.update','clients.delete','clients.restore',
            'complaints.view','complaints.create','complaints.update','complaints.delete','complaints.restore','complaints.assign','complaints.close','complaints.reject','complaints.resolve',
            'daily_reports.view','daily_reports.create','daily_reports.update','daily_reports.delete','daily_reports.submit','daily_reports.approve','daily_reports.reject',
            'debt_cases.view','debt_cases.create','debt_cases.update','debt_cases.delete','debt_cases.restore','debt_cases.assign',
            'governorates.view','governorates.create','governorates.update','governorates.delete',
            'installment_companies.view','installment_companies.create','installment_companies.update','installment_companies.delete','installment_companies.restore','installment_companies.activate','installment_companies.deactivate',
            'interactions.view','interactions.create','interactions.update','interactions.delete',
            'loan_types.view','loan_types.create','loan_types.update','loan_types.delete','loan_types.activate','loan_types.deactivate',
            'monthly_archives.view','monthly_archives.create','monthly_archives.update','monthly_archives.delete',
            'payments.view','payments.create','payments.update','payments.delete','payments.confirm','payments.reject',
            'performance_snapshots.view','performance_snapshots.create','performance_snapshots.update','performance_snapshots.delete',
            'permissions.view','permissions.create','permissions.update','permissions.delete',
            'portfolio_imports.view','portfolio_imports.create','portfolio_imports.update','portfolio_imports.process',
            'portfolios.view','portfolios.create','portfolios.update','portfolios.delete','portfolios.restore','portfolios.activate','portfolios.archive',
            'promises.view','promises.create','promises.update','promises.delete','promises.review',
            'report_exports.view','report_exports.create','report_exports.update','report_exports.delete','settings.manage',
            'roles.view','roles.create','roles.update','roles.delete','roles.assign_permission','roles.revoke_permission',
            'users.view','users.create','users.update','users.delete','users.restore','users.activate','users.deactivate','users.suspend','users.assign_role','users.assign_supervisor','users.change_password','users.grant_permission','users.revoke_permission',
            'visits.view','visits.create','visits.update','visits.delete','visits.complete',
        ];
        foreach ($permissions as $name) {
            [$group] = explode('.', $name, 2);
            Permission::query()->updateOrCreate(['name'=>$name], ['label'=>str_replace(['.','_'], ' ', $name), 'group'=>$group]);
        }

        $superAdmin = \App\Domain\Employees\Models\Role::query()->where('name','super_admin')->first();
        if ($superAdmin !== null) {
            $superAdmin->permissions()->syncWithoutDetaching(Permission::query()->pluck('id')->all());
        }
    }
}
