<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateLoanType
{
    public function execute(LoanType $loanType, array $data): LoanType
    {
        try {
            return DB::transaction(function () use ($loanType, $data): LoanType {
                $loanType = LoanType::query()
                    ->lockForUpdate()
                    ->findOrFail($loanType->getKey());

                $loanType->update($data);

                return $loanType->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update loan type.', [
                'action' => self::class,
                'loan_type_id' => $loanType->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}