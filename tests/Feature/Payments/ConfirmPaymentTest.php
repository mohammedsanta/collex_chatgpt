<?php

declare(strict_types=1);

use App\Domain\Customers\Models\Client;
use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\Portfolio;
use App\Domain\Payments\Actions\ConfirmPayment;
use App\Domain\Payments\Models\Payment;
use App\Exceptions\DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function paymentConfirmationFixture(): array
{
    $role = Role::query()->create(['name' => 'collector-test', 'label' => 'Collector', 'is_system' => false, 'level' => 1]);
    $user = User::query()->create([
        'employee_code' => 'TEST-'.strtoupper(bin2hex(random_bytes(3))),
        'name' => 'Test Collector',
        'email' => 'collector-'.bin2hex(random_bytes(3)).'@example.test',
        'password' => 'password',
        'role_id' => $role->id,
        'status' => 'active',
        'is_system_account' => false,
    ]);
    $bank = Bank::factory()->create();
    $client = Client::factory()->create();
    $portfolio = Portfolio::factory()->create(['bank_id' => $bank->id]);
    $case = DebtCase::factory()->create([
        'portfolio_id' => $portfolio->id,
        'bank_id' => $bank->id,
        'client_id' => $client->id,
        'total_debt' => '100.00',
        'collected_amount' => '0.00',
    ]);
    $payment = Payment::query()->create([
        'receipt_number' => 'PAY-'.strtoupper(bin2hex(random_bytes(10))),
        'debt_case_id' => $case->id,
        'amount' => '25.00',
        'method' => 'cash',
        'paid_at' => now(),
        'status' => 'pending',
    ]);

    return [$user, $case, $payment];
}

test('confirming a payment updates the debt case balance and writes an audit log', function (): void {
    [$user, $case, $payment] = paymentConfirmationFixture();

    $confirmed = app(ConfirmPayment::class)->execute($payment, (int) $user->id);

    expect($confirmed->status)->toBe('confirmed')
        ->and($confirmed->confirmed_by)->toBe($user->id)
        ->and((string) $case->fresh()->collected_amount)->toBe('25.00')
        ->and(\App\Domain\Reports\Models\ActivityLog::query()->where('event', 'payment.confirmed')->count())->toBe(1);
});

test('a payment cannot be confirmed twice', function (): void {
    [$user, , $payment] = paymentConfirmationFixture();
    $action = app(ConfirmPayment::class);
    $action->execute($payment, (int) $user->id);

    expect(fn () => $action->execute($payment->fresh(), (int) $user->id))
        ->toThrow(DomainException::class);
});
