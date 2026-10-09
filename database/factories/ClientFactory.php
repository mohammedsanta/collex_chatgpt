<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Client> */
final class ClientFactory extends Factory
{
    protected $model = Client::class;
    public function definition(): array { return ['code' => (string) fake()->unique()->numberBetween(1000000,9999999), 'national_id' => (string) fake()->unique()->numerify('##############'), 'name' => fake()->name(), 'email' => fake()->safeEmail(), 'governorate_id' => null, 'address' => fake()->optional()->address(), 'employer_name' => fake()->optional()->company(), 'job_title' => fake()->optional()->jobTitle(), 'work_address' => fake()->optional()->address(), 'notes' => null]; }
}
