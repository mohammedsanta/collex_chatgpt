
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-money-bill-transfer ml-2 text-emerald-400"></i>
            سجل المدفوعات
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] text-right text-sm">
            <thead class="bg-[#0a0c0e] text-slate-400">
                <tr>
                    <th class="px-5 py-4">رقم الإيصال</th>
                    <th class="px-5 py-4">الحالة</th>
                    <th class="px-5 py-4">تاريخ الدفع</th>
                    <th class="px-5 py-4">المبلغ</th>
                    <th class="px-5 py-4">طريقة الدفع</th>
                    <th class="px-5 py-4">المحصّل</th>
                    <th class="px-5 py-4">المرجع</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#1e252b]">
                @forelse($payments as $payment)
                    <tr>
                        <td class="px-5 py-4 font-mono">
                            {{ $payment->receipt_number ?: '#' . $payment->id }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-300">
                                {{ $payment->status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            {{ $payment->paid_at?->format('Y-m-d H:i') ?? '—' }}
                        </td>
                        <td class="px-5 py-4 font-semibold tabular-nums text-emerald-300">
                            {{ number_format((float) $payment->amount, 2) }} ج.م
                        </td>
                        <td class="px-5 py-4">{{ $payment->method ?: '—' }}</td>
                        <td class="px-5 py-4">{{ $payment->collector?->name ?? '—' }}</td>
                        <td class="px-5 py-4 font-mono text-slate-400">
                            {{ $payment->reference ?: '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-slate-500">
                            لا توجد مدفوعات مسجلة للحالات المرتبطة بالعميل.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
