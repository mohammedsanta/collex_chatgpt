<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateInstallmentCompany
{
    public function execute(array $data): InstallmentCompany
    {
        try {
            return DB::transaction(function () use ($data): InstallmentCompany {
                return InstallmentCompany::create([
                    'name' => $data['name'],
                    'code' => $data['code'],
                    'logo_path' => $data['logo_path'] ?? null,
                    'sector' => $data['sector'] ?? null,
                    'is_active' => $data['is_active'] ?? true,
                    'notes' => $data['notes'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create installment company.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}