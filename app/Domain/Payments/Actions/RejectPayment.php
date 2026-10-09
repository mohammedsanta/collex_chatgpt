<?php

declare(strict_types=1);

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use App\Domain\Activity\Services\ActivityLogger;
use App\Domain\Payments\Services\PaymentRejectionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

final class RejectPayment
{
    public function __construct(
        private readonly PaymentRejectionService $rejectionService,
        private readonly ActivityLogger $activityLogger,
    ) {
    }

    public function execute(
        Payment $payment,
        int $userId,
        string $reason,
    ): Payment {
        $reason = trim($reason);

        if ($reason === '') {
            throw new InvalidArgumentException(
                'A rejection reason is required.',
            );
        }

        try {
            return DB::transaction(function () use (
                $payment,
                $userId,
                $reason,
            ): Payment {
                $lockedPayment = Payment::query()
                    ->lockForUpdate()
                    ->findOrFail($payment->getKey());

                $this->rejectionService
                    ->ensureCanBeRejected($lockedPayment);

                $lockedPayment->update([
                    'status' => 'rejected',
                    'rejection_reason' => $reason,
                ]);

                $this->activityLogger->log(
                    userId: $userId,
                    event: 'payment.rejected',
                    description: 'Payment rejected.',
                    properties: ['reason' => $reason],
                    subject: $lockedPayment,
                );

                return $lockedPayment->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to reject payment.', [
                'payment_id' => $payment->getKey(),
                'user_id' => $userId,
                'exception' => $exception,
            ]);

            throw $exception;
        }
    }
}