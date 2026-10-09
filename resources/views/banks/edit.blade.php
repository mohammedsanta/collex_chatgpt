@extends('layouts.app')
@section('title', 'تعديل البنك')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم البنك', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'code', 'label' => 'كود البنك', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'sector', 'label' => 'القطاع', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true],
        ['name' => 'is_active', 'label' => 'تفعيل البنك', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="تعديل البنك" subtitle="تحديث بيانات المؤسسة البنكية." icon="fa-building-columns" :fields="$formFields" action-route="banks.update" back-route="banks.index" :record="$bank ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
