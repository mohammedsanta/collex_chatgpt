@extends('layouts.app')
@section('title', 'إضافة قضية قرض')
@section('content')
@php
$formFields = [['name' => 'client_id', 'label' => 'رقم العميل', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'bank_id', 'label' => 'رقم البنك', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'loan_type_id', 'label' => 'نوع القرض', 'type' => 'number', 'required' => false, 'full' => false],
        ['name' => 'loan_number', 'label' => 'رقم القرض', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'total_debt', 'label' => 'إجمالي الدين', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'overdue_amount', 'label' => 'المبلغ المتأخر', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'installment_value', 'label' => 'قيمة القسط', 'type' => 'number', 'required' => false, 'full' => false],
        ['name' => 'next_due_date', 'label' => 'موعد الاستحقاق التالي', 'type' => 'date', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="إضافة قضية قرض" subtitle="سجّل القضية واربطها بالعميل والمؤسسة." icon="fa-file-invoice-dollar" :fields="$formFields" action-route="loans.store" back-route="loans.index" :record="$loan ?? $debtCase ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
