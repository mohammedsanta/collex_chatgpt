<?php

namespace App\Domain\Loans\Services;

use Carbon\CarbonInterface;

final class DpdCalculatorService
{
    public function calculate(?CarbonInterface $dueDate, ?CarbonInterface $date = null): int
    {
        if (!$dueDate) {
            return 0;
        }

        $date ??= now();

        return max(0, $dueDate->startOfDay()->diffInDays($date->startOfDay(), false));
    }
}