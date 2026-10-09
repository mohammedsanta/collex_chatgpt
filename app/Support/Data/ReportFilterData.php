<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class ReportFilterData
{
    public function __construct(
        public ?int $bankId = null,
        public ?int $userId = null,
        public ?string $from = null,
        public ?string $to = null,
        public ?int $year = null,
        public ?int $month = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            get_object_vars($this),
            static fn ($value) => $value !== null
        );
    }
}