@extends('layouts.app')

@section('title', 'تفاصيل وعد السداد')

@section('content')
    @php
        $promisedAmount = (float) ($promise->promised_amount ?? 0);
        $paidAmount = (float) ($promise->paid_amount ?? 0);
        $remainingAmount = max(0, $promisedAmount - $paidAmount);

        $promiseDate = $promise->promise_date;
        $createdAt = $promise->created_at;

        $isOverdue = $promiseDate
            && \Illuminate\Support\Carbon::parse($promiseDate)->startOfDay()->lt(today())
            && ($promise->status ?? 'active') === 'active';

        $client = $promise->debtCase?->client;
        $debtCase = $promise->debtCase;
    @endphp

    <x-page-header
        title="تفاصيل وعد السداد"
        subtitle="مراجعة بيانات العميل واتفاق السداد ومتابعة المبالغ المستحقة."
        eyebrow="وعود السداد / التفاصيل"
        icon="fa-handshake"
    >
        <x-slot:actions>
            <a
                href="{{ url()->previous() }}"
                class="app-btn app-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                رجوع
            </a>

            @if (\Illuminate\Support\Facades\Route::has('banks.ptp.edit'))
                <a
                    href="{{ route('banks.ptp.edit', $promise) }}"
                    class="app-btn app-btn-primary"
                >
                    <i class="fa-solid fa-pen-to-square"></i>
                    تعديل الوعد
                </a>
            @endif
        </x-slot:actions>
    </x-page-header>

    {{-- Status and reference --}}
    <x-panel>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-surface-raised text-brand">
                    <i class="fa-solid fa-handshake text-lg"></i>
                </div>

                <div>
                    <h2 class="text-sm font-extrabold text-text">
                        وعد سداد #{{ $promise->id }}
                    </h2>

                    <p class="mt-1 text-xs text-muted">
                        {{ $client?->name ?? 'العميل غير محدد' }}
                    </p>

                    <p class="mt-1 text-[10px] text-dim">
                        تاريخ التسجيل:
                        {{ $createdAt?->format('Y-m-d H:i') ?? '—' }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if ($isOverdue)
                    <span class="app-badge-danger">
                        <i class="fa-solid fa-clock ms-1"></i>
                        متأخر عن الموعد
                    </span>
                @endif

                <x-status-badge :status="$promise->status ?? 'active'" />
            </div>
        </div>
    </x-panel>

    {{-- Financial summary --}}
    <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <x-stat-card
            label="المبلغ الموعود"
            :value="number_format($promisedAmount, 2) . ' ج.م'"
            icon="fa-handshake"
            color="blue"
        />

        <x-stat-card
            label="المبلغ المدفوع"
            :value="number_format($paidAmount, 2) . ' ج.م'"
            icon="fa-money-bill-wave"
            color="green"
        />

        <x-stat-card
            label="المبلغ المتبقي"
            :value="number_format($remainingAmount, 2) . ' ج.م'"
            icon="fa-hourglass-half"
            color="orange"
        />
    </div>

    <div class="mt-5 grid gap-5 xl:grid-cols-2">
        {{-- Promise information --}}
        <x-panel title="بيانات وعد السداد" icon="fa-calendar-check">
            <dl class="grid gap-x-6 gap-y-5 sm:grid-cols-2">
                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        اسم العميل
                    </dt>
                    <dd class="mt-2 break-words text-xs font-bold text-text">
                        {{ $client?->name ?? '—' }}
                    </dd>
                </div>

                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        رقم القضية
                    </dt>
                    <dd class="mt-2 text-xs font-bold text-text">
                        {{ $promise->debt_case_id ?? '—' }}
                    </dd>
                </div>

                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        رقم القرض
                    </dt>
                    <dd class="mt-2 break-words text-xs font-bold text-text">
                        {{ $debtCase?->loan_number ?? '—' }}
                    </dd>
                </div>

                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        تاريخ السداد المتفق عليه
                    </dt>
                    <dd class="mt-2 text-xs font-bold text-text">
                        {{ $promiseDate ? \Illuminate\Support\Carbon::parse($promiseDate)->format('Y-m-d') : '—' }}
                    </dd>
                </div>

                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        حالة الوعد
                    </dt>
                    <dd class="mt-2">
                        <x-status-badge :status="$promise->status ?? 'active'" />
                    </dd>
                </div>

                <div class="min-w-0">
                    <dt class="text-[10px] font-semibold text-dim">
                        تاريخ إنشاء الوعد
                    </dt>
                    <dd class="mt-2 text-xs font-bold text-text">
                        {{ $createdAt?->format('Y-m-d') ?? '—' }}
                    </dd>
                </div>
            </dl>
        </x-panel>

        {{-- Payment progress --}}
        <x-panel title="ملخص الالتزام المالي" icon="fa-chart-simple">
            <div class="space-y-5">
                <div>
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <span class="text-xs font-semibold text-muted">
                            نسبة السداد
                        </span>

                        <span class="text-xs font-extrabold text-text">
                            {{ $promisedAmount > 0 ? number_format(min(100, ($paidAmount / $promisedAmount) * 100), 1) : '0.0' }}%
                        </span>
                    </div>

                    <div class="h-2.5 overflow-hidden rounded-full bg-surface-raised">
                        <div
                            class="h-full rounded-full bg-brand transition-all"
                            style="width: {{ $promisedAmount > 0 ? min(100, max(0, ($paidAmount / $promisedAmount) * 100)) : 0 }}%"
                        ></div>
                    </div>
                </div>

                <div class="rounded-xl border border-line p-4">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-muted">إجمالي المبلغ الموعود</span>
                        <span class="text-xs font-extrabold text-text">
                            {{ number_format($promisedAmount, 2) }} ج.م
                        </span>
                    </div>

                    <div class="my-3 border-t border-line"></div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-muted">إجمالي المدفوع</span>
                        <span class="text-xs font-extrabold text-text">
                            {{ number_format($paidAmount, 2) }} ج.م
                        </span>
                    </div>

                    <div class="my-3 border-t border-line"></div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-muted">المتبقي من الوعد</span>
                        <span class="text-xs font-extrabold text-text">
                            {{ number_format($remainingAmount, 2) }} ج.م
                        </span>
                    </div>
                </div>

                @if ($isOverdue)
                    <div class="flex items-start gap-3 rounded-xl border border-line p-3">
                        <i class="fa-solid fa-triangle-exclamation mt-0.5 text-amber-500"></i>
                        <div>
                            <p class="text-xs font-bold text-text">
                                موعد السداد تجاوز التاريخ المحدد
                            </p>
                            <p class="mt-1 text-[11px] leading-6 text-muted">
                                يرجى مراجعة حالة الوعد والتأكد من تسجيل أي تحصيلات مرتبطة به.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </x-panel>

        {{-- Notes --}}
        <div class="xl:col-span-2">
            <x-panel title="ملاحظات الوعد" icon="fa-note-sticky">
                @if (filled($promise->notes))
                    <p class="whitespace-pre-line break-words text-xs leading-7 text-muted">{{ $promise->notes }}</p>
                @else
                    <div class="flex items-center gap-3 py-2">
                        <i class="fa-regular fa-note-sticky text-dim"></i>
                        <p class="text-xs text-muted">
                            لا توجد ملاحظات مسجلة لهذا الوعد.
                        </p>
                    </div>
                @endif
            </x-panel>
        </div>
    </div>
@endsection