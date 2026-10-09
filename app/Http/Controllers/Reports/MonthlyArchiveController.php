<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\CreateMonthlyArchive;
use App\Domain\Reports\Actions\UpdateMonthlyArchive;
use App\Domain\Reports\Models\MonthlyArchive;
use App\Http\Controllers\Controller;

final class MonthlyArchiveController extends Controller
{
    public function store(CreateMonthlyArchive $action): MonthlyArchive
    {
        return $action->execute(request()->validate([
            'bank_id' => ['required', 'integer', 'exists:banks,id'],
            'portfolio_id' => ['nullable', 'integer', 'exists:portfolios,id'],
            'year' => ['required', 'integer'],
            'month' => ['required', 'integer', 'between:1,12'],
        ]));
    }

    public function update(
        MonthlyArchive $archive,
        UpdateMonthlyArchive $action
    ): MonthlyArchive {
        return $action->execute($archive, request()->all());
    }
}