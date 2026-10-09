<?php

declare(strict_types=1);

namespace App\Domain\Payments\Services;

use InvalidArgumentException;

/**
 * Allocates a received amount against an ordered list of outstanding balances.
 * This is a pure calculation; persistence belongs in an Action and a transaction.
 */
final class PaymentAllocator
{
    /**
     * @param list<array{id: int|string, balance: int|float|string}> $balances
     * @return array{allocations: list<array{id: int|string, amount: string}>, unallocated_amount: string}
     */
    public function allocate(int|float|string $paymentAmount, array $balances): array
    {
        $remaining = $this->toMinorUnits($paymentAmount);
        if ($remaining < 0) {
            throw new InvalidArgumentException('Payment amount cannot be negative.');
        }

        $allocations = [];
        foreach ($balances as $balance) {
            if (! array_key_exists('id', $balance) || ! array_key_exists('balance', $balance)) {
                throw new InvalidArgumentException('Each balance must contain an id and a balance.');
            }

            $outstanding = $this->toMinorUnits($balance['balance']);
            if ($outstanding < 0) {
                throw new InvalidArgumentException('Outstanding balances cannot be negative.');
            }

            if ($remaining === 0) {
                break;
            }
            if ($outstanding === 0) {
                continue;
            }

            $allocated = min($remaining, $outstanding);
            $allocations[] = ['id' => $balance['id'], 'amount' => $this->fromMinorUnits($allocated)];
            $remaining -= $allocated;
        }

        return [
            'allocations' => $allocations,
            'unallocated_amount' => $this->fromMinorUnits($remaining),
        ];
    }

    private function toMinorUnits(int|float|string $amount): int
    {
        $value = trim((string) $amount);
        if (! preg_match('/^\d+(?:\.\d{1,2})?$/', $value)) {
            throw new InvalidArgumentException('Amount must be a non-negative decimal with at most two fractional digits.');
        }

        [$whole, $fraction] = array_pad(explode('.', $value, 2), 2, '0');
        return ((int) $whole * 100) + (int) str_pad($fraction, 2, '0');
    }

    private function fromMinorUnits(int $amount): string
    {
        return intdiv($amount, 100).'.'.str_pad((string) ($amount % 100), 2, '0', STR_PAD_LEFT);
    }
}
