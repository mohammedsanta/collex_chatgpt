<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PromiseToPayService
{
    public function outstandingAmount(PromiseToPay $promise): float
    {
        return max(
            0,
            (float) $promise->promised_amount - (float) $promise->paid_amount
        );
    }

    public function refreshStatus(
        PromiseToPay $promise,
        PromiseToPayEvaluationService $evaluation
    ): PromiseToPay {
        try {
            $promise->update([
                'status' => $evaluation->evaluate($promise),
            ]);

            return $promise->refresh();
        } catch (Throwable $e) {
            Log::error('Failed to refresh promise status.', [
                'promise_id' => $promise->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}