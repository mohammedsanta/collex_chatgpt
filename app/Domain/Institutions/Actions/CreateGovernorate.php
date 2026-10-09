<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateGovernorate
{
    public function execute(array $data): Governorate
    {
        try {
            return DB::transaction(function () use ($data): Governorate {
                return Governorate::create([
                    'name' => $data['name'],
                    'name_en' => $data['name_en'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create governorate.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}