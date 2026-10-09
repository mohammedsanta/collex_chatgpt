<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CreatePromiseToPay;
use App\Domain\Collections\Actions\DeletePromiseToPay;
use App\Domain\Collections\Actions\UpdatePromiseToPay;
use App\Domain\Collections\Models\PromiseToPay;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CreatePromiseToPayRequest;
use App\Http\Requests\Collections\UpdatePromiseToPayRequest;

final class PromiseToPayController extends Controller
{
    public function store(
        CreatePromiseToPayRequest $request,
        CreatePromiseToPay $action
    ): PromiseToPay {
        return $action->execute($request->validated());
    }

    public function update(
        UpdatePromiseToPayRequest $request,
        PromiseToPay $promise,
        UpdatePromiseToPay $action
    ): PromiseToPay {
        return $action->execute($promise, $request->validated());
    }

    public function destroy(
        PromiseToPay $promise,
        DeletePromiseToPay $action
    ): void {
        $action->execute($promise);
    }
}