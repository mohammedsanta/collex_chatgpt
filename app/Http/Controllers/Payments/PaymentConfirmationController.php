<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Domain\Payments\Actions\ConfirmPayment;
use App\Domain\Payments\Actions\RejectPayment;
use App\Domain\Payments\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\ConfirmPaymentRequest;
use App\Http\Requests\Payments\RejectPaymentRequest;
use Illuminate\Http\RedirectResponse;

final class PaymentConfirmationController extends Controller
{
    public function confirm(ConfirmPaymentRequest $request, Payment $payment, ConfirmPayment $action): RedirectResponse|Payment
    {
        $this->authorize('confirm', $payment);
        $confirmed = $action->execute($payment, (int) $request->user()->getAuthIdentifier());
        return $request->expectsJson() ? $confirmed : back()->with('status', 'Payment confirmed successfully.');
    }

    public function reject(RejectPaymentRequest $request, Payment $payment, RejectPayment $action): RedirectResponse|Payment
    {
        $this->authorize('reject', $payment);
        $data = $request->validated();
        $rejected = $action->execute($payment, (int) $request->user()->getAuthIdentifier(), $data['reason']);
        return $request->expectsJson() ? $rejected : back()->with('status', 'Payment rejected successfully.');
    }
}
