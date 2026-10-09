<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Actions\AssignCollector;
use App\Domain\Loans\Actions\UnassignCollector;
use App\Domain\Loans\Models\DebtCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\AssignCollectorRequest;
use Illuminate\Http\Request;

final class DebtCaseAssignmentController extends Controller
{
    public function store(
        Request $httpRequest,
        AssignCollectorRequest $request,
        DebtCase $debtCase,
        AssignCollector $action
    ): void {
        $action->execute($debtCase, $request->validated(), (int) $httpRequest->user()->getAuthIdentifier());
    }

    public function destroy(
        DebtCase $debtCase,
        UnassignCollector $action
    ): void {
        $action->execute($debtCase);
    }
}