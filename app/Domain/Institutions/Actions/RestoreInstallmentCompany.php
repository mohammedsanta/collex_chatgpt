<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreInstallmentCompany
{
    public function execute(int $companyId): InstallmentCompany
    {
        try {
            return DB::transaction(function () use ($companyId): InstallmentCompany {
                $company = InstallmentCompany::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($companyId);

                if (! $company->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The installment company is not deleted.'
                    );
                }

                $company->restore();

                return $company->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore installment company.', [
                'action' => self::class,
                'company_id' => $companyId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}