
@extends('layouts.app')

@section('title', 'نظرة عامة | Collex')

@section('content')
@php
    $money = static fn ($value) => number_format((float) $value, 2);

    $paymentStatuses = [
        'pending' => [
            'label' => 'قيد المراجعة',
            'class' => 'border-amber-500/30 bg-amber-500/10 text-amber-400',
        ],
        'confirmed' => [
            'label' => 'مؤكد',
            'class' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400',
        ],
        'rejected' => [
            'label' => 'مرفوض',
            'class' => 'border-rose-500/30 bg-rose-500/10 text-rose-400',
        ],
    ];
@endphp

<div class="-m-4 min-h-screen bg-[#0b0f12] p-4 text-white md:-m-6 md:p-6">
    <div class="mx-auto max-w-[1600px] space-y-6">

        {{-- Header --}}
        <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-400">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    COLLEX / OVERVIEW
                </div>

                <h1 class="mt-3 text-2xl font-bold tracking-tight text-white md:text-3xl">
                    نظرة عامة
                </h1>

                <p class="mt-2 text-sm text-slate-400">
                    ملخص أداء المحفظة والتحصيل وحالة العمليات.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('clients.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-900 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:border-emerald-400/50 hover:text-emerald-400">
                    <span>إدارة العملاء</span>
                    <span aria-hidden="true">↗</span>
                </a>

                <a href="{{ route('payments.create') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-400 px-4 py-3 text-sm font-bold text-slate-950 transition hover:bg-emerald-300">
                    <span aria-hidden="true">＋</span>
                    تسجيل تحصيل
                </a>
            </div>
        </section>

        {{-- KPI cards --}}
        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5 transition hover:border-slate-700">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-400">إجمالي العملاء</p>
                        <p class="mt-4 text-3xl font-bold text-white tabular-nums">
                            {{ number_format($stats['clients']) }}
                        </p>
                        <p class="mt-2 text-xs text-slate-500">العملاء المسجلون حاليًا</p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-sky-500/20 bg-sky-500/10 text-xl text-sky-400">
                        ♙
                    </div>
                </div>

                <a href="{{ route('clients.index') }}"
                   class="mt-5 inline-flex items-center gap-2 text-xs font-semibold text-sky-400 hover:text-sky-300">
                    عرض العملاء <span aria-hidden="true">←</span>
                </a>
            </article>

            <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5 transition hover:border-slate-700">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-400">القضايا النشطة</p>
                        <p class="mt-4 text-3xl font-bold text-white tabular-nums">
                            {{ number_format($stats['active_cases']) }}
                        </p>
                        <p class="mt-2 text-xs text-slate-500">قضايا بحالة نشطة</p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-xl text-emerald-400">
                        ▤
                    </div>
                </div>

                <p class="mt-5 text-xs text-slate-500">
                    تشمل القضايا النشطة فقط
                </p>
            </article>

            <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5 transition hover:border-slate-700">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-400">إجمالي المديونية</p>
                        <p class="mt-4 text-2xl font-bold text-white tabular-nums">
                            {{ $money($stats['total_debt']) }}
                            <span class="text-xs font-medium text-slate-400">ج.م</span>
                        </p>
                        <p class="mt-2 text-xs text-slate-500">للقضايا النشطة</p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-violet-500/20 bg-violet-500/10 text-xl text-violet-400">
                        ◈
                    </div>
                </div>

                <p class="mt-5 text-xs text-slate-500">
                    إجمالي قيمة المديونية المسجلة
                </p>
            </article>

            <article class="rounded-2xl border border-rose-500/20 bg-[#11171b] p-5 transition hover:border-rose-500/40">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-400">المتأخرات</p>
                        <p class="mt-4 text-2xl font-bold text-rose-400 tabular-nums">
                            {{ $money($stats['overdue_amount']) }}
                            <span class="text-xs font-medium text-slate-400">ج.م</span>
                        </p>
                        <p class="mt-2 text-xs text-slate-500">
                            {{ number_format($stats['overdue_cases']) }} قضية متأخرة
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-rose-500/20 bg-rose-500/10 text-xl text-rose-400">
                        !
                    </div>
                </div>

                <p class="mt-5 text-xs text-rose-400/80">
                    تحتاج إلى متابعة التحصيل
                </p>
            </article>

        </section>

        {{-- Collection summary --}}
        <section class="grid grid-cols-1 gap-4 xl:grid-cols-3">

            <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5 md:p-6 xl:col-span-2">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-white">ملخص التحصيل</h2>
                        <p class="mt-1 text-sm text-slate-400">
                            المبالغ التي تم تأكيد تحصيلها.
                        </p>
                    </div>

                    <a href="{{ route('payments.index') }}"
                       class="text-sm font-semibold text-emerald-400 hover:text-emerald-300">
                        جميع المدفوعات ←
                    </a>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-slate-800 bg-[#0b0f12] p-5">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm text-slate-400">التحصيل اليوم</p>
                            <span class="rounded-lg bg-emerald-500/10 px-2 py-1 text-xs text-emerald-400">
                                اليوم
                            </span>
                        </div>

                        <p class="mt-4 text-2xl font-bold text-emerald-400 tabular-nums">
                            {{ $money($stats['confirmed_today']) }}
                            <span class="text-xs font-medium text-slate-400">ج.م</span>
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ now()->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-800 bg-[#0b0f12] p-5">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm text-slate-400">التحصيل هذا الشهر</p>
                            <span class="rounded-lg bg-sky-500/10 px-2 py-1 text-xs text-sky-400">
                                شهري
                            </span>
                        </div>

                        <p class="mt-4 text-2xl font-bold text-white tabular-nums">
                            {{ $money($stats['confirmed_this_month']) }}
                            <span class="text-xs font-medium text-slate-400">ج.م</span>
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ now()->format('m/Y') }}
                        </p>
                    </div>
                </div>

                {{-- Monthly chart --}}
                <div class="mt-8">
                    <div class="mb-5 flex items-center justify-between gap-3">
                        <div>
                            <h3 class="text-sm font-bold text-slate-200">
                                حركة التحصيل
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">
                                مقارنة إجمالي التحصيل المؤكد خلال آخر 6 أشهر.
                            </p>
                        </div>

                        <span class="text-xs text-slate-500">ج.م</span>
                    </div>

                    <div class="grid grid-cols-6 gap-2 sm:gap-4" style="height: 210px">
                        @foreach($monthlyCollections as $month)
                            @php
                                $amount = (float) $month['amount'];

                                $barHeight = $amount > 0
                                    ? max(5, ($amount / $maxMonthlyCollection) * 100)
                                    : 2;
                            @endphp

                            <div class="flex min-w-0 flex-col items-center">
                                <div class="flex w-full flex-1 items-end justify-center">
                                    <div class="w-full max-w-14 rounded-t-lg bg-emerald-400/80 transition hover:bg-emerald-300"
                                         style="height: {{ $barHeight }}%"
                                         title="{{ $month['label'] }} {{ $month['year'] }}: {{ $money($amount) }} ج.م">
                                    </div>
                                </div>

                                <p class="mt-3 w-full truncate text-center text-[10px] text-slate-400"
                                   title="{{ $money($amount) }} ج.م">
                                    {{ $amount > 0 ? $money($amount) : '—' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $month['label'] }}
                                </p>

                                <p class="text-[10px] text-slate-600">
                                    {{ $month['year'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 border-t border-slate-800 pt-5">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm text-slate-400">إجمالي التحصيل المؤكد</p>
                        <p class="text-lg font-bold text-emerald-400 tabular-nums">
                            {{ $money($stats['confirmed_total']) }}
                            <span class="text-xs font-medium text-slate-400">ج.م</span>
                        </p>
                    </div>
                </div>
            </article>

            {{-- Side cards --}}
            <div class="space-y-4">

                <article class="rounded-2xl border border-amber-500/20 bg-[#11171b] p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm text-slate-400">مدفوعات قيد المراجعة</p>
                            <p class="mt-3 text-3xl font-bold text-amber-400 tabular-nums">
                                {{ number_format($stats['pending_payments']) }}
                            </p>
                            <p class="mt-2 text-xs leading-5 text-slate-500">
                                عمليات تنتظر التأكيد أو الرفض.
                            </p>
                        </div>

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-amber-500/20 bg-amber-500/10 text-xl text-amber-400">
                            ◷
                        </div>
                    </div>

                    <a href="{{ route('payments.confirmations') }}"
                       class="mt-5 flex w-full items-center justify-center rounded-xl border border-amber-500/30 px-4 py-3 text-sm font-semibold text-amber-400 transition hover:bg-amber-500/10">
                        مراجعة المدفوعات
                    </a>
                </article>

                <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5">
                    <h2 class="font-bold text-white">إجراءات سريعة</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        اختصارات للعمليات اليومية.
                    </p>

                    <div class="mt-4 space-y-2">
                        <a href="{{ route('clients.create') }}"
                           class="flex items-center justify-between gap-3 rounded-xl border border-slate-800 bg-[#0b0f12] px-4 py-3 text-sm text-slate-300 transition hover:border-emerald-500/40 hover:text-emerald-400">
                            <span>إضافة عميل جديد</span>
                            <span class="text-lg text-emerald-400" aria-hidden="true">＋</span>
                        </a>

                        <a href="{{ route('payments.create') }}"
                           class="flex items-center justify-between gap-3 rounded-xl border border-slate-800 bg-[#0b0f12] px-4 py-3 text-sm text-slate-300 transition hover:border-emerald-500/40 hover:text-emerald-400">
                            <span>تسجيل دفعة جديدة</span>
                            <span class="text-lg text-emerald-400" aria-hidden="true">＋</span>
                        </a>

                        <a href="{{ route('payments.index') }}"
                           class="flex items-center justify-between gap-3 rounded-xl border border-slate-800 bg-[#0b0f12] px-4 py-3 text-sm text-slate-300 transition hover:border-emerald-500/40 hover:text-emerald-400">
                            <span>عرض كل المدفوعات</span>
                            <span class="text-lg text-emerald-400" aria-hidden="true">←</span>
                        </a>
                    </div>
                </article>

                <article class="rounded-2xl border border-slate-800 bg-[#11171b] p-5">
                    <p class="text-sm text-slate-400">حالة النظام</p>

                    <div class="mt-4 flex items-center gap-3">
                        <span class="relative flex h-3 w-3">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-50"></span>
                            <span class="relative inline-flex h-3 w-3 rounded-full bg-emerald-400"></span>
                        </span>

                        <span class="text-sm font-semibold text-emerald-400">
                            لوحة التحكم جاهزة
                        </span>
                    </div>

                    <p class="mt-3 text-xs leading-5 text-slate-500">
                        وقت عرض البيانات:
                        {{ now()->format('Y-m-d H:i') }}
                    </p>
                </article>

            </div>
        </section>

        {{-- Recent payments --}}
        <section class="overflow-hidden rounded-2xl border border-slate-800 bg-[#11171b]">
            <div class="flex flex-col gap-3 border-b border-slate-800 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-white">أحدث المدفوعات</h2>
                    <p class="mt-1 text-sm text-slate-400">
                        آخر 8 عمليات مسجلة في النظام.
                    </p>
                </div>

                <a href="{{ route('payments.index') }}"
                   class="text-sm font-semibold text-emerald-400 hover:text-emerald-300">
                    عرض جميع المدفوعات ←
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-right text-sm">
                    <thead class="bg-[#0b0f12] text-xs text-slate-400">
                        <tr>
                            <th class="px-5 py-4 font-semibold">رقم الإيصال</th>
                            <th class="px-5 py-4 font-semibold">العميل</th>
                            <th class="px-5 py-4 font-semibold">المحصّل</th>
                            <th class="px-5 py-4 font-semibold">تاريخ الدفع</th>
                            <th class="px-5 py-4 font-semibold">المبلغ</th>
                            <th class="px-5 py-4 font-semibold">الحالة</th>
                            <th class="px-5 py-4 font-semibold">التفاصيل</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-800">
                        @forelse($recentPayments as $payment)
                            @php
                                $status = $paymentStatuses[$payment->status] ?? [
                                    'label' => $payment->status,
                                    'class' => 'border-slate-700 bg-slate-800 text-slate-300',
                                ];
                            @endphp

                            <tr class="transition hover:bg-slate-800/30">
                                <td class="whitespace-nowrap px-5 py-4 font-mono text-xs text-slate-300">
                                    {{ $payment->receipt_number }}
                                </td>

                                <td class="px-5 py-4">
                                    <p class="font-semibold text-white">
                                        {{ $payment->debtCase?->client?->name ?? 'عميل غير متاح' }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $payment->debtCase?->loan_number ?? 'بدون رقم قرض' }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-slate-300">
                                    {{ $payment->collector?->name ?? 'غير محدد' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-slate-400">
                                    {{ $payment->paid_at?->format('Y-m-d H:i') ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-white tabular-nums">
                                    {{ $money($payment->amount) }}
                                    <span class="text-xs font-normal text-slate-500">ج.م</span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex whitespace-nowrap rounded-full border px-3 py-1 text-xs font-semibold {{ $status['class'] }}">
                                        {{ $status['label'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <a href="{{ route('payments.show', $payment) }}"
                                       class="font-semibold text-emerald-400 hover:text-emerald-300">
                                        فتح التفاصيل
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-14 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-700 bg-slate-900 text-xl text-slate-400">
                                        ◷
                                    </div>

                                    <p class="mt-4 font-semibold text-white">
                                        لا توجد مدفوعات حتى الآن
                                    </p>

                                    <p class="mt-2 text-sm text-slate-500">
                                        ستظهر عمليات التحصيل هنا بمجرد تسجيلها.
                                    </p>

                                    <a href="{{ route('payments.create') }}"
                                       class="mt-5 inline-flex rounded-xl bg-emerald-400 px-4 py-2.5 text-sm font-bold text-slate-950 transition hover:bg-emerald-300">
                                        تسجيل أول دفعة
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="flex flex-col items-center justify-between gap-2 border-t border-slate-800 pt-5 text-xs text-slate-600 sm:flex-row">
            <span>Collex · نظام إدارة التحصيل</span>
            <span>آخر تحديث للعرض: {{ now()->format('Y-m-d H:i') }}</span>
        </footer>

    </div>
</div>
@endsection