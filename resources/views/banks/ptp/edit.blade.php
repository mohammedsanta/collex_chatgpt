@extends('layouts.app')
@section('title', 'تعديل وعد السداد')
@section('content')
@php
$formFields = [['name' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'promise_date', 'label' => 'تاريخ السداد المتفق عليه', 'type' => 'date', 'required' => true, 'full' => false],
        ['name' => 'status', 'label' => 'حالة الوعد', 'type' => 'select', 'required' => true, 'full' => false, 'options' => ['pending' => 'قيد المراجعة', 'active' => 'نشط', 'inactive' => 'غير نشط', 'confirmed' => 'مؤكد', 'rejected' => 'مرفوض', 'scheduled' => 'مجدول', 'completed' => 'مكتمل', 'cancelled' => 'ملغي', 'open' => 'مفتوحة', 'in_review' => 'قيد المراجعة', 'resolved' => 'تم الحل', 'closed' => 'مغلقة']],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تعديل وعد السداد" subtitle="تحديث المبلغ أو الموعد أو الملاحظات." icon="fa-handshake" :fields="$formFields" action-route="banks.ptp.update" back-route="banks.ptp.index" :record="$bank ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
