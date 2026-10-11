
@php
    $currentGovernorate = $governorate ?? null;
@endphp

<div>
    <label for="name" class="app-label">
        اسم المحافظة بالعربية
        <span class="text-danger">*</span>
    </label>

    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name', $currentGovernorate?->name) }}"
        class="app-input @error('name') border-danger/50 focus:border-danger/50 @enderror"
        placeholder="مثال: القاهرة"
        maxlength="255"
        required
        autofocus
        autocomplete="off"
    >

    @error('name')
        <p class="mt-2 text-xs text-danger">{{ $message }}</p>
    @else
        <p class="app-help">اسم المحافظة باللغة العربية.</p>
    @enderror
</div>

<div>
    <label for="name_en" class="app-label">
        اسم المحافظة بالإنجليزية
    </label>

    <input
        id="name_en"
        type="text"
        name="name_en"
        value="{{ old('name_en', $currentGovernorate?->name_en) }}"
        dir="ltr"
        class="app-input text-left @error('name_en') border-danger/50 focus:border-danger/50 @enderror"
        placeholder="Example: Cairo"
        maxlength="255"
        autocomplete="off"
    >

    @error('name_en')
        <p class="mt-2 text-xs text-danger">{{ $message }}</p>
    @else
        <p class="app-help">اختياري — الاسم باللغة الإنجليزية.</p>
    @enderror
</div>

<div class="flex flex-col-reverse gap-3 border-t border-line pt-5 sm:flex-row sm:items-center sm:justify-between">
    <a
        href="{{ route('governorates.index') }}"
        class="app-btn app-btn-secondary"
    >
        <i class="fa-solid fa-arrow-right"></i>
        العودة للمحافظات
    </a>

    <button type="submit" class="app-btn app-btn-primary">
        <i class="fa-solid {{ $currentGovernorate ? 'fa-floppy-disk' : 'fa-plus' }}"></i>
        {{ $currentGovernorate ? 'حفظ التعديلات' : 'إضافة المحافظة' }}
    </button>
</div>
