```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\CreateUser;
use App\Domain\Employees\Actions\DeleteUser;
use App\Domain\Employees\Actions\UpdateUser;
use App\Domain\Employees\Models\Permission;
use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Institutions\Models\InstallmentCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateUserRequest;
use App\Http\Requests\Employees\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()
            ->with([
                'role',
                'supervisor:id,name,employee_code',
                'banks:id,name',
                'installmentCompanies:id,name',
            ]);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->integer('role_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->input('account_type') === 'system') {
            $query->where('is_system_account', true);
        } elseif ($request->input('account_type') === 'employee') {
            $query->where('is_system_account', false);
        }

        $users = $query
            ->orderBy('id')
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

        return view('users.index', compact('users', 'roles', 'stats'));
    }

    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::query()
                ->orderBy('level')
                ->orderBy('label')
                ->get(),

            'supervisors' => User::query()
                ->where('status', 'active')
                ->where('is_system_account', false)
                ->orderBy('name')
                ->get(['id', 'name', 'employee_code']),

            'banks' => Bank::query()
                ->orderBy('name')
                ->get(['id', 'name']),

            'installmentCompanies' => InstallmentCompany::query()
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function store(
        CreateUserRequest $request,
        CreateUser $action
    ): RedirectResponse {
        $user = $action->execute($request->validated());

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function show(User $user): View
    {
        $user->load([
            'role.permissions',
            'supervisor',
            'subordinates.role',
            'banks',
            'installmentCompanies',
            'permissions',
        ]);

        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        abort_if($user->is_system_account, 403, 'لا يمكن تعديل حساب النظام.');

        $user->load([
            'role',
            'banks',
            'installmentCompanies',
        ]);

        return view('users.edit', [
            'user' => $user,

            'roles' => Role::query()
                ->orderBy('level')
                ->orderBy('label')
                ->get(),

            'supervisors' => User::query()
                ->where('status', 'active')
                ->where('is_system_account', false)
                ->whereKeyNot($user->id)
                ->orderBy('name')
                ->get(['id', 'name', 'employee_code']),

            'banks' => Bank::query()
                ->orderBy('name')
                ->get(['id', 'name']),

            'installmentCompanies' => InstallmentCompany::query()
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUser $action
    ): RedirectResponse {
        abort_if($user->is_system_account, 403, 'لا يمكن تعديل حساب النظام.');

        $action->execute($user, $request->validated());

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function destroy(
        User $user,
        DeleteUser $action
    ): RedirectResponse {
        abort_if($user->is_system_account, 403, 'لا يمكن حذف حساب النظام.');

        $action->execute($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'تم حذف المستخدم بنجاح.');
    }
}
```