
@extends('layouts.app')

@section('title', 'تعديل الدور - Collex')

@section('content')
<div class="space-y-6" dir="rtl">

    <x-page-header
        title="تعديل الدور"
        :subtitle="'إدارة بيانات وصلاحيات: ' . $role->label"
    >
        <x-slot:actions>
            <a href="{{ route('roles.index') }}" class="app-btn">
                <i class="fa-solid fa-arrow-right ml-2"></i>
                العودة للأدوار
            </a>
        </x-slot:actions>
    </x-page-header>

    <x-flash />

    <x-panel title="بيانات الدور">
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            @include('roles.partials.form')
        </form>
    </x-panel>

    <x-panel title="صلاحيات الدور">
        <p class="mb-5 text-sm text-slate-400">
            حدد الصلاحيات التي سيحصل عليها الموظفون الذين يحملون هذا الدور.
        </p>

        <form
            action="{{ route('roles.permissions.assign', $role) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            @forelse($permissions as $group => $groupPermissions)
                <div class="mb-6 rounded-xl border border-white/10 p-4">
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <h3 class="font-semibold text-white">
                            {{ $group }}
                        </h3>

                        <span class="text-xs text-slate-500">
                            {{ $groupPermissions->count() }} صلاحية
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($groupPermissions as $permission)
                            <label
                                for="permission-{{ $permission->id }}"
                                class="flex cursor-pointer items-start gap-3 rounded-lg border border-white/10 p-3 transition hover:border-emerald-500/30"
                            >
                                <input
                                    id="permission-{{ $permission->id }}"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->id }}"
                                    @checked(
                                        in_array(
                                            $permission->id,
                                            old(
                                                'permissions',
                                                $role->permissions->pluck('id')->all()
                                            )
                                        )
                                    )
                                    class="mt-1 accent-emerald-500"
                                >

                                <span class="min-w-0">
                                    <span class="block text-sm font-medium text-slate-200">
                                        {{ $permission->label }}
                                    </span>

                                    <code class="mt-1 block break-all text-xs text-slate-500">
                                        {{ $permission->name }}
                                    </code>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-white/10 p-8 text-center text-slate-400">
                    لا توجد صلاحيات مسجلة. أضف الصلاحيات أولاً.
                </div>
            @endforelse

            @error('permissions')
                <p class="mb-4 text-sm text-red-400">{{ $message }}</p>
            @enderror

            @error('permissions.*')
                <p class="mb-4 text-sm text-red-400">{{ $message }}</p>
            @enderror

            <div class="flex flex-wrap gap-3 border-t border-white/10 pt-5">
                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-shield-halved ml-2"></i>
                    حفظ الصلاحيات
                </button>

                <a href="{{ route('roles.index') }}" class="app-btn">
                    إلغاء
                </a>
            </div>
        </form>
    </x-panel>

</div>
@endsection
