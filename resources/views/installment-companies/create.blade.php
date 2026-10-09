@extends('layouts.app')
@section('title', 'إضافة شركة تقسيط')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم الشركة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'code', 'label' => 'كود الشركة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'sector', 'label' => 'القطاع', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true],
        ['name' => 'is_active', 'label' => 'تفعيل الشركة', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="إضافة شركة تقسيط" subtitle="أدخل البيانات الأساسية للشركة." icon="fa-shop" :fields="$formFields" action-route="installment-companies.store" back-route="installment-companies.index" :record="$company ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
