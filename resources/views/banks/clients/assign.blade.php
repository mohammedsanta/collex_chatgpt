
@extends('layouts.app')

@section('title', 'توزيع حالات العملاء')

@section('content')
<div dir="rtl" class="space-y-6">

    <x-page-header
        title="توزيع الحالات على المحافظ"
        subtitle="اختر حالات المديونية التي تريد نقلها إلى محفظة أخرى تابعة لنفس البنك."
        eyebrow="البنوك / العملاء"
        icon="fa-user-tag"
    >
        <x-slot:actions>
            <a
                href="{{ route('banks.clients.index', ['bank' => $bank->id]) }}"
                class="app-btn app-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                العودة للعملاء
            </a>
        </x-slot:actions>
    </x-page-header>

    @if ($errors->any())
        <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
            <p class="mb-2 font-semibold">تعذر تنفيذ العملية:</p>
            <ul class="list-inside list-disc space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <x-panel
        title="بيانات التوزيع"
        subtitle="البنك: {{ $bank->name }}"
        icon="fa-layer-group"
    >
        @if ($portfolios->isEmpty())
            <div class="rounded-xl border border-amber-500/20 bg-amber-500/5 p-5">
                <p class="font-semibold text-amber-300">لا توجد محافظ لهذا البنك.</p>
                <p class="mt-2 text-sm text-gray-400">
                    أنشئ محفظة للبنك قبل نقل الحالات إليها.
                </p>
            </div>
        @else
            <form
                method="POST"
                action="{{ route('banks.clients.assign.store', ['bank' => $bank->id]) }}"
                class="space-y-5"
            >
                @csrf

                <div>
                    <label for="portfolio_id" class="mb-2 block text-sm font-medium">
                        المحفظة المستهدفة <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="portfolio_id"
                        name="portfolio_id"
                        required
                        class="app-input w-full"
                    >
                        <option value="">اختر المحفظة</option>

                        @foreach ($portfolios as $portfolio)
                            <option
                                value="{{ $portfolio->id }}"
                                @selected((string) old('portfolio_id') === (string) $portfolio->id)
                            >
                                {{ $portfolio->name }}
                                — {{ $portfolio->period_year }}/{{ $portfolio->period_month }}
                                — {{ $portfolio->status }}
                            </option>
                        @endforeach
                    </select>

                    @error('portfolio_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="font-semibold">حالات المديونية</h3>
                        <p class="mt-1 text-sm text-gray-400">
                            حدد حالة واحدة أو أكثر من الحالات المعروضة في هذه الصفحة.
                        </p>
                    </div>

                    <label class="inline-flex cursor-pointer items-center gap-2 text-sm">
                        <input
                            id="select-all"
                            type="checkbox"
                            class="rounded border-white/20 text-emerald-400 focus:ring-emerald-400"
                        >
                        تحديد الكل
                    </label>
                </div>

                <div class="overflow-x-auto rounded-xl border border-white/10">
                    <table class="w-full min-w-[800px] text-right text-sm">
                        <thead class="border-b border-white/10 text-gray-400">
                            <tr>
                                <th class="px-4 py-3">اختيار</th>
                                <th class="px-4 py-3">رقم الحالة</th>
                                <th class="px-4 py-3">العميل</th>
                                <th class="px-4 py-3">رقم القرض</th>
                                <th class="px-4 py-3">المحفظة الحالية</th>
                                <th class="px-4 py-3">إجمالي الدين</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-white/5">
                            @forelse ($cases as $case)
                                <tr class="hover:bg-white/[0.03]">
                                    <td class="px-4 py-3">
                                        <input
                                            type="checkbox"
                                            name="case_ids[]"
                                            value="{{ $case->id }}"
                                            @checked(in_array(
                                                (string) $case->id,
                                                array_map('strval', old('case_ids', [])),
                                                true
                                            ))
                                            class="case-checkbox rounded border-white/20 text-emerald-400 focus:ring-emerald-400"
                                        >
                                    </td>

                                    <td class="px-4 py-3 font-semibold text-emerald-300">
                                        #{{ $case->id }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $case->client?->name ?? 'عميل غير معروف' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $case->loan_number ?: '—' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $case->portfolio?->name ?? 'بدون محفظة' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ number_format((float) $case->total_debt, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-gray-400">
                                        لا توجد حالات مديونية لهذا البنك.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-white/10 pt-4">
                    {{ $cases->links() }}
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        @disabled($cases->isEmpty())
                        class="app-btn app-btn-primary disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <i class="fa-solid fa-check"></i>
                        نقل الحالات المحددة
                    </button>
                </div>
            </form>
        @endif
    </x-panel>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('select-all');
    const checkboxes = Array.from(document.querySelectorAll('.case-checkbox'));

    if (!selectAll) return;

    function updateSelectAll() {
        selectAll.checked =
            checkboxes.length > 0 &&
            checkboxes.every(checkbox => checkbox.checked);

        selectAll.indeterminate =
            checkboxes.some(checkbox => checkbox.checked) &&
            !checkboxes.every(checkbox => checkbox.checked);
    }

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });

        selectAll.indeterminate = false;
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectAll);
    });

    updateSelectAll();
});
</script>
@endsection