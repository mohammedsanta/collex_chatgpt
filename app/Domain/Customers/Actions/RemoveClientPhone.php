<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RemoveClientPhone
{
    public function execute(ClientPhone $clientPhone): void
    {
        try {
            DB::transaction(function () use ($clientPhone): void {
                $clientPhone = ClientPhone::query()
                    ->lockForUpdate()
                    ->findOrFail($clientPhone->getKey());

                $clientPhone->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to remove client phone.', [
                'action' => self::class,
                'client_phone_id' => $clientPhone->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}