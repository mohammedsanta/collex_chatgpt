<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collections;

use App\Domain\Collections\Actions\CloseComplaint;
use App\Domain\Collections\Actions\RejectComplaint;
use App\Domain\Collections\Actions\ResolveComplaint;
use App\Domain\Collections\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collections\CloseComplaintRequest;
use App\Http\Requests\Collections\RejectComplaintRequest;
use App\Http\Requests\Collections\ResolveComplaintRequest;

final class ComplaintResolutionController extends Controller
{
    public function resolve(
        ResolveComplaintRequest $request,
        Complaint $complaint,
        ResolveComplaint $action
    ): Complaint {
        return $action->execute($complaint, $request->validated());
    }

    public function reject(
        RejectComplaintRequest $request,
        Complaint $complaint,
        RejectComplaint $action
    ): Complaint {
        return $action->execute($complaint, $request->validated());
    }

    public function close(
        CloseComplaintRequest $request,
        Complaint $complaint,
        CloseComplaint $action
    ): Complaint {
        return $action->execute($complaint, $request->validated());
    }
}