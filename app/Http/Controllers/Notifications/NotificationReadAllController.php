<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Domain\Notifications\Actions\MarkAllNotificationsAsRead;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class NotificationReadAllController extends Controller
{
    public function __invoke(Request $request, MarkAllNotificationsAsRead $action): RedirectResponse
    {
        $action->execute((int) $request->user()->getAuthIdentifier());
        return back()->with('status', 'Notifications marked as read.');
    }
}
