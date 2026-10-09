<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateBank
{
    public function execute(array $data): Bank
    {
        try {
            return DB::transaction(function () use ($data): Bank {
                return Bank::create([
                    'name' => $data['name'],
                    'code' => $data['code'],
                    'logo_path' => $data['logo_path'] ?? null,
                    'sector' => $data['sector'] ?? null,
                    'is_active' => $data['is_active'] ?? true,
                    'notes' => $data['notes'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create bank.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}