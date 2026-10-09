<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Complaint;

final class ComplaintReferenceGenerator
{
    public function generate(): string
    {
        $last = Complaint::query()
            ->orderByDesc('id')
            ->value('id');

        return 'CMP-' . str_pad(
            (string) (($last ?? 0) + 1),
            6,
            '0',
            STR_PAD_LEFT
        );
    }
}