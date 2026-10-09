<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ActivateLoanType
{
    public function execute(LoanType $loanType): LoanType
    {
        try {
            return DB::transaction(function () use ($loanType): LoanType {
                $loanType = LoanType::query()
                    ->lockForUpdate()
                    ->findOrFail($loanType->getKey());

                if ($loanType->is_active) {
                    throw new \App\Exceptions\DomainException(
                        'This loan type is already active.'
                    );
                }

                $loanType->update([
                    'is_active' => true,
                ]);

                return $loanType->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to activate loan type.', [
                'action' => self::class,
                'loan_type_id' => $loanType->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}