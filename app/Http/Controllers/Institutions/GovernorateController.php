<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Actions\CreateGovernorate;
use App\Domain\Institutions\Actions\DeleteGovernorate;
use App\Domain\Institutions\Actions\UpdateGovernorate;
use App\Domain\Institutions\Models\Governorate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Institutions\CreateGovernorateRequest;
use App\Http\Requests\Institutions\UpdateGovernorateRequest;

final class GovernorateController extends Controller
{
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