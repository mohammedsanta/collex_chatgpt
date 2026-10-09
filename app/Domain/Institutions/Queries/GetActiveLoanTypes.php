<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveLoanTypes
{
    public function execute(): Builder
    {
        return LoanType::query()
            ->where('is_active', true)
            ->orderBy('name');
    }
}