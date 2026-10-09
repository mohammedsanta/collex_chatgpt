<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeactivateInstallmentCompany
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

                if (! $installmentCompany->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'This installment company is already inactive.'
                    );
                }

                $installmentCompany->update([
                    'is_active' => false,
                ]);

                return $installmentCompany->refresh();
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to deactivate installment company.',
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