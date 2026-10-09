@extends('layouts.app')

@section('title', 'إنشاء تقرير DCR - ' . $bank->name)

@section('content')
<div dir="rtl" class="mx-auto max-w-5xl space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400"><a href="{{ route('banks.dcr.index', ['bank' => $bank->id]) }}" class="hover:text-emerald-400">تقارير DCR</a><i class="fa-solid fa-chevron-left text-xs"></i><span class="text-gray-200">تقرير جديد</span></div>
            <h1 class="text-2xl font-bold text-white sm:text-3xl">إنشاء تقرير التحصيل اليومي</h1>
            <p class="mt-2 text-sm text-gray-400">أدخل ملخص نشاط التحصيل الخاص بك لدى {{ $bank->name }}. سيتم حفظ التقرير كمسودة.</p>
        </div>
        <a href="{{ route('banks.dcr.index', ['bank' => $bank->id]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-gray-300 hover:bg-white/10"><i class="fa-solid fa-arrow-right"></i> العودة للتقارير</a>
    </div>

    @if ($errors->any())
        <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-sm text-red-200"><p class="font-bold">يرجى مراجعة البيانات التالية</p><ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5 sm:p-6">
        <div class="mb-6 flex items-center gap-3 border-b border-white/10 pb-5"><span class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-400/10 text-xl text-emerald-400"><i class="fa-solid fa-building-columns"></i></span><div><p class="text-xs text-gray-400">البنك</p><h2 class="mt-1 font-bold text-white">{{ $bank->name }}</h2><p class="mt-1 text-xs text-gray-500">الموظف: {{ auth()->user()->name }}</p></div></div>
        <form method="POST" action="{{ route('banks.dcr.store', ['bank' => $bank->id]) }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div><label for="report_date" class="mb-2 block text-sm font-medium text-gray-300">تاريخ التقرير <span class="text-red-400">*</span></label><input id="report_date" name="report_date" type="date" required max="{{ now()->toDateString() }}" value="{{ old('report_date', now()->toDateString()) }}" class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none focus:border-emerald-400">@error('report_date')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror</div>
                @foreach ([['cases_worked','عدد القضايا التي تمت متابعتها','number',0],['calls_count','عدد المكالمات','number',0],['visits_count','عدد الزيارات','number',0],['promises_count','عدد وعود السداد','number',0],['promised_amount','إجمالي المبالغ الموعودة','number',0.00],['collected_amount','إجمالي المبالغ المحصلة','number',0.00]] as [$field,$label,$type,$default])
                    <div><label for="{{ $field }}" class="mb-2 block text-sm font-medium text-gray-300">{{ $label }} <span class="text-red-400">*</span></label><input id="{{ $field }}" name="{{ $field }}" type="{{ $type }}" required min="0" @if (str_ends_with($field, '_amount')) step="0.01" @else step="1" @endif value="{{ old($field, $default) }}" class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none focus:border-emerald-400">@error($field)<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror</div>
                @endforeach
                <div class="sm:col-span-2 lg:col-span-3"><label for="notes" class="mb-2 block text-sm font-medium text-gray-300">ملاحظات التقرير</label><textarea id="notes" name="notes" rows="4" maxlength="5000" placeholder="أضف ملاحظات عن نتائج التحصيل أو المعوقات..." class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none placeholder:text-gray-600 focus:border-emerald-400">{{ old('notes') }}</textarea><p class="mt-2 text-xs text-gray-500">الحد الأقصى 5000 حرف.</p></div>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-5 sm:flex-row sm:justify-end"><a href="{{ route('banks.dcr.index', ['bank' => $bank->id]) }}" class="inline-flex items-center justify-center rounded-xl border border-white/10 px-5 py-3 text-sm text-gray-300 hover:bg-white/5">إلغاء</a><button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-lime-400 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-lime-300"><i class="fa-solid fa-floppy-disk"></i> حفظ كمسودة</button></div>
        </form>
    </div>
</div>
@endsection
