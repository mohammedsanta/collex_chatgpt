<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetActiveBanks
{
    public function execute(): Builder
    {
        return Bank::query()
            ->where('is_active', true)
            ->orderBy('name');
    }
}