<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AssignUserToInstallmentCompany
{
    public function execute(
        User $user,
        InstallmentCompany $installmentCompany,
        ?User $assignedBy = null,
    ): void {
        try {
            DB::transaction(function () use (
                $user,
                $installmentCompany,
                $assignedBy
            ): void {
                DB::table('installment_company_user')->insertOrIgnore([
                    'installment_company_id' => $installmentCompany->getKey(),
                    'user_id' => $user->getKey(),
                    'assigned_by' => $assignedBy?->getKey(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to assign user to installment company.',
                [
                    'action' => self::class,
                    'user_id' => $user->getKey(),
                    'installment_company_id' => $installmentCompany->getKey(),
                    'assigned_by' => $assignedBy?->getKey(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }
}