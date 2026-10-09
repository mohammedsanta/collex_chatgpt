<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class SearchBanksBySector
{
    public function execute(string $sector, string $term): Builder
    {
        return Bank::query()
            ->where('sector', $sector)
            ->where('is_active', true)
            ->where('name', 'like', '%' . $term . '%')
            ->orderBy('name');
    }
}