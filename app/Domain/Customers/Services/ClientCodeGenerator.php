<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Client;

final class ClientCodeGenerator
{
    public function generate(): string
    {
        $nextId = ((int) Client::withTrashed()->max('id')) + 1;

        return (string) (((int) config('collex.client_code_start', 1000000)) - 1 + $nextId);
    }
}