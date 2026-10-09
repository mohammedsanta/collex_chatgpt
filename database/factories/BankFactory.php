<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Bank> */
final class BankFactory extends Factory
{
    protected $model = Bank::class;
    public function definition(): array { return ['name' => fake()->unique()->company().' Bank', 'code' => strtoupper(fake()->unique()->bothify('BNK###')), 'logo_path' => null, 'sector' => 'private', 'is_active' => true, 'notes' => null]; }
}
