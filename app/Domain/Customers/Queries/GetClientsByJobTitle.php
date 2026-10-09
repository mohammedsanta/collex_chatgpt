<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;

final class GetClientsByJobTitle
{
    public function execute(string $jobTitle): Builder
    {
        return Client::query()
            ->where('job_title', 'like', '%' . $jobTitle . '%')
            ->orderBy('name');
    }
}