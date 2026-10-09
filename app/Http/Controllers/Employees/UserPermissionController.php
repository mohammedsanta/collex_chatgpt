<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\GrantPermissionToUser;
use App\Domain\Employees\Actions\RevokePermissionFromUser;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\GrantPermissionToUserRequest;

final class UserPermissionController extends Controller
{
    public function grant(
        GrantPermissionToUserRequest $request,
        User $user,
        GrantPermissionToUser $action
    ): void {
        $action->execute($user, $request->validated());
    }

    public function revoke(
        GrantPermissionToUserRequest $request,
        User $user,
        RevokePermissionFromUser $action
    ): void {
        $action->execute($user, $request->validated());
    }

    // 

    public function update(Request $request, User $user):
    {
        abort_if($user->is_system_account, 403, 'لا يمكن تعديل صلاحيات حساب النظام.');

        $validated = $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [
                'required',
                Rule::in(['inherit', 'granted', 'revoked']),
            ],
        ]);

        $settings = $validated['permissions'] ?? [];

        $permissionIds = array_map('intval', array_keys($settings));

        $existingIds = Permission::query()
            ->whereIn('id', $permissionIds)
            ->pluck('id')
            ->map(static fn ($id): int => (int) $id)
            ->all();

        abort_if(
            count($existingIds) !== count(array_unique($permissionIds)),
            422,
            'تتضمن البيانات صلاحية غير موجودة.'
        );

        DB::transaction(function () use ($user, $settings): void {
            foreach ($settings as $permissionId => $setting) {
                $permissionId = (int) $permissionId;

                if ($setting === 'inherit') {
                    DB::table('permission_user')
                        ->where('user_id', $user->id)
                        ->where('permission_id', $permissionId)
                        ->delete();

                    continue;
                }

                DB::table('permission_user')->updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'permission_id' => $permissionId,
                    ],
                    [
                        'granted' => $setting === 'granted',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        });

        return redirect()
            ->route('users.permissions', $user)
            ->with('success', 'تم حفظ صلاحيات المستخدم بنجاح.');
    }
}