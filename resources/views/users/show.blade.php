@extends('layouts.app')

@section('title', 'تفاصيل المستخدم')

@section('content')

    <x-page-header
        title="تفاصيل المستخدم"
        subtitle="معلومات الحساب والدور الوظيفي والارتباطات."
        eyebrow="إدارة المستخدمين / التفاصيل"
        icon="fa-id-card"
    >
        <x-slot:actions>
            <a href="{{ route('users.index') }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                المستخدمون
            </a>

            @unless ($user->is_system_account)
                <a href="{{ route('users.edit', $user) }}" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-pen"></i>
                    تعديل البيانات
                </a>
            @endunless
        </x-slot:actions>
    </x-page-header>

    @if (session('success'))
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <i class="fa-solid fa-circle-check ml-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- User identity --}}
    <div class="grid gap-4 xl:grid-cols-3">

        <div class="xl:col-span-2">
            <x-panel title="الملف الشخصي" icon="fa-user">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                        @if ($user->avatar_path)
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar_path) }}"
                                alt="{{ $user->name }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <span class="text-2xl font-extrabold text-brand">
                                {{ mb_substr($user->name, 0, 1) }}
                            </span>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="text-lg font-extrabold">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 text-xs text-dim">
                            {{ $user->employee_code }} · {{ $user->role?->label ?? $user->role?->name ?? 'بدون دور' }}
                        </p>

                        <p class="mt-2 break-all text-xs text-dim">
                            {{ $user->email }}
                        </p>

                        <div class="mt-3 flex flex-wrap gap-2">
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

                            <span class="rounded-lg border px-3 py-1 text-[10px] font-bold {{ $statusClasses }}">
                                {{ $statusLabels[$user->status] ?? $user->status }}
                            </span>

                            @if ($user->is_system_account)
                                <span class="rounded-lg border border-orange-500/20 bg-orange-500/5 px-3 py-1 text-[10px] font-bold text-orange-400">
                                    <i class="fa-solid fa-shield-halved ml-1"></i>
                                    حساب نظام محمي
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="mt-6 grid gap-4 border-t border-white/5 pt-5 sm:grid-cols-2">

                    <div>
                        <p class="text-[10px] text-dim">رقم الهاتف</p>
                        <p class="mt-1 text-xs font-bold">{{ $user->phone ?: '—' }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">المشرف المباشر</p>

                        @if ($user->supervisor)
                            <a
                                href="{{ route('users.show', $user->supervisor) }}"
                                class="mt-1 inline-flex text-xs font-bold hover:text-brand"
                            >
                                {{ $user->supervisor->name }}
                                <i class="fa-solid fa-arrow-up-right-from-square mr-2 text-[10px]"></i>
                            </a>
                        @else
                            <p class="mt-1 text-xs font-bold">لا يوجد مشرف</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">تاريخ إنشاء الحساب</p>
                        <p class="mt-1 text-xs font-bold">
                            {{ $user->created_at?->format('Y-m-d H:i') ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">آخر تحديث</p>
                        <p class="mt-1 text-xs font-bold">
                            {{ $user->updated_at?->format('Y-m-d H:i') ?? '—' }}
                        </p>
                    </div>

                </div>

            </x-panel>
        </div>

        <div>
            <x-panel title="ملخص النشاط" icon="fa-chart-simple">

                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">البنوك المرتبطة</span>
                        <span class="text-lg font-extrabold">{{ $user->banks->count() }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">شركات التقسيط</span>
                        <span class="text-lg font-extrabold">{{ $user->installmentCompanies->count() }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">أعضاء الفريق</span>
                        <span class="text-lg font-extrabold">{{ $user->subordinates->count() }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">صلاحيات مباشرة</span>
                        <span class="text-lg font-extrabold">{{ $user->permissions->count() }}</span>
                    </div>

                    <div class="border-t border-white/5 pt-4">
                        <p class="text-[10px] text-dim">آخر تسجيل دخول</p>
                        <p class="mt-1 text-xs font-bold">
                            {{ $user->last_login_at?->format('Y-m-d H:i') ?? 'لم يسجل الدخول بعد' }}
                        </p>

                        @if ($user->last_login_ip)
                            <p class="mt-2 text-[10px] text-dim">
                                IP: {{ $user->last_login_ip }}
                            </p>
                        @endif
                    </div>

                </div>

            </x-panel>
        </div>

    </div>

    {{-- Workspace links --}}
    <div class="mt-5">
        <x-panel title="إدارة حساب المستخدم" icon="fa-sliders">

            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

                <a
                    href="{{ route('users.team', $user) }}"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-people-group text-lg text-brand"></i>
                    <p class="mt-3 text-xs font-extrabold">الفريق التابع</p>
                    <p class="mt-1 text-[10px] text-dim">عرض الموظفين التابعين لهذا المشرف</p>
                </a>

                <a
                    href="{{ route('users.assignments', $user) }}"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-building-columns text-lg text-blue-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الجهات المرتبطة</p>
                    <p class="mt-1 text-[10px] text-dim">إدارة البنوك وشركات التقسيط</p>
                </a>

                <a
                    href="{{ route('users.permissions', $user) }}"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-shield-halved text-lg text-purple-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الصلاحيات</p>
                    <p class="mt-1 text-[10px] text-dim">مراجعة الصلاحيات والاستثناءات</p>
                </a>

                <a
                    href="{{ route('roles.index') }}"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-user-shield text-lg text-orange-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الأدوار الوظيفية</p>
                    <p class="mt-1 text-[10px] text-dim">عرض الأدوار المعرفة في النظام</p>
                </a>

            </div>

        </x-panel>
    </div>

    {{-- Subordinates --}}
    <div class="mt-5">
        <x-panel title="الموظفون التابعون" icon="fa-people-group">

            @if ($user->subordinates->isNotEmpty())
                <div class="table-wrap w-full overflow-x-auto">
                    <table class="data-table w-full min-w-[600px]">
                        <thead>
                            <tr>
                                <th>الموظف</th>
                                <th>كود الموظف</th>
                                <th>الدور</th>
                                <th>الحالة</th>
                                <th>التفاصيل</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user->subordinates as $subordinate)
                                <tr>
                                    <td class="text-xs font-bold">{{ $subordinate->name }}</td>
                                    <td class="text-xs text-dim">{{ $subordinate->employee_code }}</td>
                                    <td class="text-xs">{{ $subordinate->role?->label ?? $subordinate->role?->name ?? '—' }}</td>
                                    <td class="text-xs">{{ $subordinate->status }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $subordinate) }}" class="app-btn app-btn-secondary !px-3 !py-2">
                                            <i class="fa-solid fa-eye"></i>
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="py-6 text-center text-xs text-dim">
                    لا يوجد موظفون تابعون لهذا المستخدم.
                </p>
            @endif

        </x-panel>
    </div>

@endsection