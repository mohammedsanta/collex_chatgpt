<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Employees\Models\Role;
use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/** @extends Factory<User> */
final class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array { return ['employee_code' => fake()->unique()->bothify('EMP-#####'), 'name' => fake()->name(), 'email' => fake()->unique()->safeEmail(), 'phone' => null, 'email_verified_at' => now(), 'password' => Hash::make('password'), 'role_id' => Role::factory(), 'supervisor_id' => null, 'status' => 'active', 'is_system_account' => false, 'avatar_path' => null, 'last_login_at' => null, 'last_login_ip' => null, 'remember_token' => Str::random(10)]; }
}
