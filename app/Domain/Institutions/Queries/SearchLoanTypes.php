<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Eloquent\Builder;

final class SearchLoanTypes
{
    public function execute(string $term): Builder
    {
        return LoanType::query()
            ->where('name', 'like', '%' . $term . '%')
            ->orderBy('name');
    }
}