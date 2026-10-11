@extends('layouts.app')

@section('title', 'وعود السداد | Collex')
@section('topbar-title', 'إدارة وعود السداد')

@section('content')
    @php
        $statusLabels = [
            'active' => 'نشط',
            'kept' => 'تم الوفاء',
            'broken' => 'لم يتم الوفاء',
            'cancelled' => 'ملغي',
        ];

        $statusClasses = [
            'active' => 'app-badge-blue',
            'kept' => 'app-badge-green',
            'broken' => 'app-badge-red',
            'cancelled' => 'app-badge-gray',
        ];
    @endphp

    <x-page-header
        title="وعود السداد"
        subtitle="متابعة الوعود المسجلة، مواعيد الاستحقاق، والمبالغ المتوقع تحصيلها."
        eyebrow="التحصيلات / وعود السداد"
        icon="fa-handshake"
    >
        <x-slot:actions>
            <span class="app-badge app-badge-gray">
                <i class="fa-solid fa-list-check"></i>
                {{ number_format($promises->total()) }} وعد
            </span>

            <a href="{{ route('ptp.create') }}" class="app-btn app-btn-primary">
                <i class="fa-solid fa-plus"></i>
                تسجيل وعد سداد
            </a>
        </x-slot:actions>
    </x-page-header>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="app-flash app-flash-success" role="status">
            <i class="fa-solid fa-circle-check mt-1"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="app-flash app-flash-error" role="alert">
            <i class="fa-solid fa-circle-exclamation mt-1"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Statistics --}}
    <div class="mb-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-stat-card
            label="إجمالي الوعود"
            :value="number_format($statistics['total'])"
            icon="fa-handshake"
            color="blue"
            hint="جميع الوعود المسجلة"
        />

        <x-stat-card
            label="وعود نشطة"
            :value="number_format($statistics['active'])"
            icon="fa-hourglass-half"
            color="green"
            hint="وعود لم يتم إغلاقها"
        />

        <x-stat-card
            label="مستحقة اليوم"
            :value="number_format($statistics['due_today'])"
            icon="fa-calendar-day"
            color="orange"
            hint="موعد السداد اليوم"
        />

        <x-stat-card
            label="وعود متأخرة"
            :value="number_format($statistics['overdue'])"
            icon="fa-calendar-xmark"
            color="red"
            hint="تجاوزت موعد السداد"
        />
    </div>

    {{-- Financial summary --}}
    <div class="mb-5 grid gap-4 md:grid-cols-2">
        <x-panel title="إجمالي المبالغ الموعودة" icon="fa-coins">
            <p class="text-2xl font-black text-fg num">
                {{ number_format((float) $statistics['promised_amount'], 2) }}
                <span class="text-xs font-bold text-muted">ج.م</span>
            </p>
            <p class="mt-2 text-[10px] text-dim">
                قيمة الوعود النشطة فقط
            </p>
        </x-panel>

        <x-panel title="إجمالي المبالغ المسددة" icon="fa-money-bill-transfer">
            <p class="text-2xl font-black text-brand num">
                {{ number_format((float) $statistics['paid_amount'], 2) }}
                <span class="text-xs font-bold text-muted">ج.م</span>
            </p>
            <p class="mt-2 text-[10px] text-dim">
                إجمالي المبالغ المسجلة على الوعود
            </p>
        </x-panel>
    </div>

    {{-- Search and filters --}}
    <div class="mb-5">
        <x-panel title="البحث والتصفية" icon="fa-filter">
            <form method="GET" action="{{ route('ptp.index') }}">
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-[10px] font-bold text-dim">
                            البحث
                        </label>

                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-dim"></i>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ $filters['search'] ?? '' }}"
                                placeholder="اسم العميل، الرقم القومي، رقم القرض أو الموظف"
                                class="app-input w-full pr-10"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-[10px] font-bold text-dim">
                            حالة الوعد
                        </label>

                        <select id="status" name="status" class="app-input w-full">
                            <option value="">كل الحالات</option>

                            @foreach ($statusLabels as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected(($filters['status'] ?? '') === $value)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="date_from" class="mb-2 block text-[10px] font-bold text-dim">
                            موعد السداد من
                        </label>

                        <input
                            id="date_from"
                            type="date"
                            name="date_from"
                            value="{{ $filters['date_from'] ?? '' }}"
                            class="app-input w-full"
                        >
                    </div>

                    <div>
                        <label for="date_to" class="mb-2 block text-[10px] font-bold text-dim">
                            موعد السداد إلى
                        </label>

                        <input
                            id="date_to"
                            type="date"
                            name="date_to"
                            value="{{ $filters['date_to'] ?? '' }}"
                            class="app-input w-full"
                        >
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        تطبيق الفلاتر
                    </button>

                    <a href="{{ route('ptp.index') }}" class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-left"></i>
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </x-panel>
    </div>

    {{-- Promises table --}}
    <x-panel title="قائمة وعود السداد" icon="fa-list-check">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <p class="text-[11px] text-muted">
                عرض {{ $promises->firstItem() ?? 0 }}
                إلى {{ $promises->lastItem() ?? 0 }}
                من {{ number_format($promises->total()) }} وعد
            </p>

            <span class="text-[10px] text-dim">
                المبالغ بالجنيه المصري
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="app-table w-full min-w-[1100px]">
                <thead>
                    <tr>
                        <th>العميل / القرض</th>
                        <th>البنك</th>
                        <th>موظف التحصيل</th>
                        <th>موعد السداد</th>
                        <th>المبلغ الموعود</th>
                        <th>المبلغ المسدد</th>
                        <th>المتبقي</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($promises as $promise)
                        @php
                            $status = strtolower((string) $promise->status);
                            $statusLabel = $statusLabels[$status] ?? $status;
                            $statusClass = $statusClasses[$status] ?? 'app-badge-gray';

                            $remaining = max(
                                0,
                                (float) $promise->promised_amount
                                - (float) $promise->paid_amount
                            );

                            $isOverdue = $status === 'active'
                                && $promise->promise_date < now()->toDateString();
                        @endphp

                        <tr>
                            <td>
                                <span class="font-extrabold text-fg">
                                    {{ $promise->client_name ?? '—' }}
                                </span>

                                <p class="mt-1 text-[10px] text-dim">
                                    قرض: {{ $promise->loan_number ?? '—' }}
                                </p>

                                @if ($promise->national_id)
                                    <p class="mt-1 text-[10px] text-dim">
                                        {{ $promise->national_id }}
                                    </p>
                                @endif
                            </td>

                            <td>
                                <span class="text-xs text-muted">
                                    {{ $promise->bank_name ?? '—' }}
                                </span>
                            </td>

                            <td>
                                <span class="text-xs font-semibold text-fg">
                                    {{ $promise->collector_name ?? '—' }}
                                </span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold {{ $isOverdue ? 'text-red-400' : 'text-fg' }}">
                                    {{ \Illuminate\Support\Carbon::parse($promise->promise_date)->format('Y-m-d') }}
                                </span>

                                @if ($isOverdue)
                                    <p class="mt-1 text-[10px] font-bold text-red-400">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        متأخر
                                    </p>
                                @endif
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold text-fg">
                                    {{ number_format((float) $promise->promised_amount, 2) }}
                                </span>
                                <span class="text-[10px] text-dim">ج.م</span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold text-brand">
                                    {{ number_format((float) $promise->paid_amount, 2) }}
                                </span>
                                <span class="text-[10px] text-dim">ج.م</span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold {{ $remaining > 0 ? 'text-orange-400' : 'text-brand' }}">
                                    {{ number_format($remaining, 2) }}
                                </span>
                                <span class="text-[10px] text-dim">ج.م</span>
                            </td>

                            <td>
                                <span class="app-badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>
                                <div class="flex items-center gap-1">
                                    <a
                                        href="{{ route('ptp.show', $promise->id) }}"
                                        class="app-btn app-btn-secondary !min-h-8 !px-3 !py-1.5"
                                        title="عرض التفاصيل"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('ptp.edit', $promise->id) }}"
                                        class="app-btn app-btn-secondary !min-h-8 !px-3 !py-1.5"
                                        title="تعديل الوعد"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center">
                                    <i class="fa-solid fa-handshake mb-3 text-3xl text-dim"></i>

                                    <p class="text-sm font-extrabold text-fg">
                                        لا توجد وعود سداد
                                    </p>

                                    <p class="mt-2 text-xs text-dim">
                                        لم يتم العثور على وعود مطابقة لمعايير البحث.
                                    </p>

                                    <a href="{{ route('ptp.create') }}" class="app-btn app-btn-primary mt-4">
                                        <i class="fa-solid fa-plus"></i>
                                        تسجيل وعد سداد
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($promises->hasPages())
            <div class="mt-5 border-t border-white/5 pt-4">
                {{ $promises->links() }}
            </div>
        @endif
    </x-panel>
@endsection
