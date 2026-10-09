<?php

declare(strict_types=1);

test('login page is available to guests', function (): void {
    $this->get('/login')->assertOk()->assertSee('Collex')->assertSee('تسجيل الدخول');
});

test('authenticated users are redirected away from the login page', function (): void {
    $role = \App\Domain\Employees\Models\Role::query()->create([
        'name' => 'test-role', 'label' => 'Test role', 'is_system' => false, 'level' => 1,
    ]);
    $user = \App\Domain\Employees\Models\User::factory()->create(['role_id' => $role->id]);
    $this->actingAs($user)->get('/login')->assertRedirect('/dashboard');
});
