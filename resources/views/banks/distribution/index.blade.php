
@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl space-y-6 px-4 py-8" dir="rtl">

    {{-- Page Header --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <a
                href="{{ route('banks.index') }}"
                class="text-sm text-gray-400 transition hover:text-lime-400"
            >
                ← العودة إلى البنوك
            </a>

            <h1 class="mt-3 text-2xl font-bold text-white">
                توزيع المحافظ
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                إدارة محافظ بنك {{ $bank->name }}
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('banks.clients.assign', ['bank' => $bank->id]) }}"
                class="rounded-xl border border-gray-700 px-5 py-3 text-sm font-semibold text-gray-200 transition hover:bg-gray-800"
            >
                توزيع الحالات
            </a>

            <a
                href="{{ route('banks.distribution.create', ['bank' => $bank->id]) }}"
                class="rounded-xl bg-lime-400 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-lime-300"
            >
                + إنشاء محفظة
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">
            <p class="mb-2 font-semibold">تعذر تنفيذ العملية:</p>

            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <div class="rounded-2xl border border-gray-800 bg-gray-900 p-5">
            <p class="text-sm text-gray-400">إجمالي المحافظ</p>

            <p class="mt-3 text-3xl font-bold text-white">
                {{ number_format((int) ($stats['portfolios_count'] ?? 0)) }}
            </p>
        </div>

        <div class="rounded-2xl border border-gray-800 bg-gray-900 p-5">
            <p class="text-sm text-gray-400">إجمالي الحالات</p>

            <p class="mt-3 text-3xl font-bold text-white">
                {{ number_format((int) ($stats['cases_count'] ?? 0)) }}
            </p>
        </div>

        <div class="rounded-2xl border border-gray-800 bg-gray-900 p-5">
            <p class="text-sm text-gray-400">إجمالي المديونية</p>

            <p class="mt-3 text-3xl font-bold text-lime-400">
                {{ number_format((float) ($stats['total_debt'] ?? 0), 2) }}
            </p>
        </div>

    </div>

    {{-- Portfolios Panel --}}
    <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900">

        {{-- Search --}}
        <div class="border-b border-gray-800 p-5">
            <form
                action="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                method="GET"
                class="flex flex-col gap-3 sm:flex-row"
            >
                <input
                    type="search"
                    name="search"
                    value="{{ $search ?? request('search') }}"
                    placeholder="ابحث باسم المحفظة أو الحالة أو السنة..."
                    class="min-w-0 flex-1 rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-white placeholder-gray-500 outline-none transition focus:border-lime-400"
                >

                <button
                    type="submit"
                    class="rounded-xl bg-lime-400 px-6 py-3 font-bold text-gray-950 transition hover:bg-lime-300"
                >
                    بحث
                </button>

                @if (filled($search ?? request('search')))
                    <a
                        href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                        class="rounded-xl border border-gray-700 px-5 py-3 text-center text-gray-300 transition hover:bg-gray-800"
                    >
                        مسح البحث
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-right text-sm">

                <thead class="border-b border-gray-800 bg-gray-800/50 text-gray-300">
                    <tr>
                        <th class="px-5 py-4 font-semibold">المحفظة</th>
                        <th class="px-5 py-4 font-semibold">الفترة</th>
                        <th class="px-5 py-4 font-semibold">عدد الحالات</th>
                        <th class="px-5 py-4 font-semibold">إجمالي المديونية</th>
                        <th class="px-5 py-4 font-semibold">الحالة</th>
                        <th class="px-5 py-4 font-semibold">تاريخ الإنشاء</th>
                        <th class="px-5 py-4 font-semibold">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">

                    @forelse ($portfolios as $portfolio)

                        <tr class="transition hover:bg-gray-800/40">

                            {{-- Portfolio Name --}}
                            <td class="px-5 py-4">
                                <div class="font-semibold text-white">
                                    {{ $portfolio->name }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    رقم المحفظة: #{{ $portfolio->id }}
                                </div>
                            </td>

                            {{-- Period --}}
                            <td class="px-5 py-4 text-gray-300">
                                {{ $portfolio->period_month }}/{{ $portfolio->period_year }}
                            </td>

                            {{-- Cases Count --}}
                            <td class="px-5 py-4 text-gray-300">
                                {{ number_format((int) ($portfolio->debt_cases_count ?? 0)) }}
                            </td>

                            {{-- Total Debt --}}
                            <td class="px-5 py-4 font-medium text-white">
                                {{ number_format((float) ($portfolio->debt_cases_sum_total_debt ?? 0), 2) }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                @switch($portfolio->status)

                                    @case('draft')
                                        <span class="inline-flex rounded-full border border-amber-500/30 bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-300">
                                            مسودة
                                        </span>
                                        @break

                                    @case('active')
                                        <span class="inline-flex rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">
                                            مفعّلة
                                        </span>
                                        @break

                                    @case('archived')
                                        <span class="inline-flex rounded-full border border-gray-600 bg-gray-800 px-3 py-1 text-xs font-semibold text-gray-400">
                                            مؤرشفة
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex rounded-full border border-gray-700 bg-gray-800 px-3 py-1 text-xs text-gray-300">
                                            {{ $portfolio->status }}
                                        </span>

                                @endswitch
                            </td>

                            {{-- Created At --}}
                            <td class="px-5 py-4 text-gray-400">
                                {{ $portfolio->created_at?->format('Y-m-d') ?? '—' }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap items-center gap-2">

                                    @if ($portfolio->status === 'draft')

                                        <form
                                            action="{{ route('banks.distribution.activate', [
                                                'bank' => $bank->id,
                                                'portfolio' => $portfolio->id,
                                            ]) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من تفعيل المحفظة: {{ addslashes($portfolio->name) }}؟')"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="rounded-lg bg-emerald-500 px-3 py-2 text-xs font-bold text-white transition hover:bg-emerald-400"
                                            >
                                                تفعيل المحفظة
                                            </button>
                                        </form>

                                    @elseif ($portfolio->status === 'active')

                                        <span class="text-xs text-emerald-400">
                                            المحفظة مفعّلة
                                        </span>

                                    @elseif ($portfolio->status === 'archived')

                                        <span class="text-xs text-gray-500">
                                            المحفظة مؤرشفة
                                        </span>

                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="7"
                                class="px-5 py-12 text-center"
                            >
                                <p class="text-base font-semibold text-gray-300">
                                    لا توجد محافظ
                                </p>

                                <p class="mt-2 text-sm text-gray-500">
                                    @if (filled($search ?? request('search')))
                                        لم يتم العثور على محافظ تطابق البحث.
                                    @else
                                        لم يتم إنشاء أي محفظة لهذا البنك حتى الآن.
                                    @endif
                                </p>

                                @if (! filled($search ?? request('search')))
                                    <a
                                        href="{{ route('banks.distribution.create', ['bank' => $bank->id]) }}"
                                        class="mt-4 inline-flex rounded-xl bg-lime-400 px-5 py-3 font-bold text-gray-950 transition hover:bg-lime-300"
                                    >
                                        إنشاء أول محفظة
                                    </a>
                                @endif
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($portfolios->hasPages())
            <div class="border-t border-gray-800 p-5">
                {{ $portfolios->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
