<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteLoanType
{
    public function execute(LoanType $loanType): void
    {
        try {
            DB::transaction(function () use ($loanType): void {
                $loanType = LoanType::query()
                    ->lockForUpdate()
                    ->findOrFail($loanType->getKey());

                if ($loanType->debtCases()->exists()) {
                    throw new \App\Exceptions\DomainException(
                        'A loan type assigned to debt cases cannot be deleted.'
                    );
                }

                $loanType->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete loan type.', [
                'action' => self::class,
                'loan_type_id' => $loanType->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}