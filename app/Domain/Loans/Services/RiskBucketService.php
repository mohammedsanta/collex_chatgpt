<?php

namespace App\Domain\Loans\Services;

final class RiskBucketService
{
    public function determine(int $dpd): string
    {
        return match (true) {
            $dpd <= 0 => 'current',
            $dpd <= 30 => '1_30',
            $dpd <= 60 => '31_60',
            $dpd <= 90 => '61_90',
            default => '90_plus',
        };
    }
}