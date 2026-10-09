<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class DebtCaseData
{
    public function __construct(
        public int $portfolioId,
        public int $bankId,
        public int $clientId,
        public float $totalDebt,
        public float $overdueAmount,
        public float $lateFee = 0,
        public int $dpd = 0,
        public ?int $loanTypeId = null,
        public ?string $loanNumber = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'portfolio_id' => $this->portfolioId,
            'bank_id' => $this->bankId,
            'client_id' => $this->clientId,
            'loan_type_id' => $this->loanTypeId,
            'loan_number' => $this->loanNumber,
            'total_debt' => $this->totalDebt,
            'overdue_amount' => $this->overdueAmount,
            'late_fee' => $this->lateFee,
            'dpd' => $this->dpd,
        ];
    }
}