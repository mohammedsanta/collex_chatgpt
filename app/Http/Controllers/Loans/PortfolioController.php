<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Actions\ActivatePortfolio;
use App\Domain\Loans\Actions\ArchivePortfolio;
use App\Domain\Loans\Actions\CreatePortfolio;
use App\Domain\Loans\Actions\DeletePortfolio;
use App\Domain\Loans\Actions\RestorePortfolio;
use App\Domain\Loans\Actions\UpdatePortfolio;
use App\Domain\Loans\Models\Portfolio;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreatePortfolioRequest;
use App\Http\Requests\Loans\UpdatePortfolioRequest;
use Illuminate\Http\Request;

final class PortfolioController extends Controller
{
    public function store(CreatePortfolioRequest $request, CreatePortfolio $action): Portfolio
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdatePortfolioRequest $request,
        Portfolio $portfolio,
        UpdatePortfolio $action
    ): Portfolio {
        return $action->execute($portfolio, $request->validated());
    }

    public function activate(Portfolio $portfolio, ActivatePortfolio $action): Portfolio
    {
        return $action->execute($portfolio);
    }

    public function archive(Request $request, Portfolio $portfolio, ArchivePortfolio $action): Portfolio
    {
        $this->authorize('archive', $portfolio);
        return $action->execute($portfolio, (int) $request->user()->getAuthIdentifier());
    }

    public function destroy(Portfolio $portfolio, DeletePortfolio $action): void
    {
        $action->execute($portfolio);
    }

    public function restore(Portfolio $portfolio, RestorePortfolio $action): Portfolio
    {
        return $action->execute($portfolio);
    }
}