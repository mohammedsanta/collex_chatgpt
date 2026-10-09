<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateCustomer
{
    /**
     * Create a new customer atomically.
     *
     * @param array<string, mixed> $data
     */
    public function execute(array $data): Customer
    {
        try {
            return DB::transaction(function () use ($data): Customer {
                return Customer::create($data);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create customer.', [
                'exception' => $e,
                'data' => $data,
            ]);

            throw $e;
        }
    }
}