@extends('layouts.app')
@section('title', 'إعدادات نطاق البنك')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم النطاق', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'period_year', 'label' => 'السنة', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'period_month', 'label' => 'الشهر', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="إعدادات نطاق البنك" subtitle="تعديل إعدادات نطاق البيانات المرتبط بالبنك." icon="fa-sliders" :fields="$formFields" action-route="banks.scope.update" back-route="banks.show" :record="$bank ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
