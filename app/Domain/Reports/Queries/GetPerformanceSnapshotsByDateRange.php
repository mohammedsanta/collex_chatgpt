<?php

declare(strict_types=1);

namespace App\Domain\Reports\Queries;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Database\Eloquent\Builder;

final class GetPerformanceSnapshotsByDateRange
{
    public function execute(
        int $fromYear,
        int $fromMonth,
        int $toYear,
        int $toMonth
    ): Builder {
        return PerformanceSnapshot::query()
            ->where(function (Builder $query) use (
                $fromYear,
                $fromMonth,
                $toYear,
                $toMonth
            ): void {
                $query
                    ->where(function (Builder $query) use ($fromYear, $fromMonth): void {
                        $query
                            ->where('year', '>', $fromYear)
                            ->orWhere(function (Builder $query) use ($fromYear, $fromMonth): void {
                                $query
                                    ->where('year', $fromYear)
                                    ->where('month', '>=', $fromMonth);
                            });
                    })
                    ->where(function (Builder $query) use ($toYear, $toMonth): void {
                        $query
                            ->where('year', '<', $toYear)
                            ->orWhere(function (Builder $query) use ($toYear, $toMonth): void {
                                $query
                                    ->where('year', $toYear)
                                    ->where('month', '<=', $toMonth);
                            });
                    });
            })
            ->with([
                'user',
                'bank',
            ])
            ->orderByDesc('year')
            ->orderByDesc('month');
    }
}