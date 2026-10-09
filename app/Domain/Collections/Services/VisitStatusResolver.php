<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Visit;

final class VisitStatusResolver
{
    public function canComplete(Visit $visit): bool
    {
        return $visit->status === 'scheduled';
    }

    public function canMiss(Visit $visit): bool
    {
        return $visit->status === 'scheduled';
    }

    public function canCancel(Visit $visit): bool
    {
        return $visit->status === 'scheduled';
    }
}