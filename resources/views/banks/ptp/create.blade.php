@extends('layouts.app')
@section('title', 'تسجيل وعد سداد')
@section('content')
@php
$formFields = [['name' => 'debt_case_id', 'label' => 'رقم القضية', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'promise_date', 'label' => 'تاريخ السداد المتفق عليه', 'type' => 'date', 'required' => true, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تسجيل وعد سداد" subtitle="سجّل المبلغ والموعد المتفق عليه مع العميل." icon="fa-handshake" :fields="$formFields" action-route="banks.ptp.store" back-route="banks.ptp.index" :record="$bank ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
