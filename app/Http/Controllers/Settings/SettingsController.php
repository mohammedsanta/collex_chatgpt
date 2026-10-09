<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Domain\Settings\Actions\UpdateSettings;
use App\Domain\Settings\Queries\GetSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateSettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class SettingsController extends Controller
{
    public function index(GetSettings $query): View
    {
        abort_unless(request()->user()?->hasPermission('settings.manage'), 403);
        return view('settings.index', ['settings' => $query->execute()->get()->groupBy('group')]);
    }

    public function update(UpdateSettingsRequest $request, UpdateSettings $action): RedirectResponse
    {
        $count = $action->execute($request->validated());
        return back()->with('status', "Updated {$count} setting(s).");
    }
}
