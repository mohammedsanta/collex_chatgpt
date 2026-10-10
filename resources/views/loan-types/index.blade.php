@extends('layouts.app')

@section('title', 'أنواع القروض | Collex')

@section('content')
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm text-emerald-400">COLLEX / الإدارة</p>
            <h1 class="mt-1 text-2xl font-bold">أنواع القروض</h1>
            <p class="mt-1 text-sm text-slate-400">
                إدارة أنواع القروض المتاحة داخل النظام.
            </p>
        </div>

        @can('create', \App\Domain\Institutions\Models\LoanType::class)
            <a
                href="{{ route('loan-types.create') }}"
                class="rounded-lg bg-emerald-400 px-4 py-2.5 font-bold text-slate-950 transition hover:bg-emerald-300"
            >
                + إضافة نوع قرض
            </a>
        @endcan
    </div>

    {{-- Statistics --}}
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">إجمالي الأنواع</p>
            <p class="mt-3 text-3xl font-bold num">
                {{ number_format($statistics['total']) }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">الأنواع النشطة</p>
            <p class="mt-3 text-3xl font-bold text-emerald-400 num">
                {{ number_format($statistics['active']) }}
            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">الأنواع غير النشطة</p>
            <p class="mt-3 text-3xl font-bold text-slate-300 num">
                {{ number_format($statistics['inactive']) }}
            </p>
        </div>
    </div>

    {{-- Search and Filters --}}
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <form
            method="GET"
            action="{{ route('loan-types.index') }}"
            class="grid gap-3 md:grid-cols-[1fr_220px_auto]"
        >
            <input
                type="search"
                name="search"
                value="{{ $filters['search'] ?? '' }}"
                placeholder="ابحث باسم نوع القرض..."
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-emerald-400 focus:outline-none"
            >

            <select
                name="status"
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
            >
                <option value="">كل الحالات</option>
                <option value="active" @selected(($filters['status'] ?? '') === 'active')>
                    نشط
                </option>
                <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>
                    غير نشط
                </option>
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="rounded-lg bg-slate-700 px-5 py-3 font-semibold transition hover:bg-slate-600"
                >
                    بحث
                </button>

                <a
                    href="{{ route('loan-types.index') }}"
                    class="rounded-lg border border-slate-700 px-4 py-3 transition hover:bg-slate-800"
                >
                    إعادة
                </a>
            </div>
        </form>
    </section>

    {{-- Loan Types Table --}}
    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800 p-5">
            <div>
                <h2 class="font-semibold">سجلات أنواع القروض</h2>
                <p class="mt-1 text-sm text-slate-400">
                    عدد النتائج: {{ number_format($loanTypes->total()) }}
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3">#</th>
                        <th class="whitespace-nowrap px-4 py-3">اسم نوع القرض</th>
                        <th class="whitespace-nowrap px-4 py-3">ملفات القروض المرتبطة</th>
                        <th class="whitespace-nowrap px-4 py-3">الحالة</th>
                        <th class="whitespace-nowrap px-4 py-3">تاريخ الإضافة</th>
                        <th class="whitespace-nowrap px-4 py-3">الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($loanTypes as $loanType)
                        <tr class="border-t border-slate-800 transition hover:bg-slate-800/50">
                            <td class="whitespace-nowrap px-4 py-4 text-slate-400 num">
                                {{ $loanType->id }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold">
                                {{ $loanType->name }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-300 num">
                                {{ number_format($loanType->debt_cases_count) }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                @if ($loanType->is_active)
                                    <span class="rounded-lg bg-emerald-400/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">
                                        نشط
                                    </span>
                                @else
                                    <span class="rounded-lg bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-300">
                                        غير نشط
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-400 num">
                                {{ $loanType->created_at?->format('Y-m-d') ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <div class="flex items-center gap-3">
                                    @can('update', $loanType)
                                        <a
                                            href="{{ route('loan-types.edit', $loanType) }}"
                                            class="font-semibold text-emerald-400 hover:text-emerald-300"
                                        >
                                            تعديل
                                        </a>
                                    @endcan

                                    @if ($loanType->is_active)
                                        @can('deactivate', $loanType)
                                            <form
                                                method="POST"
                                                action="{{ route('loan-types.deactivate', $loanType) }}"
                                            >
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="font-semibold text-amber-400 hover:text-amber-300"
                                                >
                                                    تعطيل
                                                </button>
                                            </form>
                                        @endcan
                                    @else
                                        @can('activate', $loanType)
                                            <form
                                                method="POST"
                                                action="{{ route('loan-types.activate', $loanType) }}"
                                            >
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="font-semibold text-emerald-400 hover:text-emerald-300"
                                                >
                                                    تفعيل
                                                </button>
                                            </form>
                                        @endcan

                                        @if ($loanType->debt_cases_count === 0)
                                            @can('delete', $loanType)
                                                <form
                                                    method="POST"
                                                    action="{{ route('loan-types.destroy', $loanType) }}"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف نوع القرض؟')"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="font-semibold text-rose-400 hover:text-rose-300"
                                                    >
                                                        حذف
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <p class="font-semibold text-slate-200">
                                    لا توجد أنواع قروض مطابقة.
                                </p>
                                <p class="mt-2 text-sm text-slate-400">
                                    جرّب تغيير البحث أو الفلاتر.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($loanTypes->hasPages())
            <div class="border-t border-slate-800 p-4">
                {{ $loanTypes->links() }}
            </div>
        @endif
    </section>
</div>
@endsection