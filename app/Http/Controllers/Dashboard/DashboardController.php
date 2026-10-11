<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\Dashboard\Queries\GetDashboardOverview;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class DashboardController extends Controller
{
    public function __invoke(GetDashboardOverview $query): View
    {
        return view('dashboard.index', $query->handle());
    }
}
