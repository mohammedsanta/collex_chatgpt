<tr>
    {{-- Receipt --}}
    <td class="whitespace-nowrap">
        <span class="font-semibold text-fg">
            {{ $payment->receipt_number ?: '#' . $payment->id }}
        </span>
    </td>

    {{-- Status --}}
    <td>
        <x-status-badge :status="$payment->status" />
    </td>

    {{-- Client and case --}}
    <td>
        <div class="font-medium text-fg">
            {{ $payment->debtCase?->client?->name ?? '—' }}
        </div>

        <div class="text-muted text-xs mt-1">
            {{ $payment->debtCase?->case_number ?? $payment->debt_case_id ?? '—' }}
        </div>
    </td>

    {{-- Collector --}}
    <td>
        <span class="text-fg">
            {{ $payment->collector?->name ?? '—' }}
        </span>
    </td>

    {{-- Amount --}}
    <td class="whitespace-nowrap">
        <span class="font-semibold text-fg">
            {{ number_format((float) $payment->amount, 2) }} ج.م
        </span>
    </td>

    {{-- Payment method --}}
    <td>
        @switch($payment->payment_method)
            @case('cash')
                نقدي
                @break

            @case('e_wallet')
                محفظة إلكترونية
                @break

            @case('bank_transfer')
                تحويل بنكي
                @break

            @case('card')
                بطاقة
                @break

            @case('cheque')
                شيك
                @break

            @default
                {{ $payment->payment_method ?? '—' }}
        @endswitch
    </td>

    {{-- Collection date --}}
    <td class="whitespace-nowrap">
        {{ $payment->collected_at?->format('Y-m-d H:i')
            ?? $payment->created_at?->format('Y-m-d H:i')
            ?? '—' }}
    </td>

{{-- Actions --}}
<td>
    <div class="flex min-w-36 flex-col gap-3">

        @can('confirm', $payment)
            <form
                method="POST"
                action="{{ route('payments.confirm', $payment) }}"
                onsubmit="return confirm('هل أنت متأكد من تأكيد هذا التحصيل؟')"
            >
                @csrf

                <button
                    type="submit"
                    class="app-btn app-btn-primary w-full justify-center"
                >
                    <i class="fa-solid fa-check ml-2"></i>
                    تأكيد التحصيل
                </button>
            </form>
        @endcan

        @can('reject', $payment)
            <button
                type="button"
                class="app-btn app-btn-danger w-full justify-center"
                onclick="document.getElementById('reject-payment-{{ $payment->id }}').showModal()"
            >
                <i class="fa-solid fa-xmark ml-2"></i>
                رفض التحصيل
            </button>
        @endcan

        @cannot('confirm', $payment)
            @cannot('reject', $payment)
                <span class="text-muted text-center text-xs">
                    لا توجد إجراءات متاحة
                </span>
            @endcannot
        @endcannot

    </div>
</td>
</tr>
