<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

final class CreateComplaint
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): Complaint
    {
        try {
            return DB::transaction(function () use ($data): Complaint {
                return Complaint::create([
                    'reference_number' => $this->generateReferenceNumber(),
                    'bank_id' => $data['bank_id'],
                    'debt_case_id' => $data['debt_case_id'] ?? null,
                    'client_id' => $data['client_id'] ?? null,
                    'logged_by' => $data['logged_by'] ?? null,
                    'assigned_to' => $data['assigned_to'] ?? null,
                    'subject' => $data['subject'],
                    'description' => $data['description'],
                    'source' => $data['source'] ?? null,
                    'priority' => $data['priority'] ?? 'medium',
                    'status' => 'open',
                    'due_at' => $data['due_at'] ?? null,
                    'resolution' => null,
                    'resolved_by' => null,
                    'resolved_at' => null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create complaint.', [
                'action' => self::class,
                'bank_id' => $data['bank_id'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    private function generateReferenceNumber(): string
    {
        do {
            $referenceNumber = 'CMP-' . str_pad(
                (string) random_int(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            );
        } while (
            Complaint::query()
                ->withTrashed()
                ->where('reference_number', $referenceNumber)
                ->exists()
        );

        return $referenceNumber;
    }
}