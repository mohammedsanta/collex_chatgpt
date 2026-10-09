@extends('layouts.app')
@section('title', 'تعديل شركة التقسيط')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم الشركة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'code', 'label' => 'كود الشركة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'sector', 'label' => 'القطاع', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true],
        ['name' => 'is_active', 'label' => 'تفعيل الشركة', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="تعديل شركة التقسيط" subtitle="تحديث بيانات الشركة وحالتها." icon="fa-shop" :fields="$formFields" action-route="installment-companies.update" back-route="installment-companies.index" :record="$company ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
