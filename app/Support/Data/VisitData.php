<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class VisitData
{
    public function __construct(
        public int $debtCaseId,
        public int $userId,
        public string $scheduledAt,
        public ?string $address = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $notes = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'debt_case_id' => $this->debtCaseId,
            'user_id' => $this->userId,
            'scheduled_at' => $this->scheduledAt,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'notes' => $this->notes,
        ];
    }
}