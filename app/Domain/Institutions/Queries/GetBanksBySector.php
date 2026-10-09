<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetBanksBySector
{
    public function execute(string $sector): Builder
    {
        return Bank::query()
            ->where('sector', $sector)
            ->where('is_active', true)
            ->orderBy('name');
    }
}