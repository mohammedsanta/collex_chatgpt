<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetBanksWithLogo
{
    public function execute(): Builder
    {
        return Bank::query()
            ->whereNotNull('logo_path')
            ->orderBy('name');
    }
}