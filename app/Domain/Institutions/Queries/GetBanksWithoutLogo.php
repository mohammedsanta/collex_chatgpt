<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Builder;

final class GetBanksWithoutLogo
{
    public function execute(): Builder
    {
        return Bank::query()
            ->whereNull('logo_path')
            ->orderBy('name');
    }
}