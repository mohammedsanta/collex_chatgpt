@extends('layouts.app')

@section('title', 'تعديل نوع القرض | Collex')

@section('content')
<div class="mx-auto max-w-3xl space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">
    <div>
        <p class="text-sm text-emerald-400">COLLEX / أنواع القروض</p>
        <h1 class="mt-1 text-2xl font-bold">تعديل نوع القرض</h1>
        <p class="mt-1 text-sm text-slate-400">
            تعديل بيانات: {{ $loanType->name }}
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('loan-types.update', $loanType) }}"
        class="space-y-5 rounded-2xl border border-slate-800 bg-slate-900 p-5"
    >
        @method('PUT')

        @include('loan-types._form', [
            'loanType' => $loanType,
            'submitLabel' => 'حفظ التعديلات',
        ])
    </form>
</div>
@endsection