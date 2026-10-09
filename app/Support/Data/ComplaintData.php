<?php

declare(strict_types=1);

namespace App\Support\Data;

use App\Support\Enums\ComplaintPriority;
use App\Support\Enums\ComplaintSource;

final readonly class ComplaintData
{
    public function __construct(
        public int $bankId,
        public string $subject,
        public string $description,
        public ?int $debtCaseId = null,
        public ?int $clientId = null,
        public ?ComplaintSource $source = null,
        public ComplaintPriority $priority = ComplaintPriority::MEDIUM,
        public ?string $dueAt = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'bank_id' => $this->bankId,
            'debt_case_id' => $this->debtCaseId,
            'client_id' => $this->clientId,
            'subject' => $this->subject,
            'description' => $this->description,
            'source' => $this->source?->value,
            'priority' => $this->priority->value,
            'due_at' => $this->dueAt,
        ];
    }
}