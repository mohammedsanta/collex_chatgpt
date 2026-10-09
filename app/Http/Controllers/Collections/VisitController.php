<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CreateVisit;
use App\Domain\Collections\Actions\DeleteVisit;
use App\Domain\Collections\Actions\UpdateVisit;
use App\Domain\Collections\Models\Visit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CreateVisitRequest;
use App\Http\Requests\Collections\UpdateVisitRequest;

final class VisitController extends Controller
{
    public function store(CreateVisitRequest $request, CreateVisit $action): Visit
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateVisitRequest $request,
        Visit $visit,
        UpdateVisit $action
    ): Visit {
        return $action->execute($visit, $request->validated());
    }

    public function destroy(Visit $visit, DeleteVisit $action): void
    {
        $action->execute($visit);
    }
}