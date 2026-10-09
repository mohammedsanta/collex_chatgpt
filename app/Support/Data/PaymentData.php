<?php

declare(strict_types=1);

namespace App\Support\Data;

use App\Support\Enums\PaymentMethod;

final readonly class PaymentData
{
    public function __construct(
        public int $debtCaseId,
        public float $amount,
        public PaymentMethod $method,
        public ?int $collectorId = null,
        public ?int $promiseId = null,
        public ?string $reference = null,
        public ?string $proofPath = null,
        public ?string $paidAt = null,
        public ?string $notes = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'debt_case_id' => $this->debtCaseId,
            'amount' => $this->amount,
            'method' => $this->method->value,
            'collector_id' => $this->collectorId,
            'promise_id' => $this->promiseId,
            'reference' => $this->reference,
            'proof_path' => $this->proofPath,
            'paid_at' => $this->paidAt,
            'notes' => $this->notes,
        ];
    }
}