<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Actions\CreatePortfolioImport;
use App\Domain\Loans\Actions\ProcessPortfolioImport;
use App\Domain\Loans\Models\PortfolioImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreatePortfolioImportRequest;
use Illuminate\Http\Request;

final class PortfolioImportController extends Controller
{
    public function store(
        Request $httpRequest,
        CreatePortfolioImportRequest $request,
        CreatePortfolioImport $action
    ): PortfolioImport {
        return $action->execute($request->validated(), (int) $httpRequest->user()->getAuthIdentifier());
    }

    public function process(
        PortfolioImport $import,
        ProcessPortfolioImport $action
    ): PortfolioImport {
        return $action->execute($import);
    }
}