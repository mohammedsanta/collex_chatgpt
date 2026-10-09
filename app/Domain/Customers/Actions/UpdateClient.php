<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateClient
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(
        Client $client,
        array $data,
    ): Client {
        try {
            return DB::transaction(function () use (
                $client,
                $data,
            ): Client {
                $client = Client::query()
                    ->lockForUpdate()
                    ->findOrFail($client->getKey());

                $allowedFields = [
                    'name',
                    'national_id',
                    'email',
                    'governorate_id',
                    'address',
                    'employer_name',
                    'job_title',
                    'work_address',
                    'notes',
                ];

                $updates = array_intersect_key(
                    $data,
                    array_flip($allowedFields)
                );

                $client->update($updates);

                return $client->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update client.', [
                'action' => self::class,
                'client_id' => $client->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}