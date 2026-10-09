<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\Reports\Queries\GetDashboardStatistics;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class DashboardController extends Controller
{
    public function __invoke(
        GetDashboardStatistics $getDashboardStatistics
    ): View {
        return view(
            'dashboard.index',
            $getDashboardStatistics->execute()
        );
    }
}