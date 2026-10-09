<?php

namespace App\Domain\Payments\Services;

final class PaymentReferenceService
{
    public function normalize(?string $reference): ?string
    {
        if ($reference === null) {
            return null;
        }

        $reference = trim($reference);

        return $reference === '' ? null : $reference;
    }
}