@extends('layouts.app')

@section('title', 'تفاصيل وعد السداد')
@section('topbar-title', 'تفاصيل وعد السداد')

@section('content')
    @php
        $status = strtolower((string) $promise->status);

        $statusLabels = [
            'active' => 'نشط',
            'kept' => 'تم الوفاء',
            'broken' => 'لم يتم الوفاء',
            'cancelled' => 'ملغي',
        ];

        $statusClasses = [
            'active' => 'app-badge-yellow',
            'kept' => 'app-badge-green',
            'broken' => 'app-badge-red',
            'cancelled' => 'app-badge-gray',
        ];

        $debtCase = $promise->debtCase;
        $client = $debtCase?->client;
        $portfolio = $debtCase?->portfolio;
        $bank = $portfolio?->bank;

        $promisedAmount = (float) $promise->promised_amount;
        $paidAmount = (float) ($promise->paid_amount ?? 0);
        $remainingAmount = max(0, $promisedAmount - $paidAmount);
    @endphp

    <div class="space-y-6" dir="rtl">

        <x-page-header
            title="تفاصيل وعد السداد"
            subtitle="عرض بيانات الوعد والعميل وملف المديونية المرتبط به."
            eyebrow="التحصيلات"
            icon="fa-handshake"
        >
            <x-slot:actions>
                <a
                    href="{{ route('ptp.index') }}"
                    class="app-btn app-btn-secondary"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    العودة للقائمة
                </a>

                @can('update', $promise)
                    <a
                        href="{{ route('ptp.edit', $promise->id) }}"
                        class="app-btn app-btn-primary"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                        تعديل الوعد
                    </a>
                @endcan
            </x-slot:actions>
        </x-page-header>

        @if (session('success'))
            <div class="app-flash app-flash-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="app-flash app-flash-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Promise summary --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <x-stat-card
                label="المبلغ الموعود"
                :value="number_format($promisedAmount, 2) . ' ج.م'"
                icon="fa-money-bill-wave"
                color="blue"
                hint="إجمالي المبلغ المتعهد بسداده"
            />

            <x-stat-card
                label="المبلغ المسدد"
                :value="number_format($paidAmount, 2) . ' ج.م'"
                icon="fa-circle-check"
                color="green"
                hint="المبلغ المسجل كمسدد على الوعد"
            />

            <x-stat-card
                label="المتبقي من الوعد"
                :value="number_format($remainingAmount, 2) . ' ج.م'"
                icon="fa-wallet"
                color="yellow"
                hint="المبلغ الموعود ناقص المسدد"
            />

            <x-stat-card
                label="رقم الوعد"
                :value="'#' . $promise->id"
                icon="fa-hashtag"
                color="blue"
                hint="المعرف الداخلي لوعد السداد"
            />

        </div>

        {{-- Promise details --}}
        <x-panel title="بيانات وعد السداد" icon="fa-handshake">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

                <div>
                    <p class="text-xs text-muted">حالة الوعد</p>

                    <div class="mt-2">
                        <span class="app-badge {{ $statusClasses[$status] ?? 'app-badge-gray' }}">
                            {{ $statusLabels[$status] ?? ($status ?: 'غير محدد') }}
                        </span>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-muted">تاريخ السداد الموعود</p>

                    <p class="mt-2 font-bold text-fg">
                        {{ $promise->promise_date
                            ? \Illuminate\Support\Carbon::parse($promise->promise_date)->format('Y-m-d')
                            : '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">تاريخ إنشاء الوعد</p>

                    <p class="mt-2 font-bold text-fg">
                        {{ $promise->created_at?->format('Y-m-d H:i') ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">المبلغ الموعود</p>

                    <p class="num mt-2 font-extrabold text-fg">
                        {{ number_format($promisedAmount, 2) }} ج.م
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">المبلغ المسدد</p>

                    <p class="num mt-2 font-extrabold text-brand">
                        {{ number_format($paidAmount, 2) }} ج.م
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">المتبقي</p>

                    <p class="num mt-2 font-extrabold {{ $remainingAmount > 0 ? 'text-warning' : 'text-brand' }}">
                        {{ number_format($remainingAmount, 2) }} ج.م
                    </p>
                </div>

                <div class="sm:col-span-2 xl:col-span-3">
                    <p class="text-xs text-muted">ملاحظات</p>

                    <div class="mt-2 rounded-xl border border-line bg-white/[0.02] p-4 text-sm leading-7 text-fg">
                        {{ filled($promise->notes) ? $promise->notes : 'لا توجد ملاحظات مسجلة.' }}
                    </div>
                </div>

            </div>
        </x-panel>

        {{-- Client details --}}
        <x-panel title="بيانات العميل" icon="fa-user">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

                <div>
                    <p class="text-xs text-muted">اسم العميل</p>

                    <p class="mt-2 font-bold text-fg">
                        {{ $client?->name ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">الرقم القومي</p>

                    <p class="num mt-2 font-bold text-fg">
                        {{ $client?->national_id ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">رقم ملف المديونية</p>

                    <p class="num mt-2 font-bold text-fg">
                        {{ $debtCase?->loan_number ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">البنك</p>

                    <p class="mt-2 font-bold text-fg">
                        {{ $bank?->name ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">النطاق</p>

                    <p class="mt-2 font-bold text-fg">
                        {{ $portfolio?->name ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-muted">معرف ملف المديونية</p>

                    <p class="num mt-2 font-bold text-fg">
                        {{ $debtCase?->id ?? '—' }}
                    </p>
                </div>

            </div>
        </x-panel>

    </div>
@endsection
