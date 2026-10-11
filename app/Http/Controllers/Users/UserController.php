<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Domain\Employees\Actions\CreateUser;
use App\Domain\Employees\Actions\DeleteUser;
use App\Domain\Employees\Actions\UpdateUser;
use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Institutions\Models\InstallmentCompany;
use App\Domain\Reports\Models\PerformanceSnapshot;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateUserRequest;
use App\Http\Requests\Employees\UpdateUserRequest;
use Illuminate\Http\Request;

final class UserController extends Controller
{

    
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $roleId = $request->input('role_id');
        $status = $request->input('status');
        $accountType = $request->input('account_type');

        $query = User::query()
            ->with([
                'role',
                'supervisor',
                'banks',
                'installmentCompanies',
            ]);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($roleId !== null && $roleId !== '') {
            $query->where('role_id', $roleId);
        }

        if (in_array($status, ['active', 'inactive', 'suspended'], true)) {
            $query->where('status', $status);
        }

        if ($accountType === 'system') {
            $query->where('is_system_account', true);
        } elseif ($accountType === 'employee') {
            $query->where('is_system_account', false);
        }

        $users = $query
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('level')
            ->orderBy('label')
            ->get();

        $stats = [
            'total' => User::count(),
            'active' => User::where('status', 'active')->count(),
            'inactive' => User::where('status', 'inactive')->count(),
            'suspended' => User::where('status', 'suspended')->count(),
        ];

        return view('users.index', compact(
            'users',
            'roles',
            'stats',
            'search',
            'roleId',
            'status',
            'accountType'
        ));
    }


    public function store(CreateUserRequest $request, CreateUser $action): User
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUser $action
    ): User {
        return $action->execute($user, $request->validated());
    }

    public function destroy(User $user, DeleteUser $action): void
    {
        $action->execute($user);
    }

    // 

    public function team(User $user)
    {
        $user->load([
            'role',
            'supervisor',
            'subordinates.role',
        ]);

        return view('users.team', compact('user'));
    }

    public function assignments(User $user)
    {
        $user->load([
            'role',
            'banks',
            'installmentCompanies',
        ]);

        return view('users.assignments', [
            'user' => $user,
            'banks' => Bank::query()->orderBy('name')->get(),
            'installmentCompanies' => InstallmentCompany::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function permissions(User $user): \Illuminate\Contracts\View\View
    {
        $user->load(['role.permissions', 'permissions']);

        $permissions = \App\Domain\Employees\Models\Permission::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get()
            ->groupBy('group');

        return view('users.permissions', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    
    public function show(User $user): \Illuminate\Contracts\View\View
    {
        $user->load([
            'role',
            'supervisor',
            'subordinates.role',
            'banks',
            'installmentCompanies',
            'permissions',
            'role.permissions',
        ]);

        return view('users.show', compact('user'));
    }

    
    public function create(): \Illuminate\Contracts\View\View
    {
        $roles = \App\Domain\Employees\Models\Role::query()
            ->orderBy('level')
            ->orderBy('label')
            ->get();

        $supervisors = \App\Domain\Employees\Models\User::query()
            ->where('status', 'active')
            ->where('is_system_account', false)
            ->orderBy('name')
            ->get();

        return view('users.create', compact(
            'roles',
            'supervisors'
        ));
    }

    
    public function edit(
        \App\Domain\Employees\Models\User $user
    ): \Illuminate\Contracts\View\View {
        abort_if(
            $user->is_system_account,
            403,
            'لا يمكن تعديل حساب النظام.'
        );

        $roles = \App\Domain\Employees\Models\Role::query()
            ->orderBy('level')
            ->orderBy('label')
            ->get();

        $supervisors = \App\Domain\Employees\Models\User::query()
            ->where('status', 'active')
            ->where('is_system_account', false)
            ->where('id', '!=', $user->id)
            ->orderBy('name')
            ->get();

        return view('users.edit', compact(
            'user',
            'roles',
            'supervisors'
        ));
    }

        public function performance(Request $request, User $employee): View
    {
        abort_unless(
            $request->user()->hasPermission('users.view'),
            403
        );

        $filters = $request->validate([
            'year' => ['nullable', 'integer', 'between:2000,2100'],
            'month' => ['nullable', 'integer', 'between:1,12'],
            'bank_id' => ['nullable', 'integer', 'exists:banks,id'],
        ]);

        $base = PerformanceSnapshot::query()
            ->where('user_id', $employee->id)
            ->when($filters['year'] ?? null, fn ($q, $year) => $q->where('year', $year))
            ->when($filters['month'] ?? null, fn ($q, $month) => $q->where('month', $month))
            ->when($filters['bank_id'] ?? null, fn ($q, $bankId) => $q->where('bank_id', $bankId));

        $summary = [
            'cases_assigned' => (clone $base)->sum('cases_assigned'),
            'cases_processed' => (clone $base)->sum('cases_processed'),
            'promises_total' => (clone $base)->sum('promises_total'),
            'promises_kept' => (clone $base)->sum('promises_kept'),
            'collected_amount' => (clone $base)->sum('collected_amount'),
            'target_amount' => (clone $base)->sum('target_amount'),
            'average_efficiency' => round((float) ((clone $base)->avg('efficiency') ?? 0), 2),
        ];

        $snapshots = (clone $base)
            ->with('bank')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(12)
            ->withQueryString();

        return view('employees.performance', [
            'employee' => $employee->load('role'),
            'snapshots' => $snapshots,
            'summary' => $summary,
            'banks' => \App\Domain\Institutions\Models\Bank::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

}