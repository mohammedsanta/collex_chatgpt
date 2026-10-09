<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Domain\Notifications\Actions\DeleteNotification;
use App\Domain\Notifications\Actions\MarkNotificationAsRead;
use App\Domain\Notifications\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class NotificationController extends Controller
{
    public function read(
        Request $request,
        Notification $notification,
        MarkNotificationAsRead $action
    ): Notification {
        return $action->execute($notification, (int) $request->user()->getAuthIdentifier());
    }

    public function destroy(
        Request $request,
        Notification $notification,
        DeleteNotification $action
    ): void {
        $action->execute($notification, (int) $request->user()->getAuthIdentifier());
    }
}