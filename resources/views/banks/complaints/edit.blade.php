@extends('layouts.app')

@section('title', 'تعديل الشكوى')

@section('content')
@php
    $formFields = [
        [
            'name' => 'subject',
            'label' => 'موضوع الشكوى',
            'type' => 'text',
            'required' => true,
            'full' => true,
        ],
        [
            'name' => 'description',
            'label' => 'تفاصيل الشكوى',
            'type' => 'textarea',
            'required' => true,
            'full' => true,
        ],
        [
            'name' => 'source',
            'label' => 'مصدر الشكوى',
            'type' => 'select',
            'required' => false,
            'full' => false,
            'options' => [
                'phone' => 'هاتف',
                'whatsapp' => 'واتساب',
                'email' => 'بريد إلكتروني',
                'bank' => 'البنك',
                'visit' => 'زيارة ميدانية',
            ],
        ],
        [
            'name' => 'priority',
            'label' => 'الأولوية',
            'type' => 'select',
            'required' => true,
            'full' => false,
            'options' => [
                'low' => 'منخفضة',
                'medium' => 'متوسطة',
                'high' => 'عالية',
                'urgent' => 'عاجلة',
            ],
        ],
        [
            'name' => 'status',
            'label' => 'حالة الشكوى',
            'type' => 'select',
            'required' => true,
            'full' => false,
            'options' => [
                'open' => 'مفتوحة',
                'in_review' => 'قيد المراجعة',
                'resolved' => 'تم الحل',
                'rejected' => 'مرفوضة',
                'closed' => 'مغلقة',
            ],
        ],
        [
            'name' => 'due_at',
            'label' => 'موعد الاستحقاق',
            'type' => 'datetime-local',
            'required' => false,
            'full' => false,
        ],
        [
            'name' => 'resolution',
            'label' => 'الإجراء المتخذ / الحل',
            'type' => 'textarea',
            'required' => false,
            'full' => true,
        ],
    ];
@endphp

<div dir="rtl" class="min-h-screen space-y-6 bg-[#0b0f0d] text-gray-100">

    {{-- Page heading --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs text-gray-500">
                <a href="{{ route('banks.show', $bank) }}"
                   class="transition hover:text-lime-400">
                    البنوك
                </a>

                <i class="fa-solid fa-chevron-left text-[9px]"></i>

                <a href="{{ route('banks.complaints.index', ['bank' => $bank->id]) }}"
                   class="transition hover:text-lime-400">
                    الشكاوى
                </a>

                <i class="fa-solid fa-chevron-left text-[9px]"></i>

                <span class="text-gray-300">تعديل الشكوى</span>
            </div>

            <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">
                تعديل الشكوى
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                تحديث بيانات الشكوى ومتابعة حالة المعالجة.
            </p>
        </div>

        <a href="{{ route('banks.complaints.show', [
                'bank' => $bank->id,
                'complaint' => $complaint->id,
            ]) }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-[#121915] px-4 py-3 text-sm font-bold text-gray-300 transition hover:border-lime-400/40 hover:text-lime-400">
            <i class="fa-solid fa-arrow-right"></i>
            العودة للتفاصيل
        </a>
    </div>

    {{-- Complaint context --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <p class="text-xs font-semibold text-gray-500">رقم الشكوى</p>
            <p class="mt-3 text-lg font-extrabold text-lime-400">
                {{ $complaint->reference_number ?? '—' }}
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <p class="text-xs font-semibold text-gray-500">العميل</p>
            <p class="mt-3 text-sm font-bold text-gray-100">
                {{ $complaint->client?->name ?? 'غير مرتبط بعميل' }}
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5 sm:col-span-2 xl:col-span-1">
            <p class="text-xs font-semibold text-gray-500">تاريخ التسجيل</p>
            <p class="mt-3 text-sm font-bold text-gray-100">
                {{ $complaint->created_at?->format('Y-m-d H:i') ?? '—' }}
            </p>
        </div>
    </div>

    {{-- Edit form --}}
    <div class="rounded-2xl border border-white/10 bg-[#121915] p-5 sm:p-7">
        <div class="mb-6 flex items-center gap-3 border-b border-white/10 pb-5">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-lime-400/10 text-lime-400">
                <i class="fa-solid fa-pen-to-square text-lg"></i>
            </div>

            <div>
                <h2 class="font-bold text-gray-100">بيانات الشكوى</h2>
                <p class="mt-1 text-xs text-gray-500">
                    عدّل الحقول المطلوبة ثم احفظ التغييرات.
                </p>
            </div>
        </div>

        <x-module-form
            title="بيانات الشكوى"
            subtitle="تحديث بيانات الشكوى وحالة المعالجة."
            icon="fa-message"
            :fields="$formFields"
            action-route="banks.complaints.update"
            :route-parameters="[
                'bank' => $bank->id,
                'complaint' => $complaint->id,
            ]"
            back-route="banks.complaints.index"
            :back-route-parameters="['bank' => $bank->id]"
            :bank="$bank"
            :record="$complaint"
            :editing="true"
            submit-label="حفظ التعديلات"
        />
    </div>
</div>
@endsection