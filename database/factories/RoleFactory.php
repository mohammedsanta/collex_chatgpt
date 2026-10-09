<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Employees\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Role> */
final class RoleFactory extends Factory
{
    protected $model = Role::class;
    public function definition(): array { return ['name' => fake()->unique()->slug(2), 'label' => fake()->jobTitle(), 'description' => fake()->optional()->sentence(), 'is_system' => false, 'level' => 10]; }
}
