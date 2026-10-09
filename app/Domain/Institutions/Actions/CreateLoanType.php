<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateLoanType
{
    public function execute(array $data): LoanType
    {
        try {
            return DB::transaction(function () use ($data): LoanType {
                return LoanType::create([
                    'name' => $data['name'],
                    'is_active' => $data['is_active'] ?? true,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create loan type.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}