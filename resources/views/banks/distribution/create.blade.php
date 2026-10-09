@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-8" dir="rtl">

    <div class="mb-6">
        <a
            href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
            class="text-sm text-gray-400 hover:text-lime-400"
        >
            ← العودة إلى توزيع المحافظ
        </a>

        <h1 class="mt-4 text-2xl font-bold text-white">
            إنشاء محفظة جديدة
        </h1>

        <p class="mt-2 text-sm text-gray-400">
            إنشاء محفظة جديدة لبنك {{ $bank->name }}
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl border border-gray-700 bg-gray-900 p-6">
        <form action="{{ route('portfolios.store') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="bank_id" value="{{ $bank->id }}">

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-300">
                    البنك
                </label>

                <input
                    type="text"
                    value="{{ $bank->name }}"
                    readonly
                    class="w-full rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-gray-400"
                >
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-300">
                    اسم المحفظة
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    placeholder="مثال: محفظة أكتوبر 2026"
                    class="w-full rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-white placeholder-gray-500 focus:border-lime-400 focus:outline-none"
                >
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="period_year" class="mb-2 block text-sm font-medium text-gray-300">
                        السنة
                    </label>

                    <input
                        id="period_year"
                        name="period_year"
                        type="number"
                        value="{{ old('period_year', now()->year) }}"
                        min="2000"
                        max="2200"
                        required
                        class="w-full rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-white focus:border-lime-400 focus:outline-none"
                    >
                </div>

                <div>
                    <label for="period_month" class="mb-2 block text-sm font-medium text-gray-300">
                        الشهر
                    </label>

                    <select
                        id="period_month"
                        name="period_month"
                        required
                        class="w-full rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-white focus:border-lime-400 focus:outline-none"
                    >
                        <option value="">اختر الشهر</option>

                        @foreach ([
                            1 => 'يناير',
                            2 => 'فبراير',
                            3 => 'مارس',
                            4 => 'أبريل',
                            5 => 'مايو',
                            6 => 'يونيو',
                            7 => 'يوليو',
                            8 => 'أغسطس',
                            9 => 'سبتمبر',
                            10 => 'أكتوبر',
                            11 => 'نوفمبر',
                            12 => 'ديسمبر',
                        ] as $number => $month)
                            <option
                                value="{{ $number }}"
                                @selected((string) old('period_month', now()->month) === (string) $number)
                            >
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="notes" class="mb-2 block text-sm font-medium text-gray-300">
                    ملاحظات (اختياري)
                </label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="4"
                    class="w-full rounded-xl border border-gray-700 bg-gray-800 px-4 py-3 text-white placeholder-gray-500 focus:border-lime-400 focus:outline-none"
                    placeholder="ملاحظات تخص المحفظة..."
                >{{ old('notes') }}</textarea>
            </div>

            <div class="flex flex-wrap gap-3 border-t border-gray-700 pt-5">
                <button
                    type="submit"
                    class="rounded-xl bg-lime-400 px-6 py-3 font-bold text-gray-950 hover:bg-lime-300"
                >
                    إنشاء المحفظة
                </button>

                <a
                    href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                    class="rounded-xl border border-gray-700 px-6 py-3 text-gray-300 hover:bg-gray-800"
                >
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection