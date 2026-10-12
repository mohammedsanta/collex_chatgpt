@extends('layouts.app')

@section('title', 'تعديل وعد السداد')

@section('content')
    @php
        $formFields = [
            [
                'name' => 'promised_amount',
                'label' => 'المبلغ الموعود (ج.م)',
                'type' => 'number',
                'required' => true,
                'full' => false,
                'placeholder' => 'أدخل المبلغ الموعود',
                'help' => 'أدخل المبلغ المتفق على سداده.',
            ],
            [
                'name' => 'promise_date',
                'label' => 'تاريخ السداد المتفق عليه',
                'type' => 'date',
                'required' => true,
                'full' => false,
                'help' => 'حدد التاريخ المتفق عليه مع العميل.',
            ],
            [
                'name' => 'status',
                'label' => 'حالة الوعد',
                'type' => 'select',
                'required' => true,
                'full' => false,
                'options' => [
                    'active' => 'نشط',
                    'review' => 'قيد المراجعة',
                    'kept' => 'تم الوفاء',
                    'partial' => 'وفاء جزئي',
                    'broken' => 'لم يتم الوفاء',
                ],
            ],
            [
                'name' => 'notes',
                'label' => 'ملاحظات',
                'type' => 'textarea',
                'required' => false,
                'full' => true,
                'rows' => 4,
                'placeholder' => 'أضف تفاصيل أو ملاحظات متعلقة بوعد السداد...',
            ],
        ];

        $routeParameters = [
            'bank' => $bank->id,
            'promise' => $promise->id,
        ];
    @endphp

    <div class="space-y-6" dir="rtl">

        {{-- Page Header --}}
        <x-page-header
            title="تعديل وعد السداد"
            subtitle="تحديث المبلغ المتفق عليه وموعد السداد وحالة الوعد."
            eyebrow="وعود السداد / تعديل"
            icon="fa-handshake"
        >
            <x-slot:actions>
                <a
                    href="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
                    class="app-btn app-btn-secondary"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    العودة لوعود السداد
                </a>
            </x-slot:actions>
        </x-page-header>

        {{-- Promise Summary --}}
        <x-panel>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-surface-raised text-brand">
                        <i class="fa-solid fa-file-pen text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-extrabold text-text">
                            تعديل وعد رقم #{{ $promise->id }}
                        </h2>

                        <p class="mt-1 text-xs text-muted">
                            العميل:
                            {{ $promise->debtCase?->client?->name ?? 'غير محدد' }}
                        </p>
                    </div>
                </div>

                <div class="text-xs text-muted">
                    رقم الحالة:
                    <span class="font-bold text-text">
                        {{ $promise->debt_case_id ?? '—' }}
                    </span>
                </div>
            </div>
        </x-panel>

        {{-- Edit Form --}}
        <x-module-form
            title="بيانات وعد السداد"
            subtitle="عدّل البيانات المطلوبة ثم احفظ التغييرات."
            icon="fa-handshake"
            :fields="$formFields"
            action-route="banks.ptp.update"
            back-route="banks.ptp.index"
            :record="$promise"
            :editing="true"
            :route-parameters="$routeParameters"
            submit-label="حفظ التعديلات"
        />

        {{-- Editing Notice --}}
        <div class="flex items-start gap-3 rounded-xl border border-line bg-surface-raised p-4">
            <i class="fa-solid fa-circle-info mt-0.5 text-brand"></i>

            <div>
                <p class="text-xs font-bold text-text">
                    تنبيه
                </p>

                <p class="mt-1 text-xs leading-6 text-muted">
                    تأكد من مراجعة المبلغ والتاريخ والحالة قبل الحفظ.
                    لن تُسجّل أي تحصيلات فعلية بمجرد تعديل وعد السداد.
                </p>
            </div>
        </div>

    </div>
@endsection