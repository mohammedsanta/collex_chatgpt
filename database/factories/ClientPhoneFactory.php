<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ClientPhone> */
final class ClientPhoneFactory extends Factory
{
    protected $model = ClientPhone::class;
    public function definition(): array { return ['client_id' => Client::factory(), 'phone' => fake()->unique()->numerify('01#########'), 'label' => 'primary', 'is_valid' => true]; }
}
