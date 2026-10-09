<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AddClientPhone
{
    public function execute(int $clientId, array $data): ClientPhone
    {
        try {
            return DB::transaction(function () use ($clientId, $data): ClientPhone {
                return ClientPhone::create([
                    'client_id' => $clientId,
                    'phone' => $data['phone'],
                    'label' => $data['label'] ?? 'primary',
                    'is_valid' => $data['is_valid'] ?? true,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to add client phone.', [
                'action' => self::class,
                'client_id' => $clientId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}