<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Actions;

use App\Domain\Institutions\Models\Governorate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteGovernorate
{
    public function execute(Governorate $governorate): void
    {
        try {
            DB::transaction(function () use ($governorate): void {
                $governorate = Governorate::query()
                    ->lockForUpdate()
                    ->findOrFail($governorate->getKey());

                if ($governorate->clients()->exists()) {
                    throw new \App\Exceptions\DomainException(
                        'A governorate assigned to clients cannot be deleted.'
                    );
                }

                $governorate->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete governorate.', [
                'action' => self::class,
                'governorate_id' => $governorate->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}