<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\Complaint;

final class ComplaintStatusResolver
{
    public function canResolve(Complaint $complaint): bool
    {
        return in_array(
            $complaint->status,
            ['open', 'in_review'],
            true
        );
    }

    public function canClose(Complaint $complaint): bool
    {
        return in_array(
            $complaint->status,
            ['resolved', 'rejected'],
            true
        );
    }
}