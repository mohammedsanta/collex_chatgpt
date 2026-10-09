
@extends('layouts.app')

@section('title', 'تعديل البنك | Collex')

@section('content')
<div class="mx-auto max-w-4xl space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">
    <div>
        <a href="{{ route('banks.show', $bank) }}" class="text-sm text-emerald-400 hover:text-emerald-300">
            ← العودة إلى البنك
        </a>
        <h1 class="mt-3 text-3xl font-bold">تعديل بيانات البنك</h1>
        <p class="mt-2 text-sm text-slate-400">
            {{ $bank->name }} · #{{ $bank->id }}
        </p>
    </div>

    <form method="POST" action="{{ route('banks.update', $bank) }}"
          class="space-y-6 rounded-2xl border border-slate-800 bg-slate-900 p-5 md:p-7">
        @csrf
        @method('PUT')

        @include('banks._form', ['bank' => $bank])

        <div class="flex flex-wrap justify-end gap-3 border-t border-slate-800 pt-5">
            <a href="{{ route('banks.show', $bank) }}"
               class="rounded-xl border border-slate-700 px-5 py-3 text-slate-300 hover:bg-slate-800">
                إلغاء
            </a>
            <button type="submit"
                    class="rounded-xl bg-emerald-400 px-6 py-3 font-bold text-slate-950 hover:bg-emerald-300">
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection