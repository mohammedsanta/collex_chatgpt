<?php

declare(strict_types=1);

namespace App\Support\Data;

final readonly class UserData
{
    public function __construct(
        public string $employeeCode,
        public string $name,
        public string $email,
        public ?string $phone = null,
        public ?int $roleId = null,
        public ?int $supervisorId = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'employee_code' => $this->employeeCode,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role_id' => $this->roleId,
            'supervisor_id' => $this->supervisorId,
        ];
    }
}