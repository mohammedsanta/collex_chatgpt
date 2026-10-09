<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class PromiseToPayData
{
    public function __construct(
        public int $debtCaseId,
        public int $userId,
        public float $promisedAmount,
        public string $promiseDate,
        public ?string $notes = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'debt_case_id' => $this->debtCaseId,
            'user_id' => $this->userId,
            'promised_amount' => $this->promisedAmount,
            'promise_date' => $this->promiseDate,
            'notes' => $this->notes,
        ];
    }
}