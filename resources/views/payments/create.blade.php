@extends('layouts.app')
@section('title', 'تسجيل دفعة')
@section('content')
<x-page-header title="تسجيل دفعة جديدة" subtitle="سجّل عملية تحصيل واربطها بالقضية الصحيحة مع بيانات مرجعية واضحة." eyebrow="المدفوعات / تسجيل" icon="fa-circle-plus"><x-slot:actions><a href="{{ route('payments.index') }}" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> كل المدفوعات</a></x-slot:actions></x-page-header>
<div class="mx-auto max-w-4xl"><div class="mb-4 flex items-start gap-3 rounded-xl border border-info/20 bg-info/10 p-4 text-info"><i class="fa-solid fa-circle-info mt-0.5"></i><p class="text-[10px] leading-6">سيتم إنشاء الدفعة بحالة <strong>قيد المراجعة</strong>. لن تدخل في إجمالي التحصيل المؤكد إلا بعد اعتمادها.</p></div><x-panel title="بيانات عملية التحصيل" subtitle="تأكد من المبلغ والقضية وتاريخ السداد" icon="fa-money-bill-wave"><form method="POST" action="{{ route('payments.store') }}">@include('payments._form')</form></x-panel></div>
@endsection
