<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\CreatePerformanceSnapshot;
use App\Domain\Reports\Actions\UpdatePerformanceSnapshot;
use App\Domain\Reports\Models\PerformanceSnapshot;
use App\Http\Controllers\Controller;

final class PerformanceSnapshotController extends Controller
{
    public function store(CreatePerformanceSnapshot $action): PerformanceSnapshot
    {
        return $action->execute(request()->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'bank_id' => ['required', 'integer', 'exists:banks,id'],
            'year' => ['required', 'integer'],
            'month' => ['required', 'integer', 'between:1,12'],
        ]));
    }

    public function update(
        PerformanceSnapshot $snapshot,
        UpdatePerformanceSnapshot $action
    ): PerformanceSnapshot {
        return $action->execute($snapshot, request()->all());
    }
}