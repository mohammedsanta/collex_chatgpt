@extends('layouts.app')

@section('title', $complaint->subject ?? 'تفاصيل الشكوى')

@section('content')
@php
    $priorityLabels = [
        'low' => 'منخفضة',
        'medium' => 'متوسطة',
        'high' => 'عالية',
        'urgent' => 'عاجلة',
    ];

    $statusLabels = [
        'open' => 'مفتوحة',
        'in_review' => 'قيد المراجعة',
        'resolved' => 'تم الحل',
        'rejected' => 'مرفوضة',
        'closed' => 'مغلقة',
    ];

    $sourceLabels = [
        'phone' => 'هاتف',
        'whatsapp' => 'واتساب',
        'email' => 'بريد إلكتروني',
        'bank' => 'البنك',
        'visit' => 'زيارة ميدانية',
        'branch' => 'فرع البنك',
    ];

    $priority = $complaint->priority ?? 'medium';
    $status = $complaint->status ?? 'open';
    $source = $complaint->source ?? '';

    $priorityLabel = $priorityLabels[$priority] ?? $priority;
    $statusLabel = $statusLabels[$status] ?? $status;
    $sourceLabel = $sourceLabels[$source] ?? '—';

    $priorityClasses = [
        'low' => 'border-sky-400/20 bg-sky-400/10 text-sky-300',
        'medium' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
        'high' => 'border-orange-400/20 bg-orange-400/10 text-orange-300',
        'urgent' => 'border-red-400/20 bg-red-400/10 text-red-300',
    ];

    $statusClasses = [
        'open' => 'border-blue-400/20 bg-blue-400/10 text-blue-300',
        'in_review' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
        'resolved' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
        'rejected' => 'border-red-400/20 bg-red-400/10 text-red-300',
        'closed' => 'border-gray-400/20 bg-gray-400/10 text-gray-300',
    ];

    $priorityClass = $priorityClasses[$priority]
        ?? 'border-white/10 bg-white/5 text-gray-300';

    $statusClass = $statusClasses[$status]
        ?? 'border-white/10 bg-white/5 text-gray-300';

    $bank = $bank ?? null;

    $editUrl = null;

    if ($bank && \Illuminate\Support\Facades\Route::has('banks.complaints.edit')) {
        $editUrl = route('banks.complaints.edit', [
            'bank' => $bank->id,
            'complaint' => $complaint->id,
        ]);
    }

    $complaintDate = fn ($date) => $date
        ? \Illuminate\Support\Carbon::parse($date)->format('Y-m-d H:i')
        : '—';
@endphp

<div dir="rtl" class="min-h-screen bg-[#0b0f0d] px-4 py-6 text-gray-100 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-start">
        <div>
            <div class="mb-3 flex flex-wrap items-center gap-2 text-sm text-gray-400">
                @if ($bank)
                    <a
                        href="{{ route('banks.show', ['bank' => $bank->id]) }}"
                        class="transition hover:text-lime-400"
                    >
                        البنوك
                    </a>

                    <span>/</span>

                    @if (\Illuminate\Support\Facades\Route::has('banks.complaints.index'))
                        <a
                            href="{{ route('banks.complaints.index', ['bank' => $bank->id]) }}"
                            class="transition hover:text-lime-400"
                        >
                            الشكاوى
                        </a>
                    @else
                        <span>الشكاوى</span>
                    @endif

                    <span>/</span>
                @endif

                <span class="text-gray-300">تفاصيل الشكوى</span>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-lime-400/20 bg-lime-400/10 text-xl text-lime-400">
                    <i class="fa-solid fa-message"></i>
                </span>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                        {{ $complaint->subject ?? 'تفاصيل الشكوى' }}
                    </h1>

                    <p class="mt-2 text-sm text-gray-400">
                        مراجعة بيانات الشكوى والأطراف المعنية وسجل المعالجة.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if ($editUrl)
                <a
                    href="{{ $editUrl }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-lime-400 px-5 py-3 font-bold text-gray-950 transition hover:bg-lime-300"
                >
                    <i class="fa-solid fa-pen-to-square"></i>
                    تعديل الشكوى
                </a>
            @endif

            @if ($bank && \Illuminate\Support\Facades\Route::has('banks.complaints.index'))
                <a
                    href="{{ route('banks.complaints.index', ['bank' => $bank->id]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 px-5 py-3 font-semibold text-gray-300 transition hover:bg-white/5 hover:text-white"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    العودة للقائمة
                </a>
            @endif
        </div>
    </div>

    {{-- Complaint Overview --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-gray-400">رقم الشكوى</span>

                <span class="rounded-xl bg-lime-400/10 p-3 text-lime-400">
                    <i class="fa-solid fa-hashtag"></i>
                </span>
            </div>

            <p class="mt-4 break-words text-xl font-bold text-white">
                {{ $complaint->reference_number ?? '—' }}
            </p>

            <p class="mt-2 text-xs text-gray-500">
                الرقم المرجعي للمتابعة
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-gray-400">حالة الشكوى</span>

                <span class="rounded-xl bg-blue-400/10 p-3 text-blue-300">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
            </div>

            <div class="mt-4">
                <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-sm font-semibold {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>

            <p class="mt-3 text-xs text-gray-500">
                الحالة الحالية للمعالجة
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-gray-400">الأولوية</span>

                <span class="rounded-xl bg-orange-400/10 p-3 text-orange-300">
                    <i class="fa-solid fa-flag"></i>
                </span>
            </div>

            <div class="mt-4">
                <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-sm font-semibold {{ $priorityClass }}">
                    {{ $priorityLabel }}
                </span>
            </div>

            <p class="mt-3 text-xs text-gray-500">
                مستوى أولوية متابعة الشكوى
            </p>
        </div>

    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-5 xl:grid-cols-[1.2fr_.8fr]">

        {{-- Complaint Details --}}
        <section class="overflow-hidden rounded-2xl border border-white/10 bg-[#121915]">
            <div class="flex items-center gap-3 border-b border-white/10 px-5 py-5 sm:px-7">
                <span class="rounded-xl bg-lime-400/10 p-3 text-lime-400">
                    <i class="fa-solid fa-file-lines"></i>
                </span>

                <div>
                    <h2 class="font-bold">تفاصيل الشكوى</h2>
                    <p class="mt-1 text-xs text-gray-500">
                        وصف المشكلة والبيانات المسجلة
                    </p>
                </div>
            </div>

            <div class="space-y-6 p-5 sm:p-7">

                <div>
                    <p class="mb-2 text-xs font-semibold text-gray-400">
                        موضوع الشكوى
                    </p>

                    <p class="text-sm font-bold leading-7 text-white">
                        {{ $complaint->subject ?? 'بدون عنوان' }}
                    </p>
                </div>

                <div class="border-t border-white/10 pt-5">
                    <p class="mb-2 text-xs font-semibold text-gray-400">
                        وصف الشكوى
                    </p>

                    <div class="rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                        <p class="whitespace-pre-line break-words text-sm leading-7 text-gray-300">{{ $complaint->description ?: 'لم يتم تسجيل وصف للشكوى.' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    <div>
                        <p class="mb-2 text-xs font-semibold text-gray-400">
                            مصدر الشكوى
                        </p>

                        <div class="flex items-center gap-2 text-sm text-gray-200">
                            <i class="fa-solid fa-inbox text-gray-500"></i>
                            {{ $sourceLabel }}
                        </div>
                    </div>

                    <div>
                        <p class="mb-2 text-xs font-semibold text-gray-400">
                            موعد الاستحقاق
                        </p>

                        <div class="flex items-center gap-2 text-sm text-gray-200">
                            <i class="fa-regular fa-calendar text-gray-500"></i>
                            {{ $complaintDate($complaint->due_at) }}
                        </div>
                    </div>

                    <div>
                        <p class="mb-2 text-xs font-semibold text-gray-400">
                            تاريخ تسجيل الشكوى
                        </p>

                        <div class="flex items-center gap-2 text-sm text-gray-200">
                            <i class="fa-regular fa-clock text-gray-500"></i>
                            {{ $complaintDate($complaint->created_at) }}
                        </div>
                    </div>

                    <div>
                        <p class="mb-2 text-xs font-semibold text-gray-400">
                            آخر تحديث
                        </p>

                        <div class="flex items-center gap-2 text-sm text-gray-200">
                            <i class="fa-solid fa-rotate text-gray-500"></i>
                            {{ $complaintDate($complaint->updated_at) }}
                        </div>
                    </div>

                </div>

                <div class="border-t border-white/10 pt-5">
                    <p class="mb-2 text-xs font-semibold text-gray-400">
                        الإجراء المتخذ / الحل
                    </p>

                    <div class="rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                        <p class="whitespace-pre-line break-words text-sm leading-7 text-gray-300">{{ $complaint->resolution ?: 'لم يتم تسجيل حل أو إجراء نهائي حتى الآن.' }}</p>
                    </div>
                </div>

                @if ($complaint->resolved_at)
                    <div class="flex items-start gap-3 rounded-xl border border-emerald-400/20 bg-emerald-400/5 p-4">
                        <span class="mt-0.5 text-emerald-300">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        <div>
                            <p class="text-sm font-bold text-emerald-300">
                                تم تسجيل حل الشكوى
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                تاريخ الحل: {{ $complaintDate($complaint->resolved_at) }}
                            </p>
                        </div>
                    </div>
                @endif

            </div>
        </section>

        {{-- Involved Parties --}}
        <section class="overflow-hidden rounded-2xl border border-white/10 bg-[#121915]">
            <div class="flex items-center gap-3 border-b border-white/10 px-5 py-5 sm:px-7">
                <span class="rounded-xl bg-blue-400/10 p-3 text-blue-300">
                    <i class="fa-solid fa-users"></i>
                </span>

                <div>
                    <h2 class="font-bold">الأطراف المعنية</h2>
                    <p class="mt-1 text-xs text-gray-500">
                        بيانات العميل والموظفين المرتبطين بالشكوى
                    </p>
                </div>
            </div>

            <div class="space-y-5 p-5 sm:p-7">

                {{-- Client --}}
                <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-lime-400/10 text-lime-400">
                        <i class="fa-solid fa-user"></i>
                    </span>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-400">العميل</p>
                        <p class="mt-1 break-words text-sm font-bold text-white">
                            {{ $complaint->client?->name ?? 'غير مرتبط بعميل' }}
                        </p>
                    </div>
                </div>

                {{-- Logged By --}}
                <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-400/10 text-blue-300">
                        <i class="fa-solid fa-user-plus"></i>
                    </span>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-400">الموظف الذي سجّل الشكوى</p>
                        <p class="mt-1 break-words text-sm font-bold text-white">
                            {{ $complaint->loggedBy?->name ?? '—' }}
                        </p>
                    </div>
                </div>

                {{-- Assigned To --}}
                <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-400/10 text-purple-300">
                        <i class="fa-solid fa-user-check"></i>
                    </span>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-400">المسؤول عن المعالجة</p>
                        <p class="mt-1 break-words text-sm font-bold text-white">
                            {{ $complaint->assignedTo?->name ?? 'لم يتم الإسناد' }}
                        </p>
                    </div>
                </div>

                {{-- Bank --}}
                @if ($bank)
                    <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-[#0b0f0d] p-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                            <i class="fa-solid fa-building-columns"></i>
                        </span>

                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-400">البنك</p>
                            <p class="mt-1 break-words text-sm font-bold text-white">
                                {{ $bank->name }}
                            </p>
                        </div>
                    </div>
                @endif

            </div>
        </section>

    </div>

</div>
@endsection