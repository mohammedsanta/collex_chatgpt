<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateClientPhone
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(
        ClientPhone $clientPhone,
        array $data,
    ): ClientPhone {
        try {
            return DB::transaction(function () use (
                $clientPhone,
                $data,
            ): ClientPhone {
                $clientPhone = ClientPhone::query()
                    ->lockForUpdate()
                    ->findOrFail($clientPhone->getKey());

                $allowedFields = [
                    'phone',
                    'label',
                    'is_valid',
                ];

                $updates = array_intersect_key(
                    $data,
                    array_flip($allowedFields)
                );

                $clientPhone->update($updates);

                return $clientPhone->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update client phone.', [
                'action' => self::class,
                'client_phone_id' => $clientPhone->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}