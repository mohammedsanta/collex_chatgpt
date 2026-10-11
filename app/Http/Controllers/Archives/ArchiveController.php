<?php

declare(strict_types=1);

namespace App\Http\Controllers\Archives;

use App\Domain\Archives\Models\MonthlyArchive;
use App\Domain\Archives\Queries\GetArchives;
use App\Domain\Reports\Models\MonthlyArchive as ModelsMonthlyArchive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class ArchiveController extends Controller
{
    public function index(Request $request, GetArchives $getArchives): View
    {
        $this->authorize('viewAny', ModelsMonthlyArchive::class);

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:150'],
            'bank_id' => ['nullable', 'integer', 'min:1'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'month' => ['nullable', 'integer', 'between:1,12'],
        ]);

        return view('archives.index', [
            'archives' => $getArchives->execute($filters),
            'filters' => $filters,
        ]);
    }
}
