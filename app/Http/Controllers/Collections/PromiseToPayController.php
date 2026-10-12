<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CreatePromiseToPay;
use App\Domain\Collections\Actions\DeletePromiseToPay;
use App\Domain\Collections\Actions\UpdatePromiseToPay;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Collections\Queries\GetPromisesToPay;
use App\Domain\Collections\Queries\GetPromiseToPayDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CreatePromiseToPayRequest;
use App\Http\Requests\Collections\UpdatePromiseToPayRequest;
use Illuminate\Http\Request;

final class PromiseToPayController extends Controller
{
        public function index(
        Request $request,
        GetPromisesToPay $query
    ) {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:150'],
            'status' => [
                'nullable',
                'in:active,kept,broken,cancelled',
            ],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        return view('ptp.index', [
            'promises' => $query->paginate($filters),
            'statistics' => $query->statistics(),
            'filters' => $filters,
        ]);
    }

    
    public function show(
        int $promise,
        GetPromiseToPayDetails $query
    ) {
        $record = $query->execute($promise);

        $this->authorize('view', $record);

        return view('ptp.show', [
            'promise' => $record,
        ]);
    }


    public function store(
        CreatePromiseToPayRequest $request,
        CreatePromiseToPay $action
    ): PromiseToPay {
        return $action->execute($request->validated());
    }

    public function update(
        UpdatePromiseToPayRequest $request,
        string $bank,
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