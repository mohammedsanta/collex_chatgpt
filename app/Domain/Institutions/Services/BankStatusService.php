<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Services;

use App\Domain\Institutions\Models\Bank;

final class BankStatusService
{
    public function activate(Bank $bank): Bank
    {
        $bank->update(['is_active' => true]);

        return $bank->refresh();
    }

    public function deactivate(Bank $bank): Bank
    {
        $bank->update(['is_active' => false]);

        return $bank->refresh();
    }
}