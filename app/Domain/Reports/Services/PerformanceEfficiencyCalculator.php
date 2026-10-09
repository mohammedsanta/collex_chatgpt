<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

final class PerformanceEfficiencyCalculator
{
    public function calculate(
        float $collectedAmount,
        float $targetAmount
    ): float {
        if ($targetAmount <= 0) {
            return 0.0;
        }

        return round(
            ($collectedAmount / $targetAmount) * 100,
            2
        );
    }
}