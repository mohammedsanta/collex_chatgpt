@csrf
<div class="grid gap-x-5 gap-y-4 md:grid-cols-2">
    <div class="md:col-span-2"><x-select-field label="القضية / العميل" name="debt_case_id" :options="($debtCases ?? collect())->mapWithKeys(fn($case) => [$case->id => '#'.$case->id.' · '.($case->client?->name ?? 'عميل غير محدد').' · '.number_format((float)$case->total_debt, 2).' ج.م'])->all()" :value="$payment->debt_case_id ?? null" required placeholder="اختر القضية المرتبطة بالدفعة" /></div>
    <x-form-field label="المبلغ (جنيه مصري)" name="amount" type="number" :value="$payment->amount ?? old('amount')" required placeholder="0.00" min="0.01" step="0.01" />
    <x-select-field label="طريقة الدفع" name="method" :value="$payment->method ?? null" :options="['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك']" required placeholder="اختر طريقة الدفع" />
    <x-form-field label="تاريخ ووقت الدفع" name="paid_at" type="datetime-local" :value="old('paid_at', isset($payment) ? $payment->paid_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'))" required />
    <x-form-field label="الرقم المرجعي" name="reference" :value="$payment->reference ?? null" placeholder="رقم التحويل أو مرجع العملية" maxlength="100" />
    <div class="md:col-span-2"><x-textarea-field label="ملاحظات" name="notes" :value="$payment->notes ?? null" rows="3" placeholder="تفاصيل إضافية عن عملية التحصيل" /></div>
</div>
<div class="mt-7 flex flex-wrap items-center gap-2 border-t border-line pt-5"><button type="submit" class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> تسجيل الدفعة</button><a href="{{ route('payments.index') }}" class="app-btn app-btn-secondary">إلغاء</a><p class="mr-auto text-[10px] text-dim">ستظل الدفعة معلّقة حتى اعتمادها من صاحب الصلاحية.</p></div>
