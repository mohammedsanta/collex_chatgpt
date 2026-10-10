<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;

final class ShowClientDetails
{
    public function execute(Client $client): Client
    {
        return $client->load([
            'governorate',
            'phones',
            'debtCases',
        ]);
    }
}