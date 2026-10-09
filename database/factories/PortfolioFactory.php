<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Portfolio> */
final class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;
    public function definition(): array { return ['bank_id' => Bank::factory(), 'name' => fake()->monthName().' portfolio', 'period_year' => (int) date('Y'), 'period_month' => (int) date('n'), 'status' => 'draft', 'cases_count' => 0, 'total_debt' => '0.00', 'created_by' => null, 'activated_at' => null, 'archived_at' => null, 'archived_by' => null, 'notes' => null]; }
}
