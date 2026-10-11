<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateGovernorate;
use App\Domain\Institutions\Actions\DeleteGovernorate;
use App\Domain\Institutions\Actions\UpdateGovernorate;
use App\Domain\Institutions\Models\Governorate;
use App\Domain\Institutions\Queries\ListGovernorates;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateGovernorateRequest;
use App\Http\Requests\Institutions\UpdateGovernorateRequest;
use Illuminate\Http\Request;

final class GovernorateController extends Controller
{

    /**
     * Display a paginated list of governorates.
     */
    public function index(
        Request $request,
        ListGovernorates $query
    ) {
        $search = trim((string) $request->query('search', ''));

        $governorates = $query->execute($search);

        return view('governorates.index', [
            'governorates' => $governorates,
            'search' => $search,
        ]);
    }
    
        /**
     * Show the form for creating a governorate.
     */
    public function create()
    {
        return view('governorates.create');
    }

        /**
     * Show the form for editing a governorate.
     */
    public function edit(
        Governorate $governorate
    ) {
        return view('governorates.edit', [
            'governorate' => $governorate,
        ]);
    }


    public function store(
        CreateGovernorateRequest $request,
        CreateGovernorate $action
    ): Governorate {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateGovernorateRequest $request,
        Governorate $governorate,
        UpdateGovernorate $action
    ): Governorate {
        return $action->execute($governorate, $request->validated());
    }

    public function destroy(
        Governorate $governorate,
        DeleteGovernorate $action
    ): void {
        $action->execute($governorate);
    }
}