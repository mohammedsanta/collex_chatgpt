<?php

declare(strict_types=1);

use App\Domain\Payments\Services\PaymentAllocator;

test('allocates payments against balances in supplied priority order', function (): void {
    $result = (new PaymentAllocator())->allocate('125.00', [
        ['id' => 10, 'balance' => '50.00'],
        ['id' => 11, 'balance' => '100.00'],
    ]);

    expect($result['allocations'])->toBe([
        ['id' => 10, 'amount' => '50.00'],
        ['id' => 11, 'amount' => '75.00'],
    ])->and($result['unallocated_amount'])->toBe('0.00');
});

test('returns unallocated money when balances are insufficient', function (): void {
    $result = (new PaymentAllocator())->allocate('100.00', [['id' => 1, 'balance' => '30.25']]);

    expect($result['allocations'])->toBe([['id' => 1, 'amount' => '30.25']])
        ->and($result['unallocated_amount'])->toBe('69.75');
});
