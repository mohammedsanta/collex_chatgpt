<?php

declare(strict_types=1);

namespace App\Support;

use App\Domain\Institutions\Models\Bank;
use Illuminate\Support\Collection;

final class StaticBanks
{
    /** @return Collection<int, Bank> */
    public static function active(): Collection { return Bank::query()->where('is_active', true)->orderBy('name')->get(); }
    private function __construct() {}
}
