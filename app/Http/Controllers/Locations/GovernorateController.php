<?php

declare(strict_types=1);

namespace App\Http\Controllers\Locations;

use App\Domain\Institutions\Actions\CreateGovernorate;
use App\Domain\Institutions\Actions\DeleteGovernorate;
use App\Domain\Institutions\Actions\UpdateGovernorate;
use App\Domain\Institutions\Models\Governorate;
use App\Domain\Institutions\Queries\ListGovernorates;
use App\Http\Controllers\Controller;
use App\Http\Requests\Governorates\StoreGovernorateRequest;
use App\Http\Requests\Governorates\UpdateGovernorateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class GovernorateController extends Controller
{
    public function index(
        Request $request,
        ListGovernorates $query
    ): View {
        $search = trim((string) $request->query('search', ''));

        $governorates = $query->execute($search);

        return view('governorates.index', compact(
            'governorates',
            'search'
        ));
    }

    public function create(): View
    {
        return view('governorates.create');
    }

    public function store(
        StoreGovernorateRequest $request,
        CreateGovernorate $action
    ): RedirectResponse {
        $action->execute($request->validated());

        return redirect()
            ->route('governorates.index')
            ->with('success', 'تمت إضافة المحافظة بنجاح.');
    }

    public function edit(Governorate $governorate): View
    {
        dd($governorate);
        return view('governorates.edit', compact('governorate'));
    }

    public function update(
        UpdateGovernorateRequest $request,
        Governorate $governorate,
        UpdateGovernorate $action
    ): RedirectResponse {
        $action->execute(
            $governorate,
            $request->validated()
        );

        return redirect()
            ->route('governorates.index')
            ->with('success', 'تم تحديث المحافظة بنجاح.');
    }

    public function destroy(
        Governorate $governorate,
        DeleteGovernorate $action
    ): RedirectResponse {
        $action->execute($governorate);

        return redirect()
            ->route('governorates.index')
            ->with('success', 'تم حذف المحافظة بنجاح.');
    }
}
