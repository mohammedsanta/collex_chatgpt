<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CancelVisit;
use App\Domain\Collections\Actions\CompleteVisit;
use App\Domain\Collections\Actions\MarkVisitMissed;
use App\Domain\Collections\Models\Visit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CompleteVisitRequest;

final class VisitStatusController extends Controller
{
    public function complete(
        CompleteVisitRequest $request,
        Visit $visit,
        CompleteVisit $action
    ): Visit {
        return $action->execute($visit, $request->validated());
    }

    public function missed(
        Visit $visit,
        MarkVisitMissed $action
    ): Visit {
        return $action->execute($visit);
    }

    public function cancel(
        Visit $visit,
        CancelVisit $action
    ): Visit {
        return $action->execute($visit);
    }
}