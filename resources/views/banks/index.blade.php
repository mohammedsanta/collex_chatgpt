@extends('layouts.app')

@section('title', 'البنوك | Collex')

@section('content')

<x-page-header
    title="قطاع البنوك المصرية"
    subtitle="إدارة البنوك ومحافظ التحصيل والبيانات المرتبطة بها."
    eyebrow="إدارة المؤسسات"
    icon="fa-building-columns"
/>

{{-- Statistics --}}
<div class="grid grid-cols-2 gap-3 xl:grid-cols-4">
    <x-stat-card
        label="إجمالي البنوك"
        :value="number_format($stats['total'] ?? 0)"
        icon="fa-building-columns"
        color="green"
    />

    <x-stat-card
        label="البنوك النشطة"
        :value="number_format($stats['active'] ?? 0)"
        icon="fa-circle-check"
        color="blue"
    />

    <x-stat-card
        label="البنوك غير النشطة"
        :value="number_format($stats['inactive'] ?? 0)"
        icon="fa-circle-pause"
        color="orange"
    />

    <x-stat-card
        label="المحافظ"
        :value="number_format($stats['portfolios'] ?? 0)"
        icon="fa-folder-open"
        color="purple"
    />
</div>

{{-- Flash Messages --}}
@if (session('success'))
    <div class="mt-5 flex items-start gap-3 rounded-xl border border-success/20 bg-success/10 p-4 text-sm text-success">
        <i class="fa-solid fa-circle-check mt-0.5"></i>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="mt-5 flex items-start gap-3 rounded-xl border border-danger/20 bg-danger/10 p-4 text-sm text-danger">
        <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
        <p>{{ session('error') }}</p>
    </div>
@endif

{{-- Banks List --}}
<div class="mt-5">
    <x-panel
        title="البنوك المسجلة"
        subtitle="إدارة الجهات البنكية واستعراض المحافظ المرتبطة بكل بنك."
        icon="fa-building-columns"
    >
        {{-- Search and Filters --}}
        <div class="mb-5 flex flex-col gap-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-xs text-dim">
                        إجمالي النتائج
                    </p>

                    <p class="mt-1 text-lg font-extrabold tabular-nums">
                        {{ number_format($banks->total()) }}
                        <span class="text-xs font-normal text-dim">بنك</span>
                    </p>
                </div>

                <a
                    href="{{ route('banks.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-bold text-black transition hover:opacity-90"
                >
                    <i class="fa-solid fa-plus"></i>
                    إضافة بنك جديد
                </a>
            </div>

            <div class="app-divider"></div>

            <form
                method="GET"
                action="{{ route('banks.index') }}"
                class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4"
            >
                <div class="sm:col-span-2">
                    <label
                        for="bank-search"
                        class="mb-2 block text-xs font-bold text-dim"
                    >
                        البحث عن بنك
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-dim"></i>

                        <input
                            id="bank-search"
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="اسم البنك أو الكود..."
                            class="w-full rounded-xl border border-line bg-surface px-10 py-3 text-sm text-main outline-none transition placeholder:text-dim focus:border-brand"
                        >
                    </div>
                </div>

                <div>
                    <label
                        for="bank-status"
                        class="mb-2 block text-xs font-bold text-dim"
                    >
                        حالة البنك
                    </label>

                    <select
                        id="bank-status"
                        name="status"
                        class="w-full rounded-xl border border-line bg-surface px-3 py-3 text-sm text-main outline-none transition focus:border-brand"
                    >
                        <option value="">كل الحالات</option>

                        <option
                            value="active"
                            @selected(request('status') === 'active')
                        >
                            نشط
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                            غير نشط
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        type="submit"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-brand/10 px-4 py-3 text-sm font-bold text-brand transition hover:bg-brand/20"
                    >
                        <i class="fa-solid fa-filter"></i>
                        تطبيق
                    </button>

                    @if (request()->hasAny(['search', 'status']))
                        <a
                            href="{{ route('banks.index') }}"
                            title="إعادة ضبط الفلاتر"
                            aria-label="إعادة ضبط الفلاتر"
                            class="inline-flex items-center justify-center rounded-xl border border-line px-4 py-3 text-sm text-dim transition hover:bg-surface"
                        >
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Bank Cards --}}
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

            @forelse ($banks as $bank)
                <article
                    class="group relative flex min-w-0 flex-col rounded-xl border border-line bg-surface p-4 transition duration-200 hover:border-brand/40"
                >
                    {{-- Card Actions --}}
                    <div class="absolute left-3 top-3 flex items-center gap-1">
                        <a
                            href="{{ route('banks.panel', $bank) }}"
                            title="فتح لوحة البنك"
                            aria-label="فتح لوحة البنك"
                            class="grid h-8 w-8 place-items-center rounded-lg bg-brand/10 text-brand transition hover:bg-brand/20"
                        >
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </a>

                        <a
                            href="{{ route('banks.edit', $bank) }}"
                            title="تعديل البنك"
                            aria-label="تعديل البنك"
                            class="grid h-8 w-8 place-items-center rounded-lg bg-info/10 text-info transition hover:bg-info/20"
                        >
                            <i class="fa-solid fa-pen text-xs"></i>
                        </a>

                        <a
                            href="{{ route('banks.show', $bank) }}"
                            title="تفاصيل البنك"
                            aria-label="تفاصيل البنك"
                            class="grid h-8 w-8 place-items-center rounded-lg border border-line text-dim transition hover:text-main"
                        >
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>
                    </div>

                    {{-- Bank Identity --}}
                    <div class="mt-8 flex flex-col items-center text-center">
                        <a
                            href="{{ route('banks.show', $bank) }}"
                            class="grid h-16 w-16 place-items-center overflow-hidden rounded-xl border border-line bg-white p-2 transition duration-200 group-hover:scale-105"
                        >
                            @if ($bank->logo_path)
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($bank->logo_path) }}"
                                    alt="{{ $bank->name }}"
                                    loading="lazy"
                                    class="h-full w-full object-contain"
                                >
                            @else
                                <i class="fa-solid fa-building-columns text-3xl text-slate-700"></i>
                            @endif
                        </a>

                        <a
                            href="{{ route('banks.show', $bank) }}"
                            class="mt-3 max-w-full break-words text-sm font-extrabold text-main transition hover:text-brand"
                            title="{{ $bank->name }}"
                        >
                            {{ $bank->name }}
                        </a>

                        <p class="mt-1 text-xs text-dim">
                            {{ $bank->code ?: 'بدون كود' }}
                        </p>
                    </div>

                    <div class="app-divider my-4"></div>

                    {{-- Bank Metadata --}}
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        @if ($bank->is_active)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-success/10 px-2.5 py-1 text-[11px] font-bold text-success">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                نشط
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-surface px-2.5 py-1 text-[11px] font-bold text-dim">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                غير نشط
                            </span>
                        @endif

                        <span class="inline-flex items-center gap-1.5 text-xs text-dim">
                            <i class="fa-solid fa-folder-open"></i>
                            {{ number_format($bank->portfolios_count ?? 0) }}
                            محفظة
                        </span>
                    </div>

                    <a
                        href="{{ route('banks.show', $bank) }}"
                        class="mt-4 flex items-center justify-center gap-2 rounded-lg border border-line px-3 py-2 text-xs font-bold text-dim transition hover:border-brand/40 hover:text-brand"
                    >
                        عرض تفاصيل البنك
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </article>
            @empty
                <div class="flex min-h-[240px] flex-col items-center justify-center rounded-xl border border-dashed border-line p-6 text-center sm:col-span-2 xl:col-span-3 2xl:col-span-4">
                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-brand/10 text-brand">
                        <i class="fa-solid fa-building-columns text-2xl"></i>
                    </div>

                    <h3 class="mt-4 text-sm font-extrabold text-main">
                        لا توجد بنوك
                    </h3>

                    <p class="mt-2 max-w-sm text-xs leading-6 text-dim">
                        لا توجد نتائج مطابقة لخيارات البحث الحالية. جرّب تغيير الفلاتر أو أضف بنكًا جديدًا.
                    </p>

                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        @if (request()->hasAny(['search', 'status']))
                            <a
                                href="{{ route('banks.index') }}"
                                class="rounded-xl border border-line px-4 py-2 text-xs font-bold text-dim transition hover:text-main"
                            >
                                إعادة ضبط البحث
                            </a>
                        @endif

                        <a
                            href="{{ route('banks.create') }}"
                            class="rounded-xl bg-brand px-4 py-2 text-xs font-bold text-black transition hover:opacity-90"
                        >
                            <i class="fa-solid fa-plus ml-1"></i>
                            إضافة بنك
                        </a>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if ($banks->hasPages())
            <div class="mt-5 border-t border-line pt-5">
                {{ $banks->withQueryString()->links() }}
            </div>
        @endif
    </x-panel>
</div>

@endsection
