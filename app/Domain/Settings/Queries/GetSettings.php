<?php

declare(strict_types=1);

namespace App\Domain\Settings\Queries;

use App\Domain\Settings\Models\Setting;
use Illuminate\Database\Eloquent\Builder;

final class GetSettings
{
    public function execute(?string $group = null): Builder
    {
        return Setting::query()->when($group !== null, fn (Builder $query) => $query->where('group', $group))->orderBy('group')->orderBy('key');
    }
}
