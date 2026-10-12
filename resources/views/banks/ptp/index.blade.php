@extends('layouts.app')

@section('title', 'وعود السداد')

@section('content')
<div class="space-y-6" dir="rtl">

    {{-- Page Header --}}
    <x-page-header
        title="وعود السداد"
        subtitle="متابعة التزامات العملاء بالسداد ومراجعة نتائج الوعود"
        eyebrow="إدارة التحصيل"
        icon="fa-handshake"
    >
        <x-slot:actions>
            <a
                href="{{ route('banks.ptp.create', ['bank' => $bank->id]) }}"
                class="app-btn app-btn-primary"
            >
                <i class="fa-solid fa-plus"></i>
                تسجيل وعد سداد
            </a>
        </x-slot:actions>
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
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-surface-raised text-brand">
                    <i class="fa-solid fa-building-columns text-2xl"></i>
                </div>

                <div>
                    <p class="text-xs text-muted">البنك الحالي</p>
                    <h2 class="mt-1 text-lg font-extrabold text-text">
                        {{ $bank->name }}
                    </h2>
                    <p class="mt-1 text-xs text-dim">
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

        <x-stat-card
            label="إجمالي الوعود"
            :value="number_format((int) ($stats['total'] ?? 0))"
            icon="fa-handshake"
            color="blue"
        />

        <x-stat-card
            label="وعود نشطة"
            :value="number_format((int) ($stats['active'] ?? 0))"
            icon="fa-calendar-check"
            color="green"
        />

        <x-stat-card
            label="وعود قيد المراجعة"
            :value="number_format((int) ($stats['review'] ?? 0))"
            icon="fa-clock-rotate-left"
            color="orange"
        />

        <x-stat-card
            label="قيمة الوعود المفتوحة"
            :value="number_format((float) ($stats['promised_amount'] ?? 0), 2) . ' ج.م'"
            icon="fa-money-bill-wave"
            color="blue"
        />

    </div>

    {{-- Search and Filters --}}
    <x-panel title="البحث والتصفية" icon="fa-filter">
        <form
            method="GET"
            action="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
            class="grid grid-cols-1 items-end gap-4 md:grid-cols-3"
        >
            <div>
                <label for="search" class="mb-2 block text-xs font-semibold text-muted">
                    البحث
                </label>

                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-dim"></i>

                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="اسم العميل أو رقم الحالة أو الملاحظات..."
                        class="app-input w-full pr-10"
                    >
                </div>
            </div>

            <div>
                <label for="status" class="mb-2 block text-xs font-semibold text-muted">
                    حالة الوعد
                </label>

                <select
                    id="status"
                    name="status"
                    class="app-input w-full"
                >
                    <option value="">كل الحالات</option>
                    <option value="active" @selected(($status ?? '') === 'active')>نشط</option>
                    <option value="review" @selected(($status ?? '') === 'review')>قيد المراجعة</option>
                    <option value="kept" @selected(($status ?? '') === 'kept')>تم الوفاء</option>
                    <option value="partial" @selected(($status ?? '') === 'partial')>وفاء جزئي</option>
                    <option value="broken" @selected(($status ?? '') === 'broken')>لم يتم الوفاء</option>
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
                <h3 class="text-sm font-extrabold text-text">
                    سجل وعود السداد
                </h3>
                <p class="mt-1 text-xs text-muted">
                    متابعة مواعيد السداد والقيم المتعهد بها وحالة كل وعد
                </p>
            </div>

            <span class="text-xs text-muted">
                إجمالي النتائج:
                {{ number_format($promises->total()) }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="app-table w-full min-w-[1000px] text-right">
                <thead>
                    <tr>
                        <th class="px-4 py-3">رقم الوعد</th>
                        <th class="px-4 py-3">العميل</th>
                        <th class="px-4 py-3">رقم الحالة</th>
                        <th class="px-4 py-3">المحفظة</th>
                        <th class="px-4 py-3">قيمة الوعد</th>
                        <th class="px-4 py-3">تاريخ السداد</th>
                        <th class="px-4 py-3">الحالة</th>
                        <th class="px-4 py-3">الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($promises as $promise)
                        @php
                            $statusLabels = [
                                'active' => 'نشط',
                                'review' => 'قيد المراجعة',
                                'kept' => 'تم الوفاء',
                                'partial' => 'وفاء جزئي',
                                'broken' => 'لم يتم الوفاء',
                            ];

                            $statusColors = [
                                'active' => 'success',
                                'review' => 'warning',
                                'kept' => 'info',
                                'partial' => 'warning',
                                'broken' => 'danger',
                            ];

                            $promiseStatus = $promise->status ?? 'active';

                            $promiseDate = $promise->promise_date;
                            $formattedPromiseDate = $promiseDate
                                ? \Illuminate\Support\Carbon::parse($promiseDate)->format('Y-m-d')
                                : '—';
                        @endphp

                        <tr>
                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="font-bold text-brand">
                                    #{{ $promise->id }}
                                </span>
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-semibold text-text">
                                    {{ $promise->debtCase?->client?->name ?? 'غير محدد' }}
                                </div>
                                <div class="mt-1 text-[10px] text-dim">
                                    وعد سداد
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-muted">
                                #{{ $promise->debt_case_id ?? '—' }}
                            </td>

                            <td class="px-4 py-4 text-muted">
                                {{ $promise->debtCase?->portfolio?->name ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-text">
                                {{ number_format((float) ($promise->promised_amount ?? 0), 2) }}
                                <span class="text-[10px] text-dim">ج.م</span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-muted">
                                {{ $formattedPromiseDate }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <x-status-badge :status="$promiseStatus" />
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <div class="flex items-center gap-2">

                                    {{-- Show Promise Details --}}
                                    @if (\Illuminate\Support\Facades\Route::has('ptp.show'))
                                        <a
                                            href="{{ route('ptp.show', ['promise' => $promise->id]) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted transition hover:bg-surface-raised hover:text-brand"
                                            title="عرض تفاصيل الوعد"
                                            aria-label="عرض تفاصيل الوعد رقم {{ $promise->id }}"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    @endif

                                    {{-- Edit Promise --}}
                                    @if (\Illuminate\Support\Facades\Route::has('banks.ptp.edit'))
                                        <a
                                            href="{{ route('banks.ptp.edit', ['bank' => $bank->id, 'promise' => $promise->id]) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted transition hover:bg-surface-raised hover:text-brand"
                                            title="تعديل الوعد"
                                            aria-label="تعديل الوعد رقم {{ $promise->id }}"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-16 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-surface-raised text-dim">
                                    <i class="fa-solid fa-handshake text-xl"></i>
                                </div>

                                <h4 class="mt-4 text-sm font-bold text-text">
                                    لا توجد وعود سداد
                                </h4>

                                <p class="mt-2 text-xs text-muted">
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
            <div class="mt-5 border-t border-line pt-5">
                {{ $promises->withQueryString()->links() }}
            </div>
        @endif
    </x-panel>

</div>
@endsection