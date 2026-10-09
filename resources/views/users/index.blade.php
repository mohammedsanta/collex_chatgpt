@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')

    <x-page-header
        title="إدارة المستخدمين"
        subtitle="إدارة حسابات الموظفين والأدوار والحالة الوظيفية."
        eyebrow="الموارد البشرية / المستخدمون"
        icon="fa-users"
    >
        <x-slot:actions>
            <a href="{{ route('roles.index') }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-shield-halved"></i>
                الأدوار والصلاحيات
            </a>

            <a href="{{ route('users.create') }}" class="app-btn app-btn-primary">
                <i class="fa-solid fa-user-plus"></i>
                إضافة مستخدم
            </a>
        </x-slot:actions>
    </x-page-header>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <i class="fa-solid fa-circle-check ml-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-xs font-bold text-red-400">
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Statistics --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <x-stat-card
            label="إجمالي المستخدمين"
            :value="number_format($stats['total'])"
            icon="fa-users"
            color="blue"
        />

        <x-stat-card
            label="حسابات نشطة"
            :value="number_format($stats['active'])"
            icon="fa-user-check"
            color="green"
        />

        <x-stat-card
            label="حسابات غير نشطة"
            :value="number_format($stats['inactive'])"
            icon="fa-user-clock"
            color="orange"
        />

        <x-stat-card
            label="حسابات موقوفة"
            :value="number_format($stats['suspended'])"
            icon="fa-user-lock"
            color="purple"
        />

    </div>

    {{-- Search and filters --}}
    <div class="mt-5">
        <x-panel title="البحث والتصفية" icon="fa-filter">

            <form method="GET" action="{{ route('users.index') }}">
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">

                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-[10px] font-bold text-dim">
                            البحث عن مستخدم
                        </label>

                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-dim"></i>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="الاسم، كود الموظف، البريد أو الهاتف"
                                class="app-input w-full pr-10"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="role_id" class="mb-2 block text-[10px] font-bold text-dim">
                            الدور الوظيفي
                        </label>

                        <select id="role_id" name="role_id" class="app-input w-full">
                            <option value="">كل الأدوار</option>

                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    @selected((string) request('role_id') === (string) $role->id)
                                >
                                    {{ $role->label ?: $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-[10px] font-bold text-dim">
                            حالة الحساب
                        </label>

                        <select id="status" name="status" class="app-input w-full">
                            <option value="">كل الحالات</option>
                            <option value="active" @selected(request('status') === 'active')>نشط</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>غير نشط</option>
                            <option value="suspended" @selected(request('status') === 'suspended')>موقوف</option>
                        </select>
                    </div>

                    <div>
                        <label for="account_type" class="mb-2 block text-[10px] font-bold text-dim">
                            نوع الحساب
                        </label>

                        <select id="account_type" name="account_type" class="app-input w-full">
                            <option value="">كل الحسابات</option>
                            <option value="employee" @selected(request('account_type') === 'employee')>
                                حساب موظف
                            </option>
                            <option value="system" @selected(request('account_type') === 'system')>
                                حساب نظام
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="fa-solid fa-filter"></i>
                        تطبيق الفلاتر
                    </button>

                    <a href="{{ route('users.index') }}" class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-left"></i>
                        إعادة ضبط
                    </a>
                </div>
            </form>

        </x-panel>
    </div>

    {{-- Users table --}}
    <div class="mt-5">
        <x-panel title="قائمة المستخدمين" icon="fa-users">

            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <p class="text-[11px] text-dim">
                    عدد النتائج في الصفحة:
                    <span class="font-extrabold text-white">{{ $users->count() }}</span>
                    من إجمالي
                    <span class="font-extrabold text-white">{{ $users->total() }}</span>
                </p>
            </div>

            <div class="table-wrap w-full max-w-full overflow-x-auto">
                <table class="data-table w-full min-w-[1100px]">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الموظف</th>
                            <th>الدور</th>
                            <th>المشرف</th>
                            <th>الجهات المرتبطة</th>
                            <th>الحالة</th>
                            <th>آخر دخول</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-dim">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-white/5">
                                            @if ($user->avatar_path)
                                                <img
                                                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar_path) }}"
                                                    alt="{{ $user->name }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                <span class="text-xs font-extrabold text-brand">
                                                    {{ mb_substr($user->name, 0, 1) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="min-w-0">
                                            <a
                                                href="{{ route('users.show', $user) }}"
                                                class="text-xs font-extrabold hover:text-brand"
                                            >
                                                {{ $user->name }}
                                            </a>

                                            <p class="mt-1 text-[10px] text-dim">
                                                كود: {{ $user->employee_code }}
                                            </p>

                                            <p class="mt-1 break-all text-[10px] text-dim">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-xs font-bold">
                                        {{ $user->role?->label ?? $user->role?->name ?? 'بدون دور' }}
                                    </span>

                                    @if ($user->is_system_account)
                                        <span class="mt-1 block text-[10px] font-bold text-orange-400">
                                            <i class="fa-solid fa-shield-halved ml-1"></i>
                                            حساب نظام
                                        </span>
                                    @endif
                                </td>

                                <td class="text-xs">
                                    {{ $user->supervisor?->name ?? '—' }}
                                </td>

                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="rounded-lg border border-blue-500/20 bg-blue-500/5 px-2 py-1 text-[10px] text-blue-400">
                                            {{ $user->banks->count() }} بنك
                                        </span>

                                        <span class="rounded-lg border border-cyan-500/20 bg-cyan-500/5 px-2 py-1 text-[10px] text-cyan-400">
                                            {{ $user->installmentCompanies->count() }} شركة
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    @php
                                        $statusClasses = match ($user->status) {
                                            'active' => 'border-brand/20 bg-brand/5 text-brand',
                                            'inactive' => 'border-orange-500/20 bg-orange-500/5 text-orange-400',
                                            'suspended' => 'border-red-500/20 bg-red-500/5 text-red-400',
                                            default => 'border-white/10 bg-white/5 text-dim',
                                        };

                                        $statusLabels = [
                                            'active' => 'نشط',
                                            'inactive' => 'غير نشط',
                                            'suspended' => 'موقوف',
                                        ];
                                    @endphp

                                    <span class="inline-flex rounded-lg border px-2.5 py-1 text-[10px] font-bold {{ $statusClasses }}">
                                        {{ $statusLabels[$user->status] ?? $user->status }}
                                    </span>
                                </td>

                                <td class="text-[10px] text-dim">
                                    {{ $user->last_login_at?->format('Y-m-d H:i') ?? 'لم يسجل الدخول' }}
                                </td>

                                <td>
                                    <div class="flex items-center gap-2">

                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="app-btn app-btn-secondary !px-3 !py-2"
                                            title="التفاصيل"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        @unless ($user->is_system_account)
                                            <a
                                                href="{{ route('users.edit', $user) }}"
                                                class="app-btn app-btn-secondary !px-3 !py-2"
                                                title="تعديل"
                                            >
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a
                                                href="{{ route('users.permissions', $user) }}"
                                                class="app-btn app-btn-secondary !px-3 !py-2"
                                                title="الصلاحيات"
                                            >
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="app-btn app-btn-secondary !px-3 !py-2 text-red-400"
                                                    title="حذف"
                                                >
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endunless

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <i class="fa-solid fa-users mb-3 text-3xl text-dim"></i>

                                        <p class="text-sm font-extrabold">
                                            لا يوجد مستخدمون مطابقون
                                        </p>

                                        <p class="mt-2 text-xs text-dim">
                                            جرّب تغيير كلمات البحث أو الفلاتر.
                                        </p>

                                        <a href="{{ route('users.create') }}" class="app-btn app-btn-primary mt-4">
                                            <i class="fa-solid fa-user-plus"></i>
                                            إضافة مستخدم جديد
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($users->hasPages())
                <div class="mt-5 border-t border-white/5 pt-4">
                    {{ $users->links() }}
                </div>
            @endif

        </x-panel>
    </div>

@endsection