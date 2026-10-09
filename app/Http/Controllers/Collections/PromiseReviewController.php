<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\ReviewPromiseToPay;
use App\Domain\Collections\Models\PromiseToPay;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\ReviewPromiseToPayRequest;

final class PromiseReviewController extends Controller
{
    public function __invoke(
        ReviewPromiseToPayRequest $request,
        PromiseToPay $promise,
        ReviewPromiseToPay $action
    ): PromiseToPay {
        return $action->execute($promise, $request->validated());
    }
}