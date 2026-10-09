<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Payment> */
final class PaymentFactory extends Factory
{
    protected $model = Payment::class;
    public function definition(): array { return ['receipt_number' => 'PAY-'.strtoupper((string) Str::ulid()), 'debt_case_id' => DebtCase::factory(), 'collector_id' => null, 'promise_id' => null, 'amount' => fake()->randomFloat(2, 1, 5000), 'method' => fake()->randomElement(['cash','e_wallet','bank_transfer','card','cheque']), 'reference' => null, 'proof_path' => null, 'paid_at' => now(), 'status' => 'pending', 'confirmed_by' => null, 'confirmed_at' => null, 'rejection_reason' => null, 'notes' => null]; }
}
