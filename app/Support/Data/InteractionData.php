<?php

declare(strict_types=1);

namespace App\Support\Data;

use App\Support\Enums\InteractionOutcome;
use App\Support\Enums\InteractionType;

final readonly class InteractionData
{
    public function __construct(
        public int $debtCaseId,
        public int $userId,
        public InteractionType $type,
        public ?InteractionOutcome $outcome = null,
        public ?int $clientPhoneId = null,
        public ?string $notes = null,
        public ?int $durationSeconds = null,
        public ?string $occurredAt = null,
        public ?string $followupAt = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'debt_case_id' => $this->debtCaseId,
            'user_id' => $this->userId,
            'client_phone_id' => $this->clientPhoneId,
            'type' => $this->type->value,
            'outcome' => $this->outcome?->value,
            'notes' => $this->notes,
            'duration_seconds' => $this->durationSeconds,
            'occurred_at' => $this->occurredAt,
            'followup_at' => $this->followupAt,
        ];
    }
}