<?php

namespace App\Domain\Payments\Services;

use Carbon\CarbonInterface;

final class PaymentDateService
{
    public function isFuture(CarbonInterface $paidAt): bool
    {
        return $paidAt->isFuture();
    }
}