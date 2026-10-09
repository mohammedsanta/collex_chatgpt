<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class InstallmentCompanyAssignmentService
{
    public function assign(User $user, int $companyId, ?int $assignedBy): void
    {
        try {
            DB::transaction(function () use ($user, $companyId, $assignedBy) {
                $user->installmentCompanies()->syncWithoutDetaching([
                    $companyId => ['assigned_by' => $assignedBy],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign installment company.', [
                'user_id' => $user->id,
                'company_id' => $companyId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function remove(User $user, int $companyId): void
    {
        try {
            DB::transaction(function () use ($user, $companyId) {
                $user->installmentCompanies()->detach($companyId);
            });
        } catch (Throwable $e) {
            Log::error('Failed to remove installment company assignment.', [
                'user_id' => $user->id,
                'company_id' => $companyId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}