
@extends('layouts.app')

@section('title', 'المحافظات')
@section('topbar-title', 'إدارة المحافظات')

@section('content')
    <x-page-header
        title="المحافظات"
        subtitle="إدارة المحافظات المسجلة في النظام والبحث عنها وتحديث بياناتها."
        eyebrow="المؤسسات"
        icon="fa-map-location-dot"
    />

    @php
        $totalGovernorates = $governorates->total();
    @endphp

    {{-- Summary --}}
    <div class="mb-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-stat-card
            label="إجمالي المحافظات"
            :value="number_format($totalGovernorates)"
            icon="fa-map-location-dot"
            color="green"
            hint="عدد المحافظات المسجلة"
        />
    </div>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="app-flash app-flash-success" role="status">
            <i class="fa-solid fa-circle-check mt-1"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="app-flash app-flash-error" role="alert">
            <i class="fa-solid fa-circle-exclamation mt-1"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Search and actions --}}
    <div class="app-card mb-5">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">البحث والتصفية</h2>
                <p class="mt-1 text-[11px] text-muted">
                    ابحث باسم المحافظة بالعربية أو الإنجليزية.
                </p>
            </div>

            <a href="{{ route('governorates.create') }}"
               class="app-btn app-btn-primary">
                <i class="fa-solid fa-plus"></i>
                إضافة محافظة
            </a>
        </div>

        <div class="app-card-body">
            <form action="{{ route('governorates.index') }}"
                  method="GET"
                  class="grid gap-3 sm:grid-cols-[1fr_auto_auto] sm:items-end">

                <div>
                    <label for="search" class="app-label">اسم المحافظة</label>

                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-xs text-dim"></i>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="{{ $search ?? request('search') }}"
                            placeholder="ابحث عن محافظة..."
                            class="app-input pr-9"
                        >
                    </div>
                </div>

                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    بحث
                </button>

                @if (filled($search ?? request('search')))
                    <a href="{{ route('governorates.index') }}"
                       class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-right"></i>
                        إعادة تعيين
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Governorates table --}}
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">قائمة المحافظات</h2>
                <p class="mt-1 text-[11px] text-muted">
                    بيانات المحافظات المسجلة في النظام.
                </p>
            </div>

            <span class="app-badge app-badge-green">
                <i class="fa-solid fa-layer-group"></i>
                {{ number_format($totalGovernorates) }} محافظة
            </span>
        </div>

        @if ($governorates->count())
            <div class="overflow-x-auto">
                <table class="app-table">
                    <thead>
                        <tr>
                            <th class="w-20">#</th>
                            <th>اسم المحافظة بالعربية</th>
                            <th>اسم المحافظة بالإنجليزية</th>
                            <th class="w-36 text-center">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($governorates as $governorate)
                            <tr>
                                <td>
                                    <span class="num text-[11px] font-bold text-dim">
                                        {{ $governorates->firstItem() + $loop->index }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl border border-brand/15 bg-brand/10 text-brand">
                                            <i class="fa-solid fa-map-pin"></i>
                                        </span>

                                        <span class="font-bold text-fg">
                                            {{ $governorate->name }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    @if ($governorate->name_en)
                                        <span dir="ltr" class="inline-block text-right text-xs text-muted">
                                            {{ $governorate->name_en }}
                                        </span>
                                    @else
                                        <span class="text-dim">—</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            href="{{ route('governorates.edit', $governorate) }}"
                                            class="app-btn app-btn-secondary !min-h-9 !px-3"
                                            title="تعديل المحافظة"
                                            aria-label="تعديل المحافظة {{ $governorate->name }}"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-info"></i>
                                            <span>تعديل</span>
                                        </a>

                                        <form
                                            action="{{ route('governorates.destroy', $governorate) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف المحافظة {{ $governorate->name }}؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="app-btn app-btn-danger !min-h-9 !px-3"
                                                title="حذف المحافظة"
                                                aria-label="حذف المحافظة {{ $governorate->name }}"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            
@if ($governorates->hasPages())
    <div class="flex flex-col gap-4 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-[11px] text-muted">
            عرض
            <span class="font-extrabold text-fg">{{ number_format($governorates->firstItem()) }}</span>
            إلى
            <span class="font-extrabold text-fg">{{ number_format($governorates->lastItem()) }}</span>
            من
            <span class="font-extrabold text-fg">{{ number_format($governorates->total()) }}</span>
            نتيجة
        </p>

        <nav aria-label="التنقل بين صفحات المحافظات"
             class="flex flex-wrap items-center gap-1.5">

            {{-- Previous page --}}
            @if ($governorates->onFirstPage())
                <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50"
                      aria-disabled="true">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    السابق
                </span>
            @else
                <a href="{{ $governorates->previousPageUrl() }}"
                   rel="prev"
                   class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    السابق
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($governorates->getUrlRange(1, $governorates->lastPage()) as $page => $url)
                @if ($page === $governorates->currentPage())
                    <span aria-current="page"
                          class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-brand/30 bg-brand/10 px-3 text-xs font-extrabold text-brand">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand"
                       aria-label="الصفحة {{ $page }}">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next page --}}
            @if ($governorates->hasMorePages())
                <a href="{{ $governorates->nextPageUrl() }}"
                   rel="next"
                   class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                    التالي
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </a>
            @else
                <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50"
                      aria-disabled="true">
                    التالي
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </span>
            @endif
        </nav>
    </div>
@endif

        @else
            {{-- Empty state --}}
            <div class="app-empty">
                <span class="app-empty-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </span>

                <h3 class="text-sm font-extrabold text-fg">
                    @if (filled($search ?? request('search')))
                        لا توجد نتائج مطابقة
                    @else
                        لا توجد محافظات مسجلة
                    @endif
                </h3>

                <p class="mt-2 max-w-sm text-xs leading-6 text-muted">
                    @if (filled($search ?? request('search')))
                        جرّب البحث باسم مختلف أو ألغِ التصفية لعرض جميع المحافظات.
                    @else
                        ابدأ بإضافة أول محافظة لتظهر بياناتها هنا.
                    @endif
                </p>

                <div class="mt-5 flex flex-wrap justify-center gap-2">
                    @if (filled($search ?? request('search')))
                        <a href="{{ route('governorates.index') }}"
                           class="app-btn app-btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i>
                            عرض الكل
                        </a>
                    @endif

                    <a href="{{ route('governorates.create') }}"
                       class="app-btn app-btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        إضافة محافظة
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
