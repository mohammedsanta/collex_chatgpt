<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Services\ClientCodeGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateClient
{
    public function __construct(private readonly ClientCodeGenerator $codeGenerator) {}

    /** @param array<string, mixed> $data */
    public function execute(array $data): Client
    {
        try {
            return DB::transaction(function () use ($data): Client {
                $attributes = array_intersect_key($data, array_flip([
                    'national_id', 'name', 'email', 'governorate_id', 'address',
                    'employer_name', 'job_title', 'work_address', 'notes',
                ]));
                $attributes['code'] = $this->codeGenerator->generate();
                return Client::query()->create($attributes);
            });
        } catch (Throwable $exception) {
            Log::error('Failed to create client.', ['national_id' => $data['national_id'] ?? null, 'exception' => $exception]);
            throw $exception;
        }
    }
}
