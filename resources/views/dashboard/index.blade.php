@extends('layouts.app')

@section('title', 'نظرة عامة | Collex')
@section('topbar-title', 'نظرة عامة')

@section('content')
    @php
        $money = static fn ($value) => number_format((float) $value, 2);

        $paymentStatuses = [
            'pending' => [
                'label' => 'قيد المراجعة',
                'class' => 'app-badge app-badge-orange',
            ],
            'confirmed' => [
                'label' => 'مؤكد',
                'class' => 'app-badge app-badge-green',
            ],
            'rejected' => [
                'label' => 'مرفوض',
                'class' => 'app-badge app-badge-red',
            ],
        ];
    @endphp

    <div class="space-y-6" dir="rtl">

        {{-- Page Header --}}
        <x-page-header
            title="نظرة عامة"
            subtitle="ملخص أداء المحفظة والتحصيل وحالة العمليات."
            eyebrow="الرئيسية"
            icon="fa-solid fa-chart-line"
        />

        {{-- Quick Actions --}}
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('clients.index') }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-users ms-1"></i>
                إدارة العملاء
            </a>

            <a href="{{ route('payments.create') }}" class="app-btn app-btn-primary">
                <i class="fa-solid fa-plus ms-1"></i>
                تسجيل تحصيل
            </a>
        </div>

        {{-- KPI Cards --}}
        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-stat-card
                label="إجمالي العملاء"
                :value="number_format($stats['clients'])"
                icon="fa-solid fa-users"
                color="blue"
                hint="العملاء المسجلون حاليًا"
            />

            <x-stat-card
                label="القضايا النشطة"
                :value="number_format($stats['active_cases'])"
                icon="fa-solid fa-folder-open"
                color="green"
                hint="القضايا ذات الحالة النشطة"
            />

            <x-stat-card
                label="إجمالي المديونية"
                :value="$money($stats['total_debt']) . ' ج.م'"
                icon="fa-solid fa-wallet"
                color="purple"
                hint="إجمالي مديونية القضايا النشطة"
            />

            <x-stat-card
                label="المتأخرات"
                :value="$money($stats['overdue_amount']) . ' ج.م'"
                icon="fa-solid fa-triangle-exclamation"
                color="orange"
                :hint="number_format($stats['overdue_cases']) . ' قضية متأخرة'"
            />
        </section>

        {{-- Collection Summary --}}
        <section class="grid grid-cols-1 gap-4 xl:grid-cols-3">

            <div class="app-card xl:col-span-2">
                <div class="app-card-header flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h2 class="font-semibold text-fg">ملخص التحصيل</h2>
                        <p class="mt-1 text-sm text-muted">
                            المبالغ التي تم تأكيد تحصيلها.
                        </p>
                    </div>

                    <a href="{{ route('payments.index') }}"
                       class="text-sm font-semibold text-brand hover:underline">
                        جميع المدفوعات
                        <i class="fa-solid fa-arrow-left me-1"></i>
                    </a>
                </div>

                <div class="app-card-body space-y-8">

                    {{-- Daily and Monthly Totals --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-xl border border-line p-5">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm text-muted">التحصيل اليوم</p>
                                <span class="app-badge app-badge-green">اليوم</span>
                            </div>

                            <p class="mt-4 text-2xl font-bold text-brand tabular-nums">
                                {{ $money($stats['confirmed_today']) }}
                                <span class="text-xs font-medium text-muted">ج.م</span>
                            </p>

                            <p class="mt-2 text-xs text-muted">
                                {{ now()->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-line p-5">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm text-muted">التحصيل هذا الشهر</p>
                                <span class="app-badge app-badge-blue">شهري</span>
                            </div>

                            <p class="mt-4 text-2xl font-bold text-fg tabular-nums">
                                {{ $money($stats['confirmed_this_month']) }}
                                <span class="text-xs font-medium text-muted">ج.م</span>
                            </p>

                            <p class="mt-2 text-xs text-muted">
                                {{ now()->format('m/Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Monthly Collection Chart --}}
                    <div>
                        <div class="mb-5 flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-sm font-semibold text-fg">
                                    حركة التحصيل
                                </h3>
                                <p class="mt-1 text-xs text-muted">
                                    التحصيل المؤكد خلال آخر ستة أشهر.
                                </p>
                            </div>

                            <span class="text-xs text-muted">ج.م</span>
                        </div>

                        <div class="grid grid-cols-6 gap-2 sm:gap-4" style="height: 210px">
                            @foreach ($monthlyCollections as $month)
                                @php
                                    $amount = (float) $month['amount'];

                                    $barHeight = $amount > 0
                                        ? max(5, ($amount / $maxMonthlyCollection) * 100)
                                        : 2;
                                @endphp

                                <div class="flex min-w-0 flex-col items-center">
                                    <div class="flex w-full flex-1 items-end justify-center">
                                        <div
                                            class="w-full max-w-14 rounded-t-lg bg-brand/70 transition hover:bg-brand"
                                            style="height: {{ $barHeight }}%"
                                            title="{{ $month['label'] }} {{ $month['year'] }}: {{ $money($amount) }} ج.م"
                                        ></div>
                                    </div>

                                    <p class="mt-3 w-full truncate text-center text-[10px] text-muted"
                                       title="{{ $money($amount) }} ج.م">
                                        {{ $amount > 0 ? $money($amount) : '—' }}
                                    </p>

                                    <p class="mt-1 text-xs text-muted">
                                        {{ $month['label'] }}
                                    </p>

                                    <p class="text-[10px] text-dim">
                                        {{ $month['year'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Confirmed Total --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 border-t border-line pt-5">
                        <p class="text-sm text-muted">إجمالي التحصيل المؤكد</p>

                        <p class="text-lg font-bold text-brand tabular-nums">
                            {{ $money($stats['confirmed_total']) }}
                            <span class="text-xs font-medium text-muted">ج.م</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Side Cards --}}
            <div class="space-y-4">

                <div class="app-card">
                    <div class="app-card-body">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm text-muted">مدفوعات قيد المراجعة</p>

                                <p class="mt-3 text-3xl font-bold text-warning tabular-nums">
                                    {{ number_format($stats['pending_payments']) }}
                                </p>

                                <p class="mt-2 text-xs leading-5 text-muted">
                                    عمليات تنتظر التأكيد أو الرفض.
                                </p>
                            </div>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-warning/10 text-warning">
                                <i class="fa-solid fa-clock text-lg"></i>
                            </div>
                        </div>

                        <a href="{{ route('payments.confirmations') }}"
                           class="app-btn app-btn-secondary mt-5 w-full justify-center">
                            مراجعة المدفوعات
                        </a>
                    </div>
                </div>

                <div class="app-card">
                    <div class="app-card-header">
                        <h2 class="font-semibold text-fg">إجراءات سريعة</h2>
                        <p class="mt-1 text-sm text-muted">
                            اختصارات للعمليات اليومية.
                        </p>
                    </div>

                    <div class="app-card-body space-y-2">
                        <a href="{{ route('clients.create') }}"
                           class="flex items-center justify-between gap-3 rounded-lg border border-line p-3 text-sm text-fg transition hover:border-brand/50 hover:text-brand">
                            <span>إضافة عميل جديد</span>
                            <i class="fa-solid fa-user-plus text-brand"></i>
                        </a>

                        <a href="{{ route('payments.create') }}"
                           class="flex items-center justify-between gap-3 rounded-lg border border-line p-3 text-sm text-fg transition hover:border-brand/50 hover:text-brand">
                            <span>تسجيل دفعة جديدة</span>
                            <i class="fa-solid fa-plus text-brand"></i>
                        </a>

                        <a href="{{ route('payments.index') }}"
                           class="flex items-center justify-between gap-3 rounded-lg border border-line p-3 text-sm text-fg transition hover:border-brand/50 hover:text-brand">
                            <span>عرض كل المدفوعات</span>
                            <i class="fa-solid fa-arrow-left text-brand"></i>
                        </a>
                    </div>
                </div>

                <div class="app-card">
                    <div class="app-card-body">
                        <p class="text-sm text-muted">حالة لوحة التحكم</p>

                        <div class="mt-4 flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-brand"></span>
                            <span class="text-sm font-semibold text-fg">
                                لوحة التحكم جاهزة للعرض
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-muted">
                            وقت عرض البيانات:
                            {{ now()->format('Y-m-d H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Recent Payments --}}
        <section class="app-card overflow-hidden">
            <div class="app-card-header flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-semibold text-fg">أحدث المدفوعات</h2>
                    <p class="mt-1 text-sm text-muted">
                        آخر ثماني عمليات مسجلة في النظام.
                    </p>
                </div>

                <a href="{{ route('payments.index') }}"
                   class="text-sm font-semibold text-brand hover:underline">
                    عرض جميع المدفوعات
                    <i class="fa-solid fa-arrow-left me-1"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="app-table w-full">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">رقم الإيصال</th>
                            <th class="whitespace-nowrap">العميل</th>
                            <th class="whitespace-nowrap">المحصّل</th>
                            <th class="whitespace-nowrap">تاريخ الدفع</th>
                            <th class="whitespace-nowrap">المبلغ</th>
                            <th class="whitespace-nowrap">الحالة</th>
                            <th class="whitespace-nowrap">التفاصيل</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recentPayments as $payment)
                            @php
                                $status = $paymentStatuses[$payment->status] ?? [
                                    'label' => $payment->status,
                                    'class' => 'app-badge app-badge-gray',
                                ];
                            @endphp

                            <tr>
                                <td class="whitespace-nowrap font-mono text-xs text-muted">
                                    {{ $payment->receipt_number }}
                                </td>

                                <td>
                                    <p class="font-semibold text-fg">
                                        {{ $payment->debtCase?->client?->name ?? 'عميل غير متاح' }}
                                    </p>

                                    <p class="mt-1 text-xs text-muted">
                                        {{ $payment->debtCase?->loan_number ?? 'بدون رقم قرض' }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap text-fg">
                                    {{ $payment->collector?->name ?? 'غير محدد' }}
                                </td>

                                <td class="whitespace-nowrap text-muted">
                                    {{ $payment->paid_at?->format('Y-m-d H:i') ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap font-semibold text-fg tabular-nums">
                                    {{ $money($payment->amount) }}
                                    <span class="text-xs font-normal text-muted">ج.م</span>
                                </td>

                                <td class="whitespace-nowrap">
                                    <span class="{{ $status['class'] }}">
                                        {{ $status['label'] }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap">
                                    <a
                                        href="{{ route('payments.show', $payment) }}"
                                        class="text-sm font-semibold text-brand hover:underline"
                                    >
                                        فتح التفاصيل
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center">
                                    <div class="app-empty">
                                        <i class="fa-solid fa-receipt mb-3 text-2xl text-muted"></i>

                                        <p class="font-semibold text-fg">
                                            لا توجد مدفوعات حتى الآن
                                        </p>

                                        <p class="mt-2 text-sm text-muted">
                                            ستظهر عمليات التحصيل هنا بمجرد تسجيلها.
                                        </p>

                                        <a
                                            href="{{ route('payments.create') }}"
                                            class="app-btn app-btn-primary mt-5"
                                        >
                                            <i class="fa-solid fa-plus ms-1"></i>
                                            تسجيل أول دفعة
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="flex flex-col items-center justify-between gap-2 border-t border-line pt-5 text-xs text-muted sm:flex-row">
            <span>Collex · نظام إدارة التحصيل</span>
            <span>آخر تحديث للعرض: {{ now()->format('Y-m-d H:i') }}</span>
        </footer>
    </div>
@endsection
