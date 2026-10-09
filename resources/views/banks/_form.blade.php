
@php
    $editing = isset($bank) && $bank->exists;
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-300">
            اسم البنك <span class="text-rose-400">*</span>
        </label>
        <input id="name" name="name" required maxlength="255"
               value="{{ old('name', $bank->name ?? '') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: بنك مصر">
        @error('name')
            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="code" class="mb-2 block text-sm font-semibold text-slate-300">
            كود البنك <span class="text-rose-400">*</span>
        </label>
        <input id="code" name="code" required maxlength="100"
               value="{{ old('code', $bank->code ?? '') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: BM">
        @error('code')
            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sector" class="mb-2 block text-sm font-semibold text-slate-300">
            القطاع
        </label>
        <input id="sector" name="sector" maxlength="255"
               value="{{ old('sector', $bank->sector ?? '') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: بنوك تجارية">
        @error('sector')
            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="logo_path" class="mb-2 block text-sm font-semibold text-slate-300">
            مسار الشعار
        </label>
        <input id="logo_path" name="logo_path" maxlength="2048"
               value="{{ old('logo_path', $bank->logo_path ?? '') }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="اختياري">
        @error('logo_path')
            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="notes" class="mb-2 block text-sm font-semibold text-slate-300">
            ملاحظات
        </label>
        <textarea id="notes" name="notes" rows="4"
                  class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
                  placeholder="أضف أي ملاحظات عن البنك...">{{ old('notes', $bank->notes ?? '') }}</textarea>
        @error('notes')
            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <input type="hidden" name="is_active" value="0">

        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-800 bg-slate-950 p-4">
            <input type="checkbox" name="is_active" value="1"
                   @checked((bool) old('is_active', $bank->is_active ?? true))
                   class="h-5 w-5 rounded border-slate-600 bg-slate-900 text-emerald-400 focus:ring-emerald-400">
            <span>
                <span class="block font-semibold text-white">بنك نشط</span>
                <span class="mt-1 block text-sm text-slate-500">
                    إلغاء التفعيل يمنع التعامل مع البنك وفقًا لقواعد النظام.
                </span>
            </span>
        </label>
    </div>
</div>