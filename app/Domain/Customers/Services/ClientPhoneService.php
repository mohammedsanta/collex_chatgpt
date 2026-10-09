<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Models\ClientPhone;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ClientPhoneService
{
    public function add(
        Client $client,
        string $phone,
        string $label = 'primary',
        bool $isValid = true
    ): ClientPhone {
        try {
            return $client->phones()->create([
                'phone' => $phone,
                'label' => $label,
                'is_valid' => $isValid,
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to add client phone.', [
                'client_id' => $client->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function markInvalid(ClientPhone $phone): ClientPhone
    {
        $phone->update(['is_valid' => false]);

        return $phone->refresh();
    }
}