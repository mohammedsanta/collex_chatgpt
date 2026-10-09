<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreClient
{
    public function execute(int $clientId): Client
    {
        try {
            return DB::transaction(function () use ($clientId): Client {
                $client = Client::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($clientId);

                if (! $client->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The client is not deleted.'
                    );
                }

                $client->restore();

                return $client->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore client.', [
                'action' => self::class,
                'client_id' => $clientId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}