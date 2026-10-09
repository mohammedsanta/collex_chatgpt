<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class PortfolioData
{
    public function __construct(
        public int $bankId,
        public string $name,
        public int $periodYear,
        public int $periodMonth,
        public ?string $notes = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'bank_id' => $this->bankId,
            'name' => $this->name,
            'period_year' => $this->periodYear,
            'period_month' => $this->periodMonth,
            'notes' => $this->notes,
        ];
    }
}