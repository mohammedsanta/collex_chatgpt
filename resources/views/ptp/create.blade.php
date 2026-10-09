@extends('layouts.app')
@section('title', 'تسجيل وعد سداد')
@section('content')
@php
$formFields = [['name' => 'debt_case_id', 'label' => 'رقم القضية', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'promise_date', 'label' => 'تاريخ السداد', 'type' => 'date', 'required' => true, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تسجيل وعد سداد" subtitle="سجّل اتفاق السداد وتاريخه والمبلغ المتفق عليه." icon="fa-handshake" :fields="$formFields" action-route="ptp.store" back-route="ptp.index" :record="$promise ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
