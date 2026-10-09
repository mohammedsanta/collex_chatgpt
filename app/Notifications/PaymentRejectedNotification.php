<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Payments\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class PaymentRejectedNotification extends Notification
{
    use Queueable;

    public function __construct(public readonly Payment $payment) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array
    {
        return ['title' => 'Payment rejected', 'message' => 'Payment '.$this->payment->receipt_number.' was rejected.', 'payment_id' => $this->payment->getKey(), 'receipt_number' => $this->payment->receipt_number, 'reason' => $this->payment->rejection_reason];
    }
}
