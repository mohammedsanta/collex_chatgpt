<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

final class CreatePortfolio
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): Portfolio
    {
        $exists = Portfolio::query()
            ->where('bank_id', $data['bank_id'])
            ->where('period_year', $data['period_year'])
            ->where('period_month', $data['period_month'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'period_month' => 'يوجد Portfolio لهذا البنك في نفس الشهر والسنة بالفعل.',
            ]);
        }

        return DB::transaction(function () use ($data): Portfolio {
            return Portfolio::create([
                'bank_id' => $data['bank_id'],
                'name' => $data['name'],
                'period_year' => $data['period_year'],
                'period_month' => $data['period_month'],
                'status' => $data['status'] ?? 'draft',
                'cases_count' => 0,
                'total_debt' => 0,
                'created_by' => $data['created_by'] ?? null,
                'activated_at' => null,
                'archived_at' => null,
                'archived_by' => null,
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }
}