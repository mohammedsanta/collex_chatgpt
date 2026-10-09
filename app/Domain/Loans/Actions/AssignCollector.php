<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Collections\Actions\AssignCollector as AssignCollectorAction;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Collections\Models\CaseAssignment;

final class AssignCollector
{
    public function __construct(private readonly AssignCollectorAction $assigner) {}

    /** @param array{user_id: int|string, reason?: string|null} $data */
    public function execute(DebtCase $debtCase, array $data, int $assignedBy): CaseAssignment
    {
        return $this->assigner->execute($debtCase, (int) $data['user_id'], $assignedBy, $data['reason'] ?? null);
    }
}
