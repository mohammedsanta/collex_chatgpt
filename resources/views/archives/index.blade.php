@extends('layouts.app')

@section('title', 'الأرشيف الشهري')

@section('content')
<div class="space-y-6" dir="rtl">

    {{-- Page heading --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="eyebrow">إدارة الأرشيف</div>
            <h1 class="page-title mt-2">الأرشيف الشهري</h1>
            <p class="page-subtitle">
                استعراض النطاقات الشهرية المؤرشفة والرجوع إلى بياناتها وتقارير التحصيل السابقة.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-xl border border-line bg-surface px-4 py-3 text-xs font-bold text-muted">
                <i class="fa-solid fa-box-archive text-brand"></i>
                الأرشيف
            </span>
        </div>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="app-stat">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="app-stat-label">إجمالي السجلات المعروضة</p>
                    <p class="app-stat-value mt-2">
                        {{ number_format($archives->total()) }}
                    </p>
                    <p class="mt-2 text-[11px] text-muted">
                        عدد سجلات الأرشيف المطابقة للبحث
                    </p>
                </div>

                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-brand/10 text-brand">
                    <i class="fa-solid fa-box-archive text-lg"></i>
                </div>
            </div>
        </div>

        <div class="app-stat">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="app-stat-label">عدد النتائج في الصفحة</p>
                    <p class="app-stat-value mt-2">
                        {{ number_format($archives->count()) }}
                    </p>
                    <p class="mt-2 text-[11px] text-muted">
                        من أصل {{ number_format($archives->total()) }} سجل
                    </p>
                </div>

                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-white/[0.04] text-muted">
                    <i class="fa-solid fa-list-check text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">البحث والتصفية</h2>
                <p class="mt-1 text-[11px] text-muted">
                    ابحث في الأرشيف حسب اسم البنك أو السنة أو الشهر.
                </p>
            </div>

            <i class="fa-solid fa-sliders text-muted"></i>
        </div>

        <div class="app-card-body">
            <form method="GET" action="{{ route('archives.index') }}">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Search --}}
                    <div>
                        <label for="search" class="mb-2 block text-xs font-bold text-muted">
                            البحث
                        </label>

                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-muted"></i>

                            <input
                                id="search"
                                type="search"
                                name="search"
                                value="{{ $filters['search'] ?? '' }}"
                                placeholder="اسم البنك أو ملاحظات الأرشيف"
                                class="w-full rounded-xl border border-line bg-base py-3 pe-10 ps-3 text-xs text-fg outline-none transition placeholder:text-dim focus:border-brand/50"
                            >
                        </div>
                    </div>

                    {{-- Year --}}
                    <div>
                        <label for="year" class="mb-2 block text-xs font-bold text-muted">
                            السنة
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">كل السنوات</option>

                            @for ($year = (int) now()->format('Y'); $year >= 2000; $year--)
                                <option
                                    value="{{ $year }}"
                                    @selected((string) ($filters['year'] ?? '') === (string) $year)
                                >
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Month --}}
                    <div>
                        <label for="month" class="mb-2 block text-xs font-bold text-muted">
                            الشهر
                        </label>

                        <select
                            id="month"
                            name="month"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">كل الشهور</option>

                            @foreach ([
                                1 => 'يناير',
                                2 => 'فبراير',
                                3 => 'مارس',
                                4 => 'أبريل',
                                5 => 'مايو',
                                6 => 'يونيو',
                                7 => 'يوليو',
                                8 => 'أغسطس',
                                9 => 'سبتمبر',
                                10 => 'أكتوبر',
                                11 => 'نوفمبر',
                                12 => 'ديسمبر',
                            ] as $number => $monthName)
                                <option
                                    value="{{ $number }}"
                                    @selected((string) ($filters['month'] ?? '') === (string) $number)
                                >
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter actions --}}
                    <div class="flex items-end gap-2">
                        <button
                            type="submit"
                            class="inline-flex min-h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-brand px-4 py-3 text-xs font-extrabold text-black transition hover:opacity-90"
                        >
                            <i class="fa-solid fa-filter"></i>
                            تطبيق
                        </button>

                        <a
                            href="{{ route('archives.index') }}"
                            class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-line bg-white/[0.02] px-4 py-3 text-xs font-bold text-muted transition hover:text-fg"
                            title="إعادة ضبط الفلاتر"
                        >
                            <i class="fa-solid fa-rotate-left"></i>
                            <span class="hidden sm:inline">إعادة ضبط</span>
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Archive table --}}
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">سجلات الأرشيف</h2>
                <p class="mt-1 text-[11px] text-muted">
                    البيانات التاريخية للنطاقات الشهرية.
                </p>
            </div>

            <span class="rounded-lg border border-line bg-white/[0.02] px-3 py-2 text-[11px] font-bold text-muted">
                {{ number_format($archives->total()) }} سجل
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-right">
                <thead>
                    <tr class="border-b border-line bg-white/[0.015]">
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">الفترة</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">البنك</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">النطاق</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">تاريخ الأرشفة</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">المسؤول</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-line">
                    @forelse ($archives as $archive)
                        <tr class="transition hover:bg-white/[0.02]">

                            {{-- Period --}}
                            <td class="px-5 py-4">
                                <div class="font-bold text-fg">
                                    {{ sprintf('%02d', $archive->month) }}/{{ $archive->year }}
                                </div>

                                <div class="mt-1 text-[10px] text-muted">
                                    {{ [
                                        1 => 'يناير',
                                        2 => 'فبراير',
                                        3 => 'مارس',
                                        4 => 'أبريل',
                                        5 => 'مايو',
                                        6 => 'يونيو',
                                        7 => 'يوليو',
                                        8 => 'أغسطس',
                                        9 => 'سبتمبر',
                                        10 => 'أكتوبر',
                                        11 => 'نوفمبر',
                                        12 => 'ديسمبر',
                                    ][$archive->month] ?? 'غير محدد' }}
                                </div>
                            </td>

                            {{-- Bank --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-9 w-9 shrink-0 place-items-center rounded-xl border border-line bg-white/[0.025] text-brand">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>

                                    <span class="text-xs font-bold text-fg">
                                        {{ $archive->bank?->name ?? 'غير محدد' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Portfolio --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-2 rounded-lg border border-line bg-white/[0.02] px-3 py-2 text-[11px] font-bold text-muted">
                                    <i class="fa-solid fa-folder text-brand"></i>
                                    {{ $archive->portfolio?->name ?? ('أرشيف #' . $archive->getKey()) }}
                                </span>
                            </td>

                            {{-- Archived at --}}
                            <td class="px-5 py-4 text-xs text-muted">
                                @if ($archive->archived_at)
                                    <div>{{ $archive->archived_at->format('Y-m-d') }}</div>

                                    <div class="mt-1 text-[10px] text-dim">
                                        {{ $archive->archived_at->format('h:i A') }}
                                    </div>
                                @else
                                    <span class="text-dim">غير مسجل</span>
                                @endif
                            </td>

                            {{-- Archived by --}}
                            <td class="px-5 py-4 text-xs text-muted">
                                {{ $archive->archivedBy?->name ?? 'غير محدد' }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">
                                <a
                                    href="{{ route('archives.show', ['archive' => $archive->getKey()]) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-brand/30 bg-brand/10 px-3 py-2.5 text-[11px] font-extrabold text-brand transition hover:border-brand/60 hover:bg-brand/15"
                                    title="عرض تفاصيل الأرشيف"
                                    aria-label="عرض تفاصيل الأرشيف"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                    عرض التفاصيل
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl border border-line bg-white/[0.02] text-muted">
                                    <i class="fa-solid fa-box-open text-xl"></i>
                                </div>

                                <h3 class="mt-4 text-sm font-extrabold text-fg">
                                    لا توجد سجلات أرشيف
                                </h3>

                                <p class="mx-auto mt-2 max-w-md text-xs leading-6 text-muted">
                                    لم يتم العثور على سجلات تطابق معايير البحث الحالية.
                                    جرّب تغيير الفلاتر أو إعادة ضبطها.
                                </p>

                                @if (request()->hasAny(['search', 'year', 'month', 'bank_id']))
                                    <a
                                        href="{{ route('archives.index') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl border border-line px-4 py-3 text-xs font-bold text-fg transition hover:border-brand/40"
                                    >
                                        <i class="fa-solid fa-rotate-left"></i>
                                        عرض كل السجلات
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($archives->hasPages())
            <div class="flex flex-col gap-3 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-[11px] text-muted">
                    عرض
                    <span class="font-bold text-fg">{{ number_format($archives->firstItem() ?? 0) }}</span>
                    إلى
                    <span class="font-bold text-fg">{{ number_format($archives->lastItem() ?? 0) }}</span>
                    من
                    <span class="font-bold text-fg">{{ number_format($archives->total()) }}</span>
                    سجل
                </p>

                <div class="text-xs">
                    {{ $archives->withQueryString()->links() }}
                </div>
            </div>
        @endif
    </div>

</div>
@endsection