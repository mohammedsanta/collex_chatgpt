<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

final class ClientPhoneNormalizer
{
    public function normalize(string $phone): string
    {
        $phone = preg_replace('/\D+/', '', $phone) ?? '';

        if (str_starts_with($phone, '0020')) {
            $phone = substr($phone, 4);
        }

        if (str_starts_with($phone, '20')) {
            $phone = substr($phone, 2);
        }

        if (str_starts_with($phone, '01') && strlen($phone) === 11) {
            return '+20' . $phone;
        }

        return $phone;
    }
}