<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Actions\CompletePortfolioImport;
use App\Domain\Loans\Actions\FailPortfolioImport;
use App\Domain\Loans\Actions\UpdatePortfolioImportProgress;
use App\Domain\Loans\Models\PortfolioImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class PortfolioImportProgressController extends Controller
{
    public function update(
        Request $request,
        PortfolioImport $import,
        UpdatePortfolioImportProgress $action
    ): PortfolioImport {
                $data = $request->validate([
            'total_rows' => ['required', 'integer', 'min:0'],
            'success_rows' => ['required', 'integer', 'min:0'],
            'failed_rows' => ['required', 'integer', 'min:0'],
        ]);
        return $action->execute($import, (int) $data['total_rows'], (int) $data['success_rows'], (int) $data['failed_rows']);
    }

    public function complete(
        PortfolioImport $import,
        CompletePortfolioImport $action
    ): PortfolioImport {
        return $action->execute($import);
    }

    public function fail(
        Request $request,
        PortfolioImport $import,
        FailPortfolioImport $action
    ): PortfolioImport {
        return $action->execute(
            $import,
            $request->validate(['error' => ['nullable', 'string']])
        );
    }
}