```blade
@extends('layouts.app')

@section('title', 'تفاصيل الأرشيف')

@section('content')

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <x-page-header
        title="تفاصيل الأرشيف الشهري"
        subtitle="عرض البيانات التاريخية للتحصيل المحفوظة وقت إنشاء الأرشيف."
        eyebrow="الأرشيف / التفاصيل"
        icon="fa-box-archive"
    >
        <x-slot:actions>
            @if (\Illuminate\Support\Facades\Route::has('banks.archives.index'))
                <a
                    href="{{ route('banks.archives.index', ['bank' => $bank->id]) }}"
                    class="app-btn app-btn-secondary"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    العودة للأرشيف
                </a>
            @endif
        </x-slot:actions>
    </x-page-header>


    {{-- =========================================================
        ARCHIVE SUMMARY
    ========================================================== --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <x-stat-card
            label="السنة"
            :value="$archive->year ?? '—'"
            icon="fa-calendar"
            color="blue"
        />

        <x-stat-card
            label="الشهر"
            :value="$archive->month ?? '—'"
            icon="fa-calendar-days"
            color="purple"
        />

        <x-stat-card
            label="عدد القضايا"
            :value="number_format((int) ($archive->cases_count ?? 0))"
            icon="fa-file-invoice"
            color="green"
        />

        <x-stat-card
            label="إجمالي الدين"
            :value="number_format((float) ($archive->total_debt ?? 0), 2) . ' ج.م'"
            icon="fa-scale-balanced"
            color="orange"
        />

    </div>


    {{-- =========================================================
        COLLECTION SUMMARY
    ========================================================== --}}
    <div class="mt-5 grid gap-4 sm:grid-cols-2">

        <x-panel title="ملخص التحصيل" icon="fa-money-bill-transfer">

            <div class="space-y-4">

                <div class="flex items-center justify-between gap-4">
                    <span class="text-xs text-dim">
                        إجمالي الدين
                    </span>

                    <span class="text-sm font-extrabold">
                        {{ number_format((float) ($archive->total_debt ?? 0), 2) }}
                        ج.م
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-xs text-dim">
                        إجمالي التحصيل
                    </span>

                    <span class="text-sm font-extrabold text-brand">
                        {{ number_format((float) ($archive->collected_amount ?? 0), 2) }}
                        ج.م
                    </span>
                </div>

                <div class="border-t border-white/5 pt-4">

                    <div class="mb-2 flex items-center justify-between gap-4">
                        <span class="text-xs text-dim">
                            نسبة التحصيل
                        </span>

                        @php
                            $totalDebt = (float) ($archive->total_debt ?? 0);
                            $collectedAmount = (float) ($archive->collected_amount ?? 0);

                            $collectionRate = $totalDebt > 0
                                ? ($collectedAmount / $totalDebt) * 100
                                : 0;

                            $collectionRate = max(0, min(100, $collectionRate));
                        @endphp

                        <span class="text-xs font-extrabold text-brand">
                            {{ number_format($totalDebt > 0 ? ($collectedAmount / $totalDebt) * 100 : 0, 2) }}%
                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-white/5">
                        <div
                            class="h-full rounded-full bg-brand transition-all"
                            style="width: {{ $collectionRate }}%"
                        ></div>
                    </div>

                </div>

            </div>

        </x-panel>


        {{-- =====================================================
            ARCHIVE INFORMATION
        ====================================================== --}}
        <x-panel title="معلومات الأرشيف" icon="fa-circle-info">

            <dl class="grid gap-4 sm:grid-cols-2">

                <div>
                    <dt class="text-[10px] text-dim">
                        البنك
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        {{ $archive->bank?->name ?? $bank->name ?? '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        رقم الأرشيف
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        #{{ $archive->id }}
                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        تاريخ الأرشفة
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        {{ $archive->archived_at?->format('Y-m-d H:i') ?? '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        أُنشئ السجل في
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        {{ $archive->created_at?->format('Y-m-d H:i') ?? '—' }}
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-[10px] text-dim">
                        ملاحظات
                    </dt>

                    <dd class="mt-1 whitespace-pre-line text-xs leading-6">
                        {{ filled($archive->notes) ? $archive->notes : 'لا توجد ملاحظات مسجلة.' }}
                    </dd>
                </div>

            </dl>

        </x-panel>

    </div>


    {{-- =========================================================
        SNAPSHOT FILE
    ========================================================== --}}
    <div class="mt-5">

        <x-panel title="ملف اللقطة التاريخية" icon="fa-file-arrow-down">

            @if ($archive->snapshot_path)

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-brand/20 bg-brand/5 text-brand">
                            <i class="fa-solid fa-file-archive text-lg"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs font-extrabold">
                                ملف الأرشيف
                            </p>

                            <p class="mt-1 break-all text-[10px] text-dim">
                                {{ $archive->snapshot_path }}
                            </p>
                        </div>

                    </div>

                    <a
                        class="app-btn app-btn-primary shrink-0"
                        href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($archive->snapshot_path) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="fa-solid fa-download"></i>
                        عرض / تنزيل الملف
                    </a>

                </div>

            @else

                <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-4">

                    <i class="fa-solid fa-circle-info mt-0.5 text-dim"></i>

                    <div>
                        <p class="text-xs font-bold">
                            لا يوجد ملف لقطة محفوظ
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-dim">
                            تم حفظ بيانات الأرشيف في قاعدة البيانات، لكن لم يتم ربط ملف لقطة تاريخية بهذا السجل.
                        </p>
                    </div>

                </div>

            @endif

        </x-panel>

    </div>

@endsection
```