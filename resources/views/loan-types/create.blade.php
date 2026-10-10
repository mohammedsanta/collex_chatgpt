@extends('layouts.app')

@section('title', 'إضافة نوع قرض | Collex')

@section('content')
<div class="mx-auto max-w-3xl space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">
    <div>
        <p class="text-sm text-emerald-400">COLLEX / أنواع القروض</p>
        <h1 class="mt-1 text-2xl font-bold">إضافة نوع قرض</h1>
        <p class="mt-1 text-sm text-slate-400">
            أدخل بيانات نوع القرض الجديد.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('loan-types.store') }}"
        class="space-y-5 rounded-2xl border border-slate-800 bg-slate-900 p-5"
    >
        @include('loan-types._form', [
            'loanType' => null,
            'submitLabel' => 'إنشاء نوع القرض',
        ])
    </form>
</div>
@endsection