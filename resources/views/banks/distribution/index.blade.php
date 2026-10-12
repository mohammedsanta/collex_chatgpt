@extends('layouts.app')

@section('title', 'توزيع المحافظ | Collex')

@section('content')
    <x-page-header
        title="توزيع المحافظ"
        subtitle="إدارة محافظ التحصيل ومتابعة الحالات والمديونيات المرتبطة ببنك {{ $bank->name }}."
        eyebrow="إدارة المؤسسات"
        icon="fa-layer-group"
    />

    @php
        $currentSearch = $search ?? request('search');
    @endphp

    <div class="space-y-5">

        {{-- Navigation and Actions --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <a
                href="{{ route('banks.index') }}"
                class="inline-flex items-center gap-2 text-sm text-dim transition hover:text-main"
            >
                <i class="fa-solid fa-arrow-right text-xs"></i>
                العودة إلى البنوك
            </a>

            <div class="flex flex-wrap gap-3">
                <a
                    href="{{ route('banks.clients.assign', ['bank' => $bank->id]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-line px-4 py-2.5 text-sm font-semibold text-main transition hover:bg-surface"
                >
                    <i class="fa-solid fa-users-gear text-sm"></i>
                    توزيع الحالات
                </a>

                <a
                    href="{{ route('banks.distribution.create', ['bank' => $bank->id]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-bold text-slate-950 transition hover:opacity-90"
                >
                    <i class="fa-solid fa-plus text-sm"></i>
                    إنشاء محفظة
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="flex items-start gap-3 rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-emerald-300" role="status">
                <i class="fa-solid fa-circle-check mt-0.5"></i>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300" role="alert">
                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300" role="alert">
                <p class="mb-2 flex items-center gap-2 font-semibold">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    تعذر تنفيذ العملية
                </p>

                <ul class="list-inside list-disc space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Statistics --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <x-stat-card
                label="إجمالي المحافظ"
                :value="number_format((int) ($stats['portfolios_count'] ?? 0))"
                icon="fa-layer-group"
                color="green"
            />

            <x-stat-card
                label="إجمالي الحالات"
                :value="number_format((int) ($stats['cases_count'] ?? 0))"
                icon="fa-folder-open"
                color="blue"
            />

            <x-stat-card
                label="إجمالي المديونية"
                :value="number_format((float) ($stats['total_debt'] ?? 0), 2)"
                icon="fa-money-bill-wave"
                color="green"
            />
        </div>

        {{-- Portfolios Panel --}}
        <x-panel
            title="محافظ البنك"
            subtitle="عرض المحافظ وحالاتها وأعداد الحالات والمديونيات المسجلة."
            icon="fa-table-list"
        >
            {{-- Search --}}
            <form
                action="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                method="GET"
                class="mb-5 flex flex-col gap-3 sm:flex-row"
            >
                <div class="relative min-w-0 flex-1">
                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-dim"></i>

                    <input
                        type="search"
                        name="search"
                        value="{{ $currentSearch }}"
                        placeholder="ابحث باسم المحفظة أو الحالة أو السنة..."
                        aria-label="البحث في المحافظ"
                        class="w-full rounded-xl border border-line bg-surface py-3 pe-11 ps-4 text-main placeholder:text-dim outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/10"
                    >
                </div>

                <div class="flex flex-wrap gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-6 py-3 text-sm font-bold text-slate-950 transition hover:opacity-90"
                    >
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        بحث
                    </button>

                    @if (filled($currentSearch))
                        <a
                            href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-line px-5 py-3 text-sm font-semibold text-dim transition hover:bg-surface hover:text-main"
                        >
                            <i class="fa-solid fa-xmark text-xs"></i>
                            مسح البحث
                        </a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-line">
                <table class="w-full min-w-[950px] text-right text-sm">
                    <thead class="border-b border-line bg-surface text-dim">
                        <tr>
                            <th scope="col" class="px-5 py-4 font-semibold">المحفظة</th>
                            <th scope="col" class="px-5 py-4 font-semibold">الفترة</th>
                            <th scope="col" class="px-5 py-4 font-semibold">عدد الحالات</th>
                            <th scope="col" class="px-5 py-4 font-semibold">إجمالي المديونية</th>
                            <th scope="col" class="px-5 py-4 font-semibold">الحالة</th>
                            <th scope="col" class="px-5 py-4 font-semibold">تاريخ الإنشاء</th>
                            <th scope="col" class="px-5 py-4 font-semibold">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-line">
                        @forelse ($portfolios as $portfolio)
                            <tr class="transition hover:bg-surface/60">
                                {{-- Portfolio Name --}}
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-main">
                                        {{ $portfolio->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-dim">
                                        رقم المحفظة: #{{ $portfolio->id }}
                                    </div>
                                </td>

                                {{-- Period --}}
                                <td class="px-5 py-4 text-main">
                                    {{ $portfolio->period_month }}/{{ $portfolio->period_year }}
                                </td>

                                {{-- Cases Count --}}
                                <td class="px-5 py-4 text-main">
                                    {{ number_format((int) ($portfolio->debt_cases_count ?? 0)) }}
                                </td>

                                {{-- Total Debt --}}
                                <td class="px-5 py-4 font-semibold text-main">
                                    {{ number_format((float) ($portfolio->debt_cases_sum_total_debt ?? 0), 2) }}
                                    <span class="text-xs font-normal text-dim">ج.م</span>
                                </td>

                                {{-- Status --}}
                                <td class="px-5 py-4">
                                    @switch($portfolio->status)
                                        @case('draft')
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/30 bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-300">
                                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                                مسودة
                                            </span>
                                            @break

                                        @case('active')
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">
                                                <i class="fa-solid fa-circle-check text-[10px]"></i>
                                                مفعّلة
                                            </span>
                                            @break

                                        @case('archived')
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-line bg-surface px-3 py-1 text-xs font-semibold text-dim">
                                                <i class="fa-solid fa-box-archive text-[10px]"></i>
                                                مؤرشفة
                                            </span>
                                            @break

                                        @default
                                            <span class="inline-flex rounded-full border border-line px-3 py-1 text-xs text-dim">
                                                {{ $portfolio->status }}
                                            </span>
                                    @endswitch
                                </td>

                                {{-- Created At --}}
                                <td class="px-5 py-4 text-dim">
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
                                                onsubmit="return confirm('هل أنت متأكد من تفعيل هذه المحفظة؟')"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-brand/10 px-3 py-2 text-xs font-bold text-brand transition hover:bg-brand/20"
                                                >
                                                    <i class="fa-solid fa-check text-xs"></i>
                                                    تفعيل المحفظة
                                                </button>
                                            </form>
                                        @elseif ($portfolio->status === 'active')
                                            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-400">
                                                <i class="fa-solid fa-circle-check"></i>
                                                المحفظة مفعّلة
                                            </span>
                                        @elseif ($portfolio->status === 'archived')
                                            <span class="inline-flex items-center gap-1.5 text-xs text-dim">
                                                <i class="fa-solid fa-box-archive"></i>
                                                المحفظة مؤرشفة
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center">
                                    <div class="mx-auto flex max-w-md flex-col items-center">
                                        <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-surface text-dim">
                                            <i class="fa-solid fa-layer-group text-xl"></i>
                                        </div>

                                        <p class="font-semibold text-main">
                                            لا توجد محافظ
                                        </p>

                                        <p class="mt-2 text-sm text-dim">
                                            @if (filled($currentSearch))
                                                لم يتم العثور على محافظ تطابق البحث.
                                            @else
                                                لم يتم إنشاء أي محفظة لهذا البنك حتى الآن.
                                            @endif
                                        </p>

                                        @if (! filled($currentSearch))
                                            <a
                                                href="{{ route('banks.distribution.create', ['bank' => $bank->id]) }}"
                                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-brand px-5 py-3 text-sm font-bold text-slate-950 transition hover:opacity-90"
                                            >
                                                <i class="fa-solid fa-plus text-xs"></i>
                                                إنشاء أول محفظة
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($portfolios->hasPages())
                <div class="mt-5 border-t border-line pt-5">
                    {{ $portfolios->withQueryString()->links() }}
                </div>
            @endif
        </x-panel>
    </div>
@endsection
