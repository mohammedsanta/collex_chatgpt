<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteInstallmentCompany
{
    public function execute(
        InstallmentCompany $installmentCompany
    ): void {
        try {
            DB::transaction(function () use ($installmentCompany): void {
                $installmentCompany = InstallmentCompany::query()
                    ->lockForUpdate()
                    ->findOrFail($installmentCompany->getKey());

                if ($installmentCompany->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'An active installment company cannot be deleted. Deactivate it first.'
                    );
                }

                $installmentCompany->delete();
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to delete installment company.',
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