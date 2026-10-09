<?php

declare(strict_types=1);

namespace App\Domain\Payments\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Payments\Models\Payment;

final class PaymentConfirmationPolicy
{
    public function confirm(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payments.confirm')
            && $payment->status === 'pending';
    }

    public function reject(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payments.reject')
            && $payment->status === 'pending';
    }
}