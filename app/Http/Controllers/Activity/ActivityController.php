<?php

declare(strict_types=1);

namespace App\Http\Controllers\Activity;

use App\Domain\Activity\Models\Activity;
use App\Domain\Activity\Queries\GetActivities;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\FilterActivityRequest;
use Illuminate\Contracts\View\View;

final class ActivityController extends Controller
{
    public function index(
        FilterActivityRequest $request,
        GetActivities $getActivities
    ): View {
        $filters = $request->validated();

        $activities = $getActivities->execute($filters);

        $stats = [
            'total' => Activity::query()->count(),

            'today' => Activity::query()
                ->today()
                ->count(),

            'users_today' => Activity::query()
                ->today()
                ->whereNotNull('user_id')
                ->distinct()
                ->count('user_id'),
        ];

        $actions = Activity::query()
            ->whereNotNull('event')
            ->where('event', '!=', '')
            ->distinct()
            ->orderBy('event')
            ->pluck('event')
            ->map(fn (string $event): array => [
                'value' => $event,
                'label' => $this->eventLabel($event),
            ])
            ->values();

        return view('activity.index', [
            'activities' => $activities,
            'stats' => $stats,
            'actions' => $actions,
            'filters' => $filters,
        ]);
    }

    private function eventLabel(string $event): string
    {
        return match (strtolower($event)) {
            'created' => 'إنشاء',
            'updated' => 'تعديل',
            'deleted' => 'حذف',
            'login' => 'تسجيل دخول',
            'logout' => 'تسجيل خروج',
            'failed_login' => 'محاولة دخول فاشلة',
            default => $event,
        };
    }
}