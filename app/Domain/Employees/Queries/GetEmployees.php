<?php

declare(strict_types=1);

namespace App\Domain\Employees\Queries;

use App\Domain\Employees\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class GetEmployees
{
    public function execute(array $filters = []): LengthAwarePaginator
    {
        return User::query()
            ->where('is_system_account', false)
            ->with(['role', 'supervisor'])
            ->when($filters['search'] ?? null, function ($query, $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_code', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, function ($query, $status): void {
                $query->where('status', $status);
            })
            ->when($filters['role_id'] ?? null, function ($query, $roleId): void {
                $query->where('role_id', $roleId);
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();
    }
}
