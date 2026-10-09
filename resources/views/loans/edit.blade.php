@extends('layouts.app')
@section('title', 'تعديل قضية القرض')
@section('content')
@php
$formFields = [['name' => 'loan_number', 'label' => 'رقم القرض', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'total_debt', 'label' => 'إجمالي الدين', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'overdue_amount', 'label' => 'المبلغ المتأخر', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'installment_value', 'label' => 'قيمة القسط', 'type' => 'number', 'required' => false, 'full' => false],
        ['name' => 'status', 'label' => 'حالة القضية', 'type' => 'select', 'required' => true, 'full' => false, 'options' => ['pending' => 'قيد المراجعة', 'active' => 'نشط', 'inactive' => 'غير نشط', 'confirmed' => 'مؤكد', 'rejected' => 'مرفوض', 'scheduled' => 'مجدول', 'completed' => 'مكتمل', 'cancelled' => 'ملغي', 'open' => 'مفتوحة', 'in_review' => 'قيد المراجعة', 'resolved' => 'تم الحل', 'closed' => 'مغلقة']],
        ['name' => 'next_due_date', 'label' => 'موعد الاستحقاق التالي', 'type' => 'date', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تعديل قضية القرض" subtitle="تحديث بيانات القضية المالية." icon="fa-file-invoice-dollar" :fields="$formFields" action-route="loans.update" back-route="loans.index" :record="$loan ?? $debtCase ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
