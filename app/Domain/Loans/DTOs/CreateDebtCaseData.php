```php
<?php

declare(strict_types=1);

namespace App\Domain\Loans\DTOs;

final readonly class CreateDebtCaseData
{
    public function __construct(
        public int $portfolioId,
        public int $bankId,
        public int $clientId,
        public ?int $loanTypeId = null,
        public ?int $assignedUserId = null,
        public ?string $loanNumber = null,
        public string $status = 'active',
        public float $totalDebt = 0.0,
        public float $overdueAmount = 0.0,
        public ?float $installmentValue = null,
        public ?float $minInstallmentDiff = null,
        public float $lateFee = 0.0,
        public int $bucket = 0,
        public int $dpd = 0,
        public ?string $nextDueDate = null,
        public ?string $loanStartDate = null,
        public ?string $loanEndDate = null,
    ) {
    }

    /**
     * Create the DTO from validated request data.
     *
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            portfolioId: (int) $data['portfolio_id'],
            bankId: (int) $data['bank_id'],
            clientId: (int) $data['client_id'],
            loanTypeId: isset($data['loan_type_id'])
                ? (int) $data['loan_type_id']
                : null,
            assignedUserId: isset($data['assigned_user_id'])
                ? (int) $data['assigned_user_id']
                : null,
            loanNumber: $data['loan_number'] ?? null,
            status: $data['status'] ?? 'active',
            totalDebt: (float) ($data['total_debt'] ?? 0),
            overdueAmount: (float) ($data['overdue_amount'] ?? 0),
            installmentValue: isset($data['installment_value'])
                ? (float) $data['installment_value']
                : null,
            minInstallmentDiff: isset($data['min_installment_diff'])
                ? (float) $data['min_installment_diff']
                : null,
            lateFee: (float) ($data['late_fee'] ?? 0),
            bucket: (int) ($data['bucket'] ?? 0),
            dpd: (int) ($data['dpd'] ?? 0),
            nextDueDate: $data['next_due_date'] ?? null,
            loanStartDate: $data['loan_start_date'] ?? null,
            loanEndDate: $data['loan_end_date'] ?? null,
        );
    }

    /**
     * Convert the DTO to the array expected by the existing Action.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'portfolio_id' => $this->portfolioId,
            'bank_id' => $this->bankId,
            'client_id' => $this->clientId,
            'loan_type_id' => $this->loanTypeId,
            'assigned_user_id' => $this->assignedUserId,
            'loan_number' => $this->loanNumber,
            'status' => $this->status,
            'total_debt' => $this->totalDebt,
            'overdue_amount' => $this->overdueAmount,
            'installment_value' => $this->installmentValue,
            'min_installment_diff' => $this->minInstallmentDiff,
            'late_fee' => $this->lateFee,
            'bucket' => $this->bucket,
            'dpd' => $this->dpd,
            'next_due_date' => $this->nextDueDate,
            'loan_start_date' => $this->loanStartDate,
            'loan_end_date' => $this->loanEndDate,
        ];
    }
}
```
