<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Queries\GetActivityLogsByEvent;
use App\Domain\Reports\Queries\GetActivityLogsByUser;
use App\Domain\Reports\Queries\GetActivityLogsForSubject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class ActivityLogController extends Controller
{
    public function byUser(Request $request, GetActivityLogsByUser $query)
    {
        return $query->execute(
            (int) $request->integer('user_id')
        );
    }

    public function byEvent(Request $request, GetActivityLogsByEvent $query)
    {
        return $query->execute(
            (string) $request->string('event')
        );
    }

    public function forSubject(
        Request $request,
        GetActivityLogsForSubject $query
    ) {
        return $query->execute(
            (string) $request->string('subject_type'),
            (int) $request->integer('subject_id')
        );
    }
}