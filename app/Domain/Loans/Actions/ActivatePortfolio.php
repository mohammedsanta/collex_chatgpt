<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class ActivatePortfolio
{
    public function execute(Portfolio $portfolio): Portfolio
    {
        return DB::transaction(function () use ($portfolio) {
            $portfolio = Portfolio::query()
                ->whereKey($portfolio->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($portfolio->status !== 'draft') {
                throw ValidationException::withMessages([
                    'portfolio' => 'لا يمكن تفعيل المحفظة إلا إذا كانت مسودة.',
                ]);
            }

            $portfolio->status = 'active';
            $portfolio->activated_at = now();
            $portfolio->save();

            return $portfolio;
        });
    }
}
