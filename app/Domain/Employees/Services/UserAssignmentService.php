<?php

declare(strict_types=1);

namespace App\Domain\Employees\Services;

use App\Domain\Employees\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UserAssignmentService
{
    public function assignToBank(
        User $user,
        int $bankId,
        ?int $assignedBy = null
    ): void {
        try {
            DB::transaction(function () use ($user, $bankId, $assignedBy) {
                $user->banks()->syncWithoutDetaching([
                    $bankId => ['assigned_by' => $assignedBy],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign user to bank.', [
                'user_id' => $user->id,
                'bank_id' => $bankId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function assignToInstallmentCompany(
        User $user,
        int $companyId,
        ?int $assignedBy = null
    ): void {
        try {
            DB::transaction(function () use ($user, $companyId, $assignedBy) {
                $user->installmentCompanies()->syncWithoutDetaching([
                    $companyId => ['assigned_by' => $assignedBy],
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to assign user to installment company.', [
                'user_id' => $user->id,
                'company_id' => $companyId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}