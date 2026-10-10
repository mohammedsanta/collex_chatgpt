
@extends('layouts.app')

@section('title', 'البنوك | Collex')

@section('content')
<div dir="rtl" class="min-h-screen space-y-6 rounded-2xl bg-black p-4 text-slate-100 md:p-6">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">

        <div>
            <p class="text-xs font-semibold tracking-widest text-cyan-400">
                COLLEX / الإدارة
            </p>

            <h1 class="mt-2 text-2xl font-bold md:text-3xl">
                <i class="fa-solid fa-building-columns ml-2 text-cyan-400"></i>
                قطاع البنوك المصرية
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                إدارة البنوك ومحافظ التحصيل والبيانات المرتبطة بها.
            </p>
        </div>

        <form method="GET"
              action="{{ route('banks.index') }}"
              class="flex w-full flex-wrap gap-2 md:w-auto">

            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="ابحث عن بنك..."
                class="min-w-0 flex-1 rounded-full border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white outline-none transition focus:border-cyan-500 md:w-56"
            >

            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <button type="submit"
                    class="rounded-full border border-slate-800 px-4 py-2 text-sm text-cyan-400 transition hover:bg-slate-900">
                <i class="fa-solid fa-magnifying-glass"></i>
                بحث
            </button>
        </form>

    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-800 bg-emerald-950/50 p-4 text-sm text-emerald-300">
            <i class="fa-solid fa-circle-check ml-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-rose-800 bg-rose-950/50 p-4 text-sm text-rose-300">
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Statistics --}}
    <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">

        @foreach([
            [
                'label' => 'إجمالي البنوك',
                'value' => $stats['total'] ?? 0,
                'icon' => 'fa-building-columns',
                'color' => 'text-cyan-400',
            ],
            [
                'label' => 'البنوك النشطة',
                'value' => $stats['active'] ?? 0,
                'icon' => 'fa-circle-check',
                'color' => 'text-emerald-400',
            ],
            [
                'label' => 'البنوك غير النشطة',
                'value' => $stats['inactive'] ?? 0,
                'icon' => 'fa-circle-pause',
                'color' => 'text-rose-400',
            ],
            [
                'label' => 'المحافظ',
                'value' => $stats['portfolios'] ?? 0,
                'icon' => 'fa-folder-open',
                'color' => 'text-amber-400',
            ],
        ] as $stat)

            <div class="rounded-xl border border-white/10 bg-[#080808] p-4 transition hover:border-white/20">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-xs text-slate-500 md:text-sm">
                        {{ $stat['label'] }}
                    </p>

                    <i class="fa-solid {{ $stat['icon'] }} {{ $stat['color'] }}"></i>
                </div>

                <p class="mt-3 text-2xl font-bold tabular-nums">
                    {{ number_format($stat['value']) }}
                </p>
            </div>

        @endforeach

    </div>

    {{-- Search and Filters --}}
    <div class="flex flex-wrap items-center justify-between gap-3">

        <div>
            <h2 class="text-lg font-bold">البنوك المسجلة</h2>

            <p class="mt-1 text-xs text-slate-500">
                عدد النتائج:
                {{ $banks->total() }}
            </p>
        </div>

        <form method="GET"
              action="{{ route('banks.index') }}"
              class="flex flex-wrap items-center gap-2">

            <input
                type="hidden"
                name="search"
                value="{{ request('search') }}"
            >

            <select
                name="status"
                onchange="this.form.submit()"
                class="rounded-lg border border-white/10 bg-[#080808] px-3 py-2 text-sm text-slate-300 outline-none focus:border-cyan-500"
            >
                <option value="">كل الحالات</option>
                <option value="active" @selected(request('status') === 'active')>
                    نشط
                </option>
                <option value="inactive" @selected(request('status') === 'inactive')>
                    غير نشط
                </option>
            </select>

            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('banks.index') }}"
                   class="rounded-lg border border-white/10 px-3 py-2 text-sm text-slate-400 transition hover:bg-white/5">
                    <i class="fa-solid fa-rotate-right ml-1"></i>
                    إعادة ضبط
                </a>
            @endif

        </form>

    </div>

    {{-- Bank Cards --}}
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        {{-- Add Bank Card --}}
        <a href="{{ route('banks.create') }}"
           class="group flex min-h-[155px] flex-col items-center justify-center rounded-xl border border-dashed border-white/15 bg-black p-5 transition duration-200 hover:border-cyan-500/60 hover:bg-cyan-500/[0.03]">

            <div class="flex h-12 w-12 items-center justify-center rounded-full border border-cyan-500/40 text-cyan-400 transition group-hover:scale-110 group-hover:bg-cyan-500/10">
                <i class="fa-solid fa-plus text-xl"></i>
            </div>

            <span class="mt-3 font-semibold text-slate-300 transition group-hover:text-cyan-400">
                إضافة بنك جديد
            </span>

            <span class="mt-1 text-xs text-slate-600">
                تسجيل جهة بنكية جديدة
            </span>

        </a>

        @forelse($banks as $bank)

            <article class="group relative flex min-h-[155px] flex-col items-center justify-center rounded-xl border border-white/[0.08] bg-black p-5 transition duration-200 hover:border-cyan-500/30 hover:bg-[#050505]">

                {{-- Card Actions --}}
                <div class="absolute right-3 top-3 flex items-center gap-1">

                    <a href="{{ route('banks.panel', $bank) }}"
                       title="فتح لوحة البنك"
                       aria-label="فتح لوحة البنك"
                       class="flex h-7 w-7 items-center justify-center rounded-full border border-cyan-500/20 bg-cyan-500/10 text-cyan-400 transition hover:bg-cyan-500/20">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>

                    <a href="{{ route('banks.edit', $bank) }}"
                       title="تعديل البنك"
                       aria-label="تعديل البنك"
                       class="flex h-7 w-7 items-center justify-center rounded-full border border-sky-500/20 bg-sky-500/10 text-sky-400 transition hover:bg-sky-500/20">
                        <i class="fa-solid fa-pen text-[10px]"></i>
                    </a>

                    <a href="{{ route('banks.show', $bank) }}"
                       title="تفاصيل البنك"
                       aria-label="تفاصيل البنك"
                       class="flex h-7 w-7 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-400 transition hover:bg-white/10 hover:text-white">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    </a>

                </div>

                {{-- Bank Logo --}}
                <a href="{{ route('banks.show', $bank) }}"
                   class="mt-5 flex h-16 w-16 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-white p-2 transition duration-200 group-hover:scale-105">

                    @if(!empty($bank->logo_path))
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($bank->logo_path) }}"
                            alt="{{ $bank->name }}"
                            loading="lazy"
                            class="h-full w-full object-contain"
                        >
                    @else
                        <span class="flex h-full w-full items-center justify-center text-slate-800">
                            <i class="fa-solid fa-building-columns text-3xl"></i>
                        </span>
                    @endif

                </a>

                {{-- Bank Name --}}
                <a href="{{ route('banks.show', $bank) }}"
                   class="mt-3 max-w-full text-center text-sm font-bold text-slate-100 transition hover:text-cyan-400"
                   title="{{ $bank->name }}">

                    {{ $bank->name }}

                </a>

                {{-- Bank Code --}}
                <p class="mt-1 text-xs text-slate-600">
                    {{ $bank->code ?: 'بدون كود' }}
                </p>

                {{-- Status --}}
                <div class="mt-3 flex items-center gap-2">

                    @if($bank->is_active)
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <span class="text-[11px] text-emerald-400">نشط</span>
                    @else
                        <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                        <span class="text-[11px] text-slate-500">غير نشط</span>
                    @endif

                    <span class="text-slate-800">|</span>

                    <span class="text-[11px] text-slate-500">
                        <i class="fa-solid fa-folder-open ml-1"></i>
                        {{ number_format($bank->portfolios_count ?? 0) }} محفظة
                    </span>

                </div>

            </article>

        @empty

            <div class="flex min-h-[220px] flex-col items-center justify-center rounded-xl border border-white/10 bg-[#050505] p-6 text-center sm:col-span-2 xl:col-span-3 2xl:col-span-4">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/5 text-slate-500">
                    <i class="fa-solid fa-building-columns text-2xl"></i>
                </div>

                <h3 class="mt-4 font-bold text-slate-300">
                    لا توجد بنوك
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    أضف بنكًا جديدًا أو غيّر خيارات البحث.
                </p>

                <a href="{{ route('banks.create') }}"
                   class="mt-4 rounded-lg bg-cyan-500/10 px-4 py-2 text-sm font-semibold text-cyan-400 transition hover:bg-cyan-500/20">
                    <i class="fa-solid fa-plus ml-1"></i>
                    إضافة بنك
                </a>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($banks->hasPages())
        <div class="border-t border-white/10 pt-5">
            {{ $banks->withQueryString()->links() }}
        </div>
    @endif

</div>
@endsection
