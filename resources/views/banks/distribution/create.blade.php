@extends('layouts.app')

@section('title', 'إنشاء محفظة | Collex')

@section('content')
    <x-page-header
        title="إنشاء محفظة جديدة"
        subtitle="إنشاء محفظة تحصيل جديدة مرتبطة ببنك {{ $bank->name }}."
        eyebrow="إدارة المحافظ"
        icon="fa-layer-group"
    />

    <div class="mx-auto max-w-4xl space-y-5">
        <a
            href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
            class="inline-flex items-center gap-2 text-sm text-dim transition hover:text-main"
        >
            <i class="fa-solid fa-arrow-right text-xs"></i>
            العودة إلى محافظ البنك
        </a>

        @if ($errors->any())
            <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300" role="alert">
                <p class="mb-2 font-semibold">يرجى مراجعة البيانات التالية:</p>

                <ul class="list-inside list-disc space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-panel
            title="بيانات المحفظة"
            subtitle="أدخل اسم المحفظة والفترة المالية الخاصة بها."
            icon="fa-file-circle-plus"
        >
            <form
                method="POST"
                action="{{ route('banks.distribution.store', ['bank' => $bank->id]) }}"
                class="space-y-5"
            >
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-main">
                        اسم المحفظة
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        placeholder="مثال: محفظة أكتوبر 2026"
                        class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-main placeholder:text-dim outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/10"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="period_month" class="mb-2 block text-sm font-semibold text-main">
                            شهر المحفظة
                        </label>

                        <select
                            id="period_month"
                            name="period_month"
                            required
                            class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-main outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/10"
                        >
                            <option value="">اختر الشهر</option>

                            @foreach (range(1, 12) as $month)
                                <option
                                    value="{{ $month }}"
                                    @selected((string) old('period_month') === (string) $month)
                                >
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>

                        @error('period_month')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="period_year" class="mb-2 block text-sm font-semibold text-main">
                            سنة المحفظة
                        </label>

                        <input
                            id="period_year"
                            type="number"
                            name="period_year"
                            value="{{ old('period_year', now()->year) }}"
                            required
                            min="2000"
                            max="2100"
                            class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-main outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/10"
                        >

                        @error('period_year')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="notes" class="mb-2 block text-sm font-semibold text-main">
                        ملاحظات <span class="font-normal text-dim">(اختياري)</span>
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        placeholder="أضف أي ملاحظات تخص المحفظة..."
                        class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-main placeholder:text-dim outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/10"
                    >{{ old('notes') }}</textarea>

                    @error('notes')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-xl border border-line bg-surface p-4">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info mt-0.5 text-brand"></i>

                        <div>
                            <p class="text-sm font-semibold text-main">حالة المحفظة عند الإنشاء</p>
                            <p class="mt-1 text-sm text-dim">
                                سيتم إنشاء المحفظة كمسودة، ويمكن تفعيلها لاحقًا من صفحة محافظ البنك.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-end gap-3 border-t border-line pt-5">
                    <a
                        href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-line px-5 py-2.5 text-sm font-semibold text-dim transition hover:bg-surface hover:text-main"
                    >
                        إلغاء
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-6 py-2.5 text-sm font-bold text-slate-950 transition hover:opacity-90"
                    >
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        إنشاء المحفظة
                    </button>
                </div>
            </form>
        </x-panel>
    </div>
@endsection