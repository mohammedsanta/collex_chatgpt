<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Domain\Payments\Queries\FindPaymentByReceiptNumber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class PaymentSearchController extends Controller
{
    public function __invoke(
        Request $request,
        FindPaymentByReceiptNumber $query
    ) {
        return $query->execute(
            (string) $request->string('receipt_number')
        );
    }
}