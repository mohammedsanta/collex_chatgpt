<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

final class ClientPhoneValidationService
{
    public function normalize(string $phone): string
    {
        return preg_replace('/[\s\-\(\)]/', '', trim($phone)) ?? trim($phone);
    }

    public function isPotentiallyValid(string $phone): bool
    {
        $normalized = $this->normalize($phone);

        return (bool) preg_match('/^\+?[0-9]{8,20}$/', $normalized);
    }
}