@csrf

<div>
    <label for="name" class="mb-2 block text-sm font-medium text-slate-300">
        اسم نوع القرض
    </label>

    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name', $loanType?->name) }}"
        required
        maxlength="255"
        placeholder="مثال: قرض شخصي"
        class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-emerald-400 focus:outline-none"
    >

    @error('name')
        <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="flex items-center gap-3 text-sm text-slate-300">
        <input
            type="hidden"
            name="is_active"
            value="0"
        >

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $loanType?->is_active ?? true))
            class="h-4 w-4 rounded border-slate-600 bg-slate-950 text-emerald-400 focus:ring-emerald-400"
        >

        نوع القرض نشط
    </label>

    @error('is_active')
        <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-wrap gap-3 border-t border-slate-800 pt-5">
    <button
        type="submit"
        class="rounded-lg bg-emerald-400 px-5 py-2.5 font-bold text-slate-950 transition hover:bg-emerald-300"
    >
        {{ $submitLabel }}
    </button>

    <a
        href="{{ route('loan-types.index') }}"
        class="rounded-lg border border-slate-700 px-5 py-2.5 text-slate-300 transition hover:bg-slate-800"
    >
        إلغاء
    </a>
</div>