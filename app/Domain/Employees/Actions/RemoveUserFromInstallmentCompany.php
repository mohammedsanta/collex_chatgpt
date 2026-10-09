<?php

declare(strict_types=1);

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RemoveUserFromInstallmentCompany
{
    public function execute(
        User $user,
        InstallmentCompany $installmentCompany,
    ): void {
        try {
            DB::transaction(function () use (
                $user,
                $installmentCompany
            ): void {
                DB::table('installment_company_user')
                    ->where('user_id', $user->getKey())
                    ->where(
                        'installment_company_id',
                        $installmentCompany->getKey()
                    )
                    ->delete();
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to remove user from installment company.',
                [
                    'action' => self::class,
                    'user_id' => $user->getKey(),
                    'installment_company_id' => $installmentCompany->getKey(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }
}