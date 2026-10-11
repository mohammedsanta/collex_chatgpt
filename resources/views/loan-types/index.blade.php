
@extends('layouts.app')

@section('title', 'أنواع القروض | Collex')
@section('topbar-title', 'أنواع القروض')

@section('content')
    <div class="space-y-6" dir="rtl">

        {{-- Page Header --}}
        <x-page-header
            title="أنواع القروض"
            subtitle="إدارة أنواع القروض المتاحة داخل النظام."
            eyebrow="الإدارة"
            icon="fa-solid fa-layer-group"
        />

        {{-- Statistics --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <x-stat-card
                label="إجمالي الأنواع"
                :value="number_format($statistics['total'])"
                icon="fa-solid fa-layer-group"
                color="blue"
            />

            <x-stat-card
                label="الأنواع النشطة"
                :value="number_format($statistics['active'])"
                icon="fa-solid fa-circle-check"
                color="green"
            />

            <x-stat-card
                label="الأنواع غير النشطة"
                :value="number_format($statistics['inactive'])"
                icon="fa-solid fa-circle-pause"
                color="orange"
            />
        </div>

        {{-- Search and Filters --}}
        <section class="app-card">
            <div class="app-card-header">
                <div>
                    <h2 class="font-semibold text-fg">البحث والتصفية</h2>
                    <p class="mt-1 text-sm text-muted">
                        ابحث عن نوع قرض أو صفِّ النتائج حسب الحالة.
                    </p>
                </div>
            </div>

            <div class="app-card-body">
                <form
                    method="GET"
                    action="{{ route('loan-types.index') }}"
                    class="grid grid-cols-1 items-end gap-4 md:grid-cols-[minmax(0,1fr)_220px_auto]"
                >
                    <div>
                        <label for="search" class="app-label">
                            اسم نوع القرض
                        </label>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="ابحث باسم نوع القرض..."
                            class="app-input w-full"
                        >
                    </div>

                    <div>
                        <label for="status" class="app-label">
                            الحالة
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="app-input w-full"
                        >
                            <option value="">كل الحالات</option>
                            <option
                                value="active"
                                @selected(($filters['status'] ?? '') === 'active')
                            >
                                نشط
                            </option>
                            <option
                                value="inactive"
                                @selected(($filters['status'] ?? '') === 'inactive')
                            >
                                غير نشط
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="app-btn app-btn-primary">
                            <i class="fa-solid fa-magnifying-glass ms-1"></i>
                            بحث
                        </button>

                        <a
                            href="{{ route('loan-types.index') }}"
                            class="app-btn app-btn-secondary"
                        >
                            <i class="fa-solid fa-rotate-right ms-1"></i>
                            إعادة ضبط
                        </a>
                    </div>
                </form>
            </div>
        </section>

        {{-- Loan Types Table --}}
        <section class="app-card overflow-hidden">
            <div class="app-card-header flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-semibold text-fg">سجلات أنواع القروض</h2>
                    <p class="mt-1 text-sm text-muted">
                        إجمالي النتائج:
                        <span class="font-semibold text-fg">
                            {{ number_format($loanTypes->total()) }}
                        </span>
                    </p>
                </div>

                @can('create', \App\Domain\Institutions\Models\LoanType::class)
                    <a
                        href="{{ route('loan-types.create') }}"
                        class="app-btn app-btn-primary"
                    >
                        <i class="fa-solid fa-plus ms-1"></i>
                        إضافة نوع قرض
                    </a>
                @endcan
            </div>

            <div class="overflow-x-auto">
                <table class="app-table w-full">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">اسم نوع القرض</th>
                            <th class="whitespace-nowrap">ملفات القروض المرتبطة</th>
                            <th class="whitespace-nowrap">الحالة</th>
                            <th class="whitespace-nowrap">تاريخ الإضافة</th>
                            <th class="whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($loanTypes as $loanType)
                            <tr>
                                <td class="whitespace-nowrap text-muted">
                                    {{ $loanType->id }}
                                </td>

                                <td class="whitespace-nowrap font-semibold text-fg">
                                    {{ $loanType->name }}
                                </td>

                                <td class="whitespace-nowrap">
                                    <span class="font-semibold text-fg">
                                        {{ number_format($loanType->debt_cases_count) }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap">
                                    @if ($loanType->is_active)
                                        <span class="app-badge app-badge-green">
                                            نشط
                                        </span>
                                    @else
                                        <span class="app-badge app-badge-gray">
                                            غير نشط
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap text-muted">
                                    {{ $loanType->created_at?->format('Y-m-d') ?? '—' }}
                                </td>

                                <td>
                                    <div class="flex flex-wrap items-center gap-2">
                                        @can('update', $loanType)
                                            <a
                                                href="{{ route('loan-types.edit', $loanType) }}"
                                                class="app-btn app-btn-secondary"
                                            >
                                                <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                تعديل
                                            </a>
                                        @endcan

                                        @if ($loanType->is_active)
                                            @can('deactivate', $loanType)
                                                <form
                                                    method="POST"
                                                    action="{{ route('loan-types.deactivate', $loanType) }}"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="app-btn app-btn-secondary"
                                                    >
                                                        <i class="fa-solid fa-ban ms-1"></i>
                                                        تعطيل
                                                    </button>
                                                </form>
                                            @endcan
                                        @else
                                            @can('activate', $loanType)
                                                <form
                                                    method="POST"
                                                    action="{{ route('loan-types.activate', $loanType) }}"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="app-btn app-btn-secondary"
                                                    >
                                                        <i class="fa-solid fa-check ms-1"></i>
                                                        تفعيل
                                                    </button>
                                                </form>
                                            @endcan

                                            @if ($loanType->debt_cases_count === 0)
                                                @can('delete', $loanType)
                                                    <form
                                                        method="POST"
                                                        action="{{ route('loan-types.destroy', $loanType) }}"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف نوع القرض؟')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="app-btn app-btn-danger"
                                                        >
                                                            <i class="fa-solid fa-trash ms-1"></i>
                                                            حذف
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <div class="app-empty">
                                        <i class="fa-solid fa-layer-group mb-3 text-2xl text-muted"></i>

                                        <p class="font-semibold text-fg">
                                            لا توجد أنواع قروض مطابقة.
                                        </p>

                                        <p class="mt-2 text-sm text-muted">
                                            جرّب تغيير البحث أو الفلاتر.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($loanTypes->hasPages())
                <div class="app-card-body border-t border-line">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-muted">
                            عرض
                            <span class="font-semibold text-fg">
                                {{ number_format($loanTypes->firstItem() ?? 0) }}
                            </span>
                            إلى
                            <span class="font-semibold text-fg">
                                {{ number_format($loanTypes->lastItem() ?? 0) }}
                            </span>
                            من
                            <span class="font-semibold text-fg">
                                {{ number_format($loanTypes->total()) }}
                            </span>
                            نتيجة
                        </p>

                        <nav
                            class="flex flex-wrap items-center gap-1"
                            aria-label="التنقل بين صفحات أنواع القروض"
                        >
                            @if ($loanTypes->onFirstPage())
                                <span class="app-btn app-btn-secondary opacity-50" aria-disabled="true">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </span>
                            @else
                                <a
                                    href="{{ $loanTypes->previousPageUrl() }}"
                                    class="app-btn app-btn-secondary"
                                    aria-label="الصفحة السابقة"
                                >
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </a>
                            @endif

                            @foreach ($loanTypes->getUrlRange(
                                max(1, $loanTypes->currentPage() - 2),
                                min($loanTypes->lastPage(), $loanTypes->currentPage() + 2)
                            ) as $page => $url)
                                <a
                                    href="{{ $url }}"
                                    @if ($page === $loanTypes->currentPage()) aria-current="page" @endif
                                    class="app-btn {{ $page === $loanTypes->currentPage() ? 'app-btn-primary' : 'app-btn-secondary' }}"
                                >
                                    {{ $page }}
                                </a>
                            @endforeach

                            @if ($loanTypes->hasMorePages())
                                <a
                                    href="{{ $loanTypes->nextPageUrl() }}"
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
        </section>
    </div>
@endsection
