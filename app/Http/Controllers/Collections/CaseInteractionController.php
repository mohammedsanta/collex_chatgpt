<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CreateCaseInteraction;
use App\Domain\Collections\Actions\DeleteCaseInteraction;
use App\Domain\Collections\Actions\UpdateCaseInteraction;
use App\Domain\Collections\Models\CaseInteraction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CreateCaseInteractionRequest;
use App\Http\Requests\Collections\UpdateCaseInteractionRequest;

final class CaseInteractionController extends Controller
{
    public function store(
        CreateCaseInteractionRequest $request,
        CreateCaseInteraction $action
    ): CaseInteraction {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateCaseInteractionRequest $request,
        CaseInteraction $interaction,
        UpdateCaseInteraction $action
    ): CaseInteraction {
        return $action->execute($interaction, $request->validated());
    }

    public function destroy(
        CaseInteraction $interaction,
        DeleteCaseInteraction $action
    ): void {
        $action->execute($interaction);
    }
}