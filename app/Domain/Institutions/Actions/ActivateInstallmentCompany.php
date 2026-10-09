<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ActivateInstallmentCompany
{
    public function execute(
        InstallmentCompany $installmentCompany
    ): InstallmentCompany {
        try {
            return DB::transaction(function () use (
                $installmentCompany
            ): InstallmentCompany {
                $installmentCompany = InstallmentCompany::query()
                    ->lockForUpdate()
                    ->findOrFail($installmentCompany->getKey());

                if ($installmentCompany->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'This installment company is already active.'
                    );
                }

                $installmentCompany->update([
                    'is_active' => true,
                ]);

                return $installmentCompany->refresh();
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to activate installment company.',
                [
                    'action' => self::class,
                    'installment_company_id' => $installmentCompany->getKey(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }
}