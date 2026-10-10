
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-calendar-check ml-2 text-amber-400"></i>
            وعود السداد
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[750px] text-right text-sm">
            <thead class="bg-[#0a0c0e] text-slate-400">
                <tr>
                    <th class="px-5 py-4">الحالة</th>
                    <th class="px-5 py-4">تاريخ الوعد</th>
                    <th class="px-5 py-4">المبلغ الموعود</th>
                    <th class="px-5 py-4">المبلغ المدفوع</th>
                    <th class="px-5 py-4">المتبقي من الوعد</th>
                    <th class="px-5 py-4">ملاحظات</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#1e252b]">
                @forelse($promises as $promise)
                    <tr>
                        <td class="px-5 py-4">
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-300">
                                {{ $promise->status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            {{ $promise->promise_date?->format('Y-m-d') ?? $promise->promise_date ?? '—' }}
                        </td>
                        <td class="px-5 py-4 tabular-nums">
                            {{ number_format((float) $promise->promised_amount, 2) }} ج.م
                        </td>
                        <td class="px-5 py-4 tabular-nums text-emerald-300">
                            {{ number_format((float) $promise->paid_amount, 2) }} ج.م
                        </td>
                        <td class="px-5 py-4 tabular-nums">
                            {{ number_format(max(0, (float) $promise->promised_amount - (float) $promise->paid_amount), 2) }} ج.م
                        </td>
                        <td class="px-5 py-4 whitespace-normal text-slate-400">
                            {{ $promise->notes ?: '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                            لا توجد وعود سداد مسجلة.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
