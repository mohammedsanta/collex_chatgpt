@extends('layouts.app')

@section('title', 'تعديل وعد السداد')

@section('content')
<div dir="rtl" class="min-h-screen bg-[#0b0f0d] px-4 py-6 text-gray-100 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <a
                    href="{{ route('banks.show', $bank) }}"
                    class="transition hover:text-lime-400"
                >
                    البنوك
                </a>

                <span>/</span>

                <a
                    href="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
                    class="transition hover:text-lime-400"
                >
                    وعود السداد
                </a>

                <span>/</span>
                <span>تعديل الوعد</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                تعديل وعد السداد
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                تحديث بيانات وعد السداد المرتبط ببنك {{ $bank->name }}.
            </p>
        </div>

        <a
            href="{{ route('banks.ptp.index', ['bank' => $bank->id]) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 px-5 py-3 font-semibold text-gray-300 transition hover:bg-white/5 hover:text-white"
        >
            <i class="fa-solid fa-arrow-right"></i>
            العودة للقائمة
        </a>
    </div>

    {{-- Promise Summary --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">

            <p class="mt-4 text-3xl font-bold">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-400">إجمالي الزيارات</span>

                    <span class="rounded-lg bg-lime-400/10 p-2 text-lime-400">
                        <i class="fa-solid fa-handshake"></i>
                    </span>
                </div>

                <p class="mt-4 text-3xl font-bold">
                    {{ $visits->total() }}
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    إجمالي نتائج الزيارات المطابقة للبحث
                </p>
            </p>

        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">المبلغ الموعود</span>
                <span class="rounded-lg bg-blue-400/10 p-2 text-blue-400">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </span>
            </div>

            <p class="mt-4 text-3xl font-bold">
                {{ number_format((float) $visits->total()) }}
            </p>

            <p class="mt-1 text-xs text-gray-500">
                جنيه مصري
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">المبلغ المحصل</span>
                <span class="rounded-lg bg-emerald-400/10 p-2 text-emerald-400">
                    <i class="fa-solid fa-check-circle"></i>
                </span>
            </div>

            <p class="mt-4 text-3xl font-bold">
                {{ number_format((float) $visits->total()) }}
            </p>

            <p class="mt-1 text-xs text-gray-500">
                جنيه مصري
            </p>
        </div>

    </div>

    {{-- Edit Form --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#121915]">

        <div class="border-b border-white/10 px-5 py-5 sm:px-7">
            <h2 class="font-bold">بيانات وعد السداد</h2>

            <p class="mt-2 text-sm text-gray-400">
                عدّل البيانات المطلوبة ثم احفظ التغييرات.
            </p>
        </div>

        @if (session('success'))
            <div class="mx-5 mt-5 rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-300 sm:mx-7">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-5 mt-5 rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm text-red-300 sm:mx-7">
                <p class="mb-2 font-bold">يرجى مراجعة البيانات التالية:</p>

                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

</div>
@endsection