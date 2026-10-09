<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\LoanType;
use Illuminate\Database\Eloquent\Builder;

final class GetLoanTypes
{
    public function execute(): Builder
    {
        return LoanType::query()
            ->orderBy('name');
    }
}