<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\PromiseToPay;

final class PromiseToPayEvaluationService
{
    public function evaluate(PromiseToPay $promise): string
    {
        $promised = (float) $promise->promised_amount;
        $paid = (float) $promise->paid_amount;

        if ($paid >= $promised) {
            return 'kept';
        }

        if ($paid > 0) {
            return 'partial';
        }

        if ($promise->promise_date->isPast()) {
            return 'broken';
        }

        return 'active';
    }
}