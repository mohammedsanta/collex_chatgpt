<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveLoanTypesByName
{
    public function execute(string $name): Builder
    {
        return LoanType::query()
            ->where('is_active', true)
            ->where('name', 'like', '%' . $name . '%')
            ->orderBy('name');
    }
}