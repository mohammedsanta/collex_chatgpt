<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class ClientData
{
    public function __construct(
        public string $nationalId,
        public string $name,
        public ?string $email = null,
        public ?int $governorateId = null,
        public ?string $address = null,
        public ?string $employerName = null,
        public ?string $jobTitle = null,
        public ?string $workAddress = null,
        public ?string $notes = null,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}