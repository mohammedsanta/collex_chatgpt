<?php

declare(strict_types=1);

namespace App\Domain\Payments\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Payments\Models\Payment;

final class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('payments.view');
    }

    public function view(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payments.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('payments.create');
    }

    public function update(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payments.update')
            && $payment->status === 'pending';
    }

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

    public function delete(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payments.delete')
            && $payment->status === 'pending';
    }
}