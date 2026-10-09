<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateGovernorate
{
    public function execute(
        Governorate $governorate,
        array $data
    ): Governorate {
        try {
            return DB::transaction(function () use (
                $governorate,
                $data
            ): Governorate {
                $governorate = Governorate::query()
                    ->lockForUpdate()
                    ->findOrFail($governorate->getKey());

                $updates = array_intersect_key(
                    $data,
                    array_flip([
                        'name',
                        'name_en',
                    ])
                );

                $governorate->update($updates);

                return $governorate->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update governorate.', [
                'action' => self::class,
                'governorate_id' => $governorate->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}