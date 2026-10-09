<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Payments\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class PaymentConfirmedNotification extends Notification
{
    use Queueable;

    public function __construct(public readonly Payment $payment) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array
    {
        return ['title' => 'Payment confirmed', 'message' => 'Payment '.$this->payment->receipt_number.' was confirmed.', 'payment_id' => $this->payment->getKey(), 'receipt_number' => $this->payment->receipt_number, 'amount' => (string) $this->payment->amount, 'status' => $this->payment->status];
    }
}
