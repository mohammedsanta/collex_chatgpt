<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\AssignComplaint;
use App\Domain\Collections\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\AssignComplaintRequest;

final class ComplaintAssignmentController extends Controller
{
    public function __invoke(
        AssignComplaintRequest $request,
        Complaint $complaint,
        AssignComplaint $action
    ): Complaint {
        return $action->execute($complaint, $request->validated());
    }
}