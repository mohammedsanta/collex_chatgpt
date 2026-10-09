<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CreateComplaint;
use App\Domain\Collections\Actions\DeleteComplaint;
use App\Domain\Collections\Actions\UpdateComplaint;
use App\Domain\Collections\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CreateComplaintRequest;
use App\Http\Requests\Collections\UpdateComplaintRequest;

final class ComplaintController extends Controller
{
    public function store(
        CreateComplaintRequest $request,
        CreateComplaint $action
    ): Complaint {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateComplaintRequest $request,
        Complaint $complaint,
        UpdateComplaint $action
    ): Complaint {
        return $action->execute($complaint, $request->validated());
    }

    public function destroy(
        Complaint $complaint,
        DeleteComplaint $action
    ): void {
        $action->execute($complaint);
    }
}