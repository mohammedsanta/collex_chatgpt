<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteClient
{
    public function execute(Client $client): void
    {
        try {
            DB::transaction(function () use ($client): void {
                $client = Client::query()
                    ->lockForUpdate()
                    ->findOrFail($client->getKey());

                $client->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete client.', [
                'action' => self::class,
                'client_id' => $client->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}