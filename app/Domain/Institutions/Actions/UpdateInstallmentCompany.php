<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateInstallmentCompany
{
    public function execute(
        InstallmentCompany $installmentCompany,
        array $data,
    ): InstallmentCompany {
        try {
            return DB::transaction(function () use (
                $installmentCompany,
                $data
            ): InstallmentCompany {
                $installmentCompany = InstallmentCompany::query()
                    ->lockForUpdate()
                    ->findOrFail($installmentCompany->getKey());

                $updates = array_intersect_key(
                    $data,
                    array_flip([
                        'name',
                        'code',
                        'logo_path',
                        'sector',
                        'is_active',
                        'notes',
                    ])
                );

                $installmentCompany->update($updates);

                return $installmentCompany->refresh();
            });
        } catch (Throwable $e) {
            Log::error(
                'Failed to update installment company.',
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