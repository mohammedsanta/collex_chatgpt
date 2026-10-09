@extends('layouts.app')

@section('title', 'صلاحيات المستخدم')
@section('content')
    <x-page-header
        title="صلاحيات المستخدم"
        subtitle="إدارة الصلاحيات الموروثة والاستثناءات الفردية للحساب."
        eyebrow="إدارة المستخدمين / الصلاحيات"
        icon="fa-shield-halved"
    >
        <x-slot:actions>
            <a href="{{ route('users.show', $user) }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للمستخدم
            </a>
        </x-slot:actions>
    </x-page-header>

    @if ($user->is_system_account)
        <div class="mb-5 rounded-xl border border-orange-500/20 bg-orange-500/5 p-4 text-xs text-orange-400">
            <i class="fa-solid fa-shield-halved ml-2"></i>
            هذا حساب نظام. لا يمكن تعديل صلاحياته من هذه الصفحة.
        </div>
    @endif

    @if (session('success'))
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 p-4 text-xs text-red-400">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="mb-5">
        <x-panel title="ملخص الحساب" icon="fa-user-shield">

            <div class="grid gap-4 sm:grid-cols-3">

                <div>
                    <p class="text-[10px] text-dim">المستخدم</p>
                    <p class="mt-1 text-xs font-extrabold">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-dim">الدور الحالي</p>
                    <p class="mt-1 text-xs font-extrabold">
                        {{ $user->role?->label ?? $user->role?->name ?? 'بدون دور' }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] text-dim">عدد الصلاحيات المتاحة بالنظام</p>
                    <p class="mt-1 text-xs font-extrabold">
                        {{ $permissions->flatten()->count() }}
                    </p>
                </div>

            </div>

        </x-panel>
    </div>

    <form
        method="POST"
        action="{{ route('users.permissions.update', $user) }}"
    >
        @csrf
        @method('PUT')

        @foreach ($permissions as $group => $groupPermissions)
            <div class="mb-5">
                <x-panel
                    :title="$group"
                    icon="fa-key"
                >

                    <div class="space-y-3">

                        @foreach ($groupPermissions as $permission)
                            @php
                                $override = $user->permissions->firstWhere('id', $permission->id);

                                $setting = $override === null
                                    ? 'inherit'
                                    : ((bool) $override->pivot->granted ? 'granted' : 'revoked');

                                $roleHasPermission = $user->role
                                    ? $user->role->permissions->contains('id', $permission->id)
                                    : false;
                            @endphp

                            <div class="grid gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-3 md:grid-cols-[minmax(0,1fr)_220px] md:items-center">

                                <div>
                                    <p class="text-xs font-bold">
                                        {{ $permission->label }}
                                    </p>

                                    <p class="mt-1 break-all text-[10px] text-dim">
                                        {{ $permission->name }}
                                    </p>

                                    <p class="mt-1 text-[10px] text-dim">
                                        صلاحية الدور:
                                        @if ($roleHasPermission)
                                            <span class="text-brand">ممنوحة</span>
                                        @else
                                            <span>غير ممنوحة</span>
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <label
                                        for="permission_{{ $permission->id }}"
                                        class="mb-1 block text-[10px] text-dim"
                                    >
                                        الاستثناء الشخصي
                                    </label>

                                    <select
                                        id="permission_{{ $permission->id }}"
                                        name="permissions[{{ $permission->id }}]"
                                        class="app-input w-full"
                                        @disabled($user->is_system_account)
                                    >
                                        <option
                                            value="inherit"
                                            @selected(old("permissions.{$permission->id}", $setting) === 'inherit')
                                        >
                                            استخدام صلاحية الدور
                                        </option>

                                        <option
                                            value="granted"
                                            @selected(old("permissions.{$permission->id}", $setting) === 'granted')
                                        >
                                            منح الصلاحية لهذا المستخدم
                                        </option>

                                        <option
                                            value="revoked"
                                            @selected(old("permissions.{$permission->id}", $setting) === 'revoked')
                                        >
                                            منع الصلاحية لهذا المستخدم
                                        </option>
                                    </select>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </x-panel>
            </div>
        @endforeach

        @unless ($user->is_system_account)
            <div class="flex flex-wrap justify-end gap-3">
                <a href="{{ route('users.show', $user) }}" class="app-btn app-btn-secondary">
                    إلغاء
                </a>

                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    حفظ الصلاحيات
                </button>
            </div>
        @endunless
    </form>

@endsection