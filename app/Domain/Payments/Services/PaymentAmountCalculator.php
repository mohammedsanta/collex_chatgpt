<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use App\Domain\Loans\Models\DebtCase;
use InvalidArgumentException;

final class PaymentAmountCalculator
{
    public function remainingBalance(DebtCase $debtCase): float
    {
        return $this->remainingBalanceMinorUnits($debtCase) / 100;
    }

    public function remainingBalanceMinorUnits(DebtCase $debtCase): int
    {
        return max(0, $this->toMinorUnits((string) $debtCase->total_debt) - $this->toMinorUnits((string) $debtCase->collected_amount));
    }

    public function exceedsRemainingBalance(DebtCase $debtCase, int|float|string $amount): bool
    {
        return $this->toMinorUnits((string) $amount) > $this->remainingBalanceMinorUnits($debtCase);
    }

    private function toMinorUnits(string $amount): int
    {
        if (! preg_match('/^\d+(?:\.\d{1,2})?$/', $amount)) {
            throw new InvalidArgumentException('Money values must be non-negative decimals with at most two decimal places.');
        }
        [$whole, $fraction] = array_pad(explode('.', $amount, 2), 2, '0');
        return ((int) $whole * 100) + (int) str_pad($fraction, 2, '0');
    }
}
