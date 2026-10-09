<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Customers\Models\Client;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<DebtCase> */
final class DebtCaseFactory extends Factory
{
    protected $model = DebtCase::class;
    public function definition(): array { $portfolio = Portfolio::factory(); return ['portfolio_id' => $portfolio, 'bank_id' => Bank::factory(), 'client_id' => Client::factory(), 'loan_type_id' => null, 'assigned_user_id' => null, 'loan_number' => fake()->unique()->bothify('LN-########'), 'status' => 'active', 'total_debt' => fake()->randomFloat(2,100,100000), 'overdue_amount' => '0.00', 'installment_value' => null, 'min_installment_diff' => null, 'late_fee' => '0.00', 'collected_amount' => '0.00', 'bucket' => null, 'dpd' => 0, 'next_due_date' => null, 'loan_start_date' => null, 'loan_end_date' => null, 'last_payment_date' => null, 'last_payment_amount' => null, 'is_processed' => false, 'processed_at' => null]; }
}
