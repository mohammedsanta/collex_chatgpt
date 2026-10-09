<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\ActivateBank;
use App\Domain\Institutions\Actions\DeactivateBank;
use App\Domain\Institutions\Models\Bank;
use App\Http\Controllers\Controller;

final class BankStatusController extends Controller
{
    public function activate(Bank $bank, ActivateBank $action): Bank
    {
        return $action->execute($bank);
    }

    public function deactivate(Bank $bank, DeactivateBank $action): Bank
    {
        return $action->execute($bank);
    }
}