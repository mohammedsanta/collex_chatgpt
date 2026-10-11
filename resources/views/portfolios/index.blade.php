
@extends('layouts.app')

@section('title', 'المحافظ | Collex')
@section('topbar-title', 'إدارة المحافظ')

@section('content')
    <div class="space-y-6" dir="rtl">

        {{-- Page Header --}}
        <x-page-header
            title="المحافظ"
            subtitle="متابعة محافظ التحصيل وحالاتها وإجمالي المديونيات."
            eyebrow="إدارة التحصيل"
            icon="fa-solid fa-layer-group"
        />

        {{-- Statistics --}}
        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-stat-card
                label="إجمالي المحافظ"
                :value="number_format($statistics['total'])"
                icon="fa-solid fa-layer-group"
                color="blue"
                hint="جميع المحافظ غير المحذوفة"
            />

            <x-stat-card
                label="المسودات"
                :value="number_format($statistics['draft'])"
                icon="fa-solid fa-file-pen"
                color="orange"
                hint="لم يتم تفعيلها بعد"
            />

            <x-stat-card
                label="المحافظ النشطة"
                :value="number_format($statistics['active'])"
                icon="fa-solid fa-circle-check"
                color="green"
                hint="محافظ قيد التحصيل"
            />

            <x-stat-card
                label="إجمالي المديونية"
                :value="number_format((float) $statistics['total_debt'], 2) . ' ج.م'"
                icon="fa-solid fa-wallet"
                color="purple"
                hint="حسب إجماليات المحافظ المسجلة"
            />
        </section>

        {{-- Search and Filters --}}
        <section class="app-card">
            <div class="app-card-header">
                <h2 class="font-semibold text-fg">البحث والتصفية</h2>
                <p class="mt-1 text-sm text-muted">
                    ابحث باسم المحفظة أو البنك، أو صفِّ النتائج حسب الحالة.
                </p>
            </div>

            <div class="app-card-body">
                <form
                    method="GET"
                    action="{{ route('portfolios.index') }}"
                    class="grid grid-cols-1 items-end gap-4 md:grid-cols-[minmax(0,1fr)_220px_auto]"
                >
                    <div>
                        <label for="search" class="app-label">
                            البحث
                        </label>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="اسم المحفظة أو البنك..."
                            class="app-input w-full"
                        >
                    </div>

                    <div>
                        <label for="status" class="app-label">
                            حالة المحفظة
                        </label>

                        <select id="status" name="status" class="app-input w-full">
                            <option value="">كل الحالات</option>
                            <option value="draft" @selected(request('status') === 'draft')>
                                مسودة
                            </option>
                            <option value="active" @selected(request('status') === 'active')>
                                نشطة
                            </option>
                            <option value="archived" @selected(request('status') === 'archived')>
                                مؤرشفة
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="app-btn app-btn-primary">
                            <i class="fa-solid fa-magnifying-glass ms-1"></i>
                            بحث
                        </button>

                        @if (request()->hasAny(['search', 'status']))
                            <a
                                href="{{ route('portfolios.index') }}"
                                class="app-btn app-btn-secondary"
                            >
                                <i class="fa-solid fa-rotate-right ms-1"></i>
                                إعادة ضبط
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        {{-- Portfolios Table --}}
        <section class="app-card overflow-hidden">
            <div class="app-card-header flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-semibold text-fg">سجلات المحافظ</h2>
                    <p class="mt-1 text-sm text-muted">
                        إجمالي النتائج:
                        <span class="font-semibold text-fg">
                            {{ number_format($portfolios->total()) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="app-table w-full">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">المحفظة</th>
                            <th class="whitespace-nowrap">البنك</th>
                            <th class="whitespace-nowrap">الفترة</th>
                            <th class="whitespace-nowrap">عدد القضايا</th>
                            <th class="whitespace-nowrap">إجمالي المديونية</th>
                            <th class="whitespace-nowrap">الحالة</th>
                            <th class="whitespace-nowrap">تاريخ الإنشاء</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($portfolios as $portfolio)
                            <tr>
                                <td>
                                    <p class="font-semibold text-fg">
                                        {{ $portfolio->name }}
                                    </p>
                                    <p class="mt-1 text-xs text-muted">
                                        #{{ $portfolio->id }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap text-fg">
                                    {{ $portfolio->bank?->name ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap text-fg tabular-nums">
                                    {{ sprintf('%02d', $portfolio->period_month) }}/{{ $portfolio->period_year }}
                                </td>

                                <td class="whitespace-nowrap font-semibold text-fg tabular-nums">
                                    {{ number_format($portfolio->debt_cases_count) }}
                                </td>

                                <td class="whitespace-nowrap font-semibold text-fg tabular-nums">
                                    {{ number_format((float) $portfolio->total_debt, 2) }}
                                    <span class="text-xs font-normal text-muted">ج.م</span>
                                </td>

                                <td class="whitespace-nowrap">
                                    @switch($portfolio->status)
                                        @case('draft')
                                            <span class="app-badge app-badge-orange">
                                                مسودة
                                            </span>
                                            @break

                                        @case('active')
                                            <span class="app-badge app-badge-green">
                                                نشطة
                                            </span>
                                            @break

                                        @case('archived')
                                            <span class="app-badge app-badge-gray">
                                                مؤرشفة
                                            </span>
                                            @break

                                        @default
                                            <span class="app-badge app-badge-gray">
                                                {{ $portfolio->status }}
                                            </span>
                                    @endswitch
                                </td>

                                <td class="whitespace-nowrap text-muted tabular-nums">
                                    {{ $portfolio->created_at?->format('Y-m-d') ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center">
                                    <div class="app-empty">
                                        <i class="fa-solid fa-layer-group mb-3 text-2xl text-muted"></i>

                                        <p class="font-semibold text-fg">
                                            لا توجد محافظ مطابقة
                                        </p>

                                        <p class="mt-2 text-sm text-muted">
                                            جرّب تغيير كلمات البحث أو اختيار حالة أخرى.
                                        </p>

                                        @if (request()->hasAny(['search', 'status']))
                                            <a
                                                href="{{ route('portfolios.index') }}"
                                                class="app-btn app-btn-secondary mt-4"
                                            >
                                                عرض جميع المحافظ
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($portfolios->hasPages())
                <div class="app-card-body border-t border-line">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-muted">
                            عرض
                            <span class="font-semibold text-fg">
                                {{ number_format($portfolios->firstItem() ?? 0) }}
                            </span>
                            إلى
                            <span class="font-semibold text-fg">
                                {{ number_format($portfolios->lastItem() ?? 0) }}
                            </span>
                            من
                            <span class="font-semibold text-fg">
                                {{ number_format($portfolios->total()) }}
                            </span>
                            محفظة
                        </p>

                        <nav
                            class="flex flex-wrap items-center gap-1"
                            aria-label="التنقل بين صفحات المحافظ"
                        >
                            @if ($portfolios->onFirstPage())
                                <span class="app-btn app-btn-secondary opacity-50" aria-disabled="true">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </span>
                            @else
                                <a
                                    href="{{ $portfolios->previousPageUrl() }}"
                                    class="app-btn app-btn-secondary"
                                    aria-label="الصفحة السابقة"
                                >
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </a>
                            @endif

                            @foreach ($portfolios->getUrlRange(
                                max(1, $portfolios->currentPage() - 2),
                                min($portfolios->lastPage(), $portfolios->currentPage() + 2)
                            ) as $page => $url)
                                <a
                                    href="{{ $url }}"
                                    @if ($page === $portfolios->currentPage()) aria-current="page" @endif
                                    class="app-btn {{ $page === $portfolios->currentPage() ? 'app-btn-primary' : 'app-btn-secondary' }}"
                                >
                                    {{ $page }}
                                </a>
                            @endforeach

                            @if ($portfolios->hasMorePages())
                                <a
                                    href="{{ $portfolios->nextPageUrl() }}"
                                    class="app-btn app-btn-secondary"
                                    aria-label="الصفحة التالية"
                                >
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span class="sr-only">التالي</span>
                                </a>
                            @else
                                <span class="app-btn app-btn-secondary opacity-50" aria-disabled="true">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span class="sr-only">التالي</span>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            @endif

            <div class="flex flex-wrap items-center justify-between gap-2 border-t border-line px-5 py-3 text-xs text-muted">
                <span>COLLEX · إدارة المحافظ</span>
                <span>
                    عدد المحافظ المعروضة: {{ number_format($portfolios->count()) }}
                </span>
            </div>
        </section>
    </div>
@endsection
