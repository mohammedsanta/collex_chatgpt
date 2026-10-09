<?php

declare(strict_types=1);

use App\Support\Helpers\MoneyHelper;

test('normalizes monetary amounts to two decimal places', function (): void {
    expect(MoneyHelper::normalize('12.3'))->toBe('12.30')
        ->and(MoneyHelper::normalize('0'))->toBe('0.00')
        ->and(MoneyHelper::normalize('1000.999'))->toBe('1001.00');
});

test('rejects non-numeric monetary amounts', function (): void {
    expect(fn () => MoneyHelper::normalize('twelve'))->toThrow(InvalidArgumentException::class);
});
