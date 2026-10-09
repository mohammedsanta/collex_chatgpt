<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Queries;

use App\Domain\Institutions\Models\Bank;

final class FindBankByCode
{
    public function execute(string $code): ?Bank
    {
        return Bank::query()
            ->where('code', $code)
            ->first();
    }
}