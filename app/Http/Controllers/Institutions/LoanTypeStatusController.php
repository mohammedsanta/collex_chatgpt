<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\ActivateLoanType;
use App\Domain\Institutions\Actions\DeactivateLoanType;
use App\Domain\Institutions\Models\LoanType;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class LoanTypeStatusController extends Controller
{
    public function activate(
        Request $request,
        LoanType $loanType,
        ActivateLoanType $action
    ): RedirectResponse|LoanType {
        $this->authorize('activate', $loanType);

        $updated = $action->execute($loanType);

        if ($request->expectsJson()) {
            return $updated;
        }

        return redirect()
            ->route('loan-types.index')
            ->with('status', 'تم تفعيل نوع القرض بنجاح.');
    }

    public function deactivate(
        Request $request,
        LoanType $loanType,
        DeactivateLoanType $action
    ): RedirectResponse|LoanType {
        $this->authorize('deactivate', $loanType);

        $updated = $action->execute($loanType);

        if ($request->expectsJson()) {
            return $updated;
        }

        return redirect()
            ->route('loan-types.index')
            ->with('status', 'تم تعطيل نوع القرض بنجاح.');
    }
}