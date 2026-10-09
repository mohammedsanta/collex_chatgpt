<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Employees\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Permission> */
final class PermissionFactory extends Factory
{
    protected $model = Permission::class;
    public function definition(): array { $name = fake()->unique()->slug(2); return ['name' => str_replace('-', '.', $name), 'label' => fake()->sentence(3), 'group' => 'testing']; }
}
