<dialog
    id="reject-payment-{{ $payment->id }}"
    dir="rtl"
    aria-labelledby="reject-title-{{ $payment->id }}"
    class="fixed inset-0 m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] max-w-lg overflow-y-auto rounded-2xl border border-line bg-transparent p-0 text-fg backdrop:bg-black/60 backdrop:backdrop-blur-sm"
>
    <div class="app-card overflow-hidden rounded-2xl border border-line shadow-2xl shadow-black/40">

        <div class="app-card-header">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-danger/10 text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                    <div>
                        <h3
                            id="reject-title-{{ $payment->id }}"
                            class="font-semibold text-fg"
                        >
                            رفض التحصيل
                        </h3>

                        <p class="mt-1 text-xs text-muted">
                            الإيصال {{ $payment->receipt_number ?: '#' . $payment->id }}
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    class="app-btn app-btn-secondary"
                    aria-label="إغلاق"
                    onclick="this.closest('dialog').close()"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="app-card-body">
            <form
                method="POST"
                action="{{ route('payments.reject', $payment) }}"
                class="flex flex-col gap-4"
            >
                @csrf

                <div>
                    <label
                        for="rejection_reason_{{ $payment->id }}"
                        class="app-label"
                    >
                        سبب الرفض <span class="text-danger">*</span>
                    </label>

                    <textarea
                        id="rejection_reason_{{ $payment->id }}"
                        name="reason"
                        class="app-input min-h-28 w-full resize-y"
                        rows="4"
                        required
                        maxlength="1000"
                        placeholder="اكتب سبب رفض التحصيل بوضوح..."
                    >{{ old('rejection_reason') }}</textarea>

                    <p class="app-help mt-2">
                        يرجى توضيح سبب الرفض قبل إرسال القرار.
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <button
                        type="submit"
                        class="app-btn app-btn-danger w-full justify-center"
                        onclick="return confirm('هل أنت متأكد من رفض هذا التحصيل؟')"
                    >
                        <i class="fa-solid fa-ban ml-2"></i>
                        تأكيد الرفض
                    </button>

                    <button
                        type="button"
                        class="app-btn app-btn-secondary w-full justify-center"
                        onclick="this.closest('dialog').close()"
                    >
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>