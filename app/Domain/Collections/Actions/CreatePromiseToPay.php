<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PromiseToPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreatePromiseToPay
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): PromiseToPay
    {
        try {
            return DB::transaction(function () use ($data): PromiseToPay {
                return PromiseToPay::create([
                    'debt_case_id' => $data['debt_case_id'],
                    'user_id' => $data['user_id'],
                    'promised_amount' => $data['promised_amount'],
                    'paid_amount' => 0,
                    'promise_date' => $data['promise_date'],
                    'status' => 'active',
                    'notes' => $data['notes'] ?? null,
                    'reviewed_by' => null,
                    'reviewed_at' => null,
                    'closed_at' => null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create promise to pay.', [
                'action' => self::class,
                'debt_case_id' => $data['debt_case_id'] ?? null,
                'user_id' => $data['user_id'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}