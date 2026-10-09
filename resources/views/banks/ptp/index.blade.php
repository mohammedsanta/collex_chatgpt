@extends('layouts.app')

@section('title', 'وعود السداد')

@section('content')
<div class="space-y-6" dir="rtl">

    {{-- Page Header --}}
    <x-page-header
        title="وعود السداد"
        subtitle="متابعة التزامات العملاء بالسداد ومراجعة نتائج الوعود"
    >
        <x-slot name="actions">
            <a
                href="{{ route('banks.ptp.create', ['bank' => $bank->id]) }}"
                class="app-btn app-btn-primary"
            >
                <i class="fa-solid fa-plus"></i>
                تسجيل وعد سداد
            </a>
        </x-slot>
    </x-page-header>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-emerald-300">
            <i class="fa-solid fa-circle-check ml-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Bank Information --}}
    <x-panel>
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400">
                    <i class="fa-solid fa-building-columns text-2xl"></i>
                </div>

                <div>
                    <p class="text-sm text-gray-400">البنك الحالي</p>
                    <h2 class="mt-1 text-xl font-bold text-white">
                        {{ $bank->name }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        إدارة ومتابعة وعود السداد الخاصة بالبنك
                    </p>
                </div>
            </div>

            <a
                href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                class="app-btn app-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right ml-2"></i>
                العودة للمحافظ
            </a>
        </div>
    </x-panel>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <x-panel>
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-400">إجمالي الوعود</p>
                    <p class="mt-3 text-3xl font-bold text-white">
                        {{ number_format($stats['total']) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500/10 text-sky-400">
                    <i class="fa-solid fa-handshake text-xl"></i>
                </div>
            </div>
        </x-panel>

        <x-panel>
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-400">وعود نشطة</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        {{ number_format($stats['active']) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">
                    <i class="fa-solid fa-calendar-check text-xl"></i>
                </div>
            </div>
        </x-panel>

        <x-panel>
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-400">وعود قيد المراجعة</p>
                    <p class="mt-3 text-3xl font-bold text-amber-400">
                        {{ number_format($stats['review']) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">
                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                </div>
            </div>
        </x-panel>

        <x-panel>
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-400">قيمة الوعود المفتوحة</p>
                    <p class="mt-3 text-2xl font-bold text-white">
                        {{ number_format($stats['promised_amount'], 2) }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">بالعملة المستخدمة في النظام</p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-500/10 text-violet-400">
                    <i class="fa-solid fa-money-bill-wave text-xl"></i>
                </div>
            </div>
        </x-panel>

    </div>

    {{-- Search and Filters --}}
    <x-panel>
        <form
            method="GET"
            action="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
            class="grid grid-cols-1 items-end gap-4 md:grid-cols-3"
        >
            <div>
                <label for="search" class="mb-2 block text-sm font-medium text-gray-300">
                    البحث
                </label>

                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"></i>

                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="اسم العميل أو رقم الحالة أو الملاحظات..."
                        class="w-full rounded-xl border border-white/10 bg-gray-900 py-3 pr-10 pl-4 text-sm text-white placeholder:text-gray-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                    >
                </div>
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium text-gray-300">
                    حالة الوعد
                </label>

                <select
                    id="status"
                    name="status"
                    class="w-full rounded-xl border border-white/10 bg-gray-900 px-4 py-3 text-sm text-white focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"
                >
                    <option value="">كل الحالات</option>
                    <option value="active" @selected($status === 'active')>نشط</option>
                    <option value="review" @selected($status === 'review')>قيد المراجعة</option>
                    <option value="kept" @selected($status === 'kept')>تم الوفاء</option>
                    <option value="partial" @selected($status === 'partial')>وفاء جزئي</option>
                    <option value="broken" @selected($status === 'broken')>لم يتم الوفاء</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-filter ml-2"></i>
                    تطبيق
                </button>

                <a
                    href="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
                    class="app-btn app-btn-secondary"
                >
                    <i class="fa-solid fa-rotate-left ml-2"></i>
                    إعادة ضبط
                </a>
            </div>
        </form>
    </x-panel>

    {{-- Promises Table --}}
    <x-panel>
        <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h3 class="text-lg font-bold text-white">سجل وعود السداد</h3>
                <p class="mt-1 text-sm text-gray-400">
                    متابعة مواعيد السداد والقيم المتعهد بها وحالة كل وعد
                </p>
            </div>

            <span class="text-sm text-gray-400">
                النتائج: {{ number_format($promises->total()) }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-right text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-4 py-4 font-medium">رقم الوعد</th>
                        <th class="px-4 py-4 font-medium">العميل</th>
                        <th class="px-4 py-4 font-medium">رقم الحالة</th>
                        <th class="px-4 py-4 font-medium">المحفظة</th>
                        <th class="px-4 py-4 font-medium">قيمة الوعد</th>
                        <th class="px-4 py-4 font-medium">تاريخ السداد</th>
                        <th class="px-4 py-4 font-medium">الحالة</th>
                        <th class="px-4 py-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @forelse ($promises as $promise)
                        @php
                            $statusLabels = [
                                'active' => 'نشط',
                                'review' => 'قيد المراجعة',
                                'kept' => 'تم الوفاء',
                                'partial' => 'وفاء جزئي',
                                'broken' => 'لم يتم الوفاء',
                            ];

                            $statusClasses = [
                                'active' => 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/20',
                                'review' => 'bg-amber-500/10 text-amber-400 ring-amber-500/20',
                                'kept' => 'bg-sky-500/10 text-sky-400 ring-sky-500/20',
                                'partial' => 'bg-orange-500/10 text-orange-400 ring-orange-500/20',
                                'broken' => 'bg-red-500/10 text-red-400 ring-red-500/20',
                            ];

                            $promiseStatus = $promise->status;
                        @endphp

                        <tr class="transition hover:bg-white/[0.025]">
                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-emerald-400">
                                #{{ $promise->id }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-medium text-white">
                                    {{ $promise->debtCase?->client?->name ?? 'غير محدد' }}
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    وعد سداد
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-gray-300">
                                #{{ $promise->debt_case_id }}
                            </td>

                            <td class="px-4 py-4 text-gray-300">
                                {{ $promise->debtCase?->portfolio?->name ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-white">
                                {{ number_format((float) $promise->promised_amount, 2) }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-gray-300">
                                {{ $promise->promise_date?->format('Y-m-d') ?? $promise->promise_date ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium ring-1 {{ $statusClasses[$promiseStatus] ?? 'bg-gray-500/10 text-gray-400 ring-gray-500/20' }}">
                                    {{ $statusLabels[$promiseStatus] ?? $promiseStatus }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ route('banks.ptp.edit', ['bank' => $bank->id, 'promise' => $promise->id]) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 text-gray-300 transition hover:border-emerald-500/40 hover:bg-emerald-500/10 hover:text-emerald-400"
                                        title="تعديل الوعد"
                                        aria-label="تعديل الوعد"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-16 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-800 text-gray-500">
                                    <i class="fa-solid fa-handshake text-2xl"></i>
                                </div>

                                <h4 class="mt-4 text-base font-semibold text-white">
                                    لا توجد وعود سداد
                                </h4>

                                <p class="mt-2 text-sm text-gray-400">
                                    لم يتم العثور على وعود سداد تطابق معايير البحث الحالية.
                                </p>

                                <a
                                    href="{{ route('banks.ptp.create', ['bank' => $bank->id]) }}"
                                    class="app-btn app-btn-primary mt-5"
                                >
                                    <i class="fa-solid fa-plus ml-2"></i>
                                    تسجيل وعد سداد
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($promises->hasPages())
            <div class="mt-5 border-t border-white/10 pt-5">
                {{ $promises->links() }}
            </div>
        @endif
    </x-panel>

</div>
@endsection