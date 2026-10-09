<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\PromiseToPay;

final class PromiseOutstandingAmountCalculator
{
    public function calculate(PromiseToPay $promise): float
    {
        return max(
            0,
            (float) $promise->promised_amount
            - (float) $promise->paid_amount
        );
    }
}