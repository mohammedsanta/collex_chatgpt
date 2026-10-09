@extends('layouts.app')
@section('title', 'إضافة بنك')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم البنك', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'code', 'label' => 'كود البنك', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'sector', 'label' => 'القطاع', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true],
        ['name' => 'is_active', 'label' => 'تفعيل البنك', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="إضافة بنك" subtitle="أدخل بيانات المؤسسة البنكية الأساسية." icon="fa-building-columns" :fields="$formFields" action-route="banks.store" back-route="banks.index" :record="$bank ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
