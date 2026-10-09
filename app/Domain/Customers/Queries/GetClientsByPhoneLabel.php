<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByPhoneLabel
{
    public function execute(string $label): Builder
    {
        return Client::query()
            ->whereHas('phones', function (Builder $query) use ($label): void {
                $query->where('label', $label);
            })
            ->with([
                'phones' => function ($query) use ($label): void {
                    $query->where('label', $label);
                },
            ])
            ->orderBy('name');
    }
}