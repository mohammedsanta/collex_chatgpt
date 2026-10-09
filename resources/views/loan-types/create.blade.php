@extends('layouts.app')
@section('title', 'إضافة نوع قرض')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم نوع القرض', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'is_active', 'label' => 'نوع القرض فعال', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="إضافة نوع قرض" subtitle="أضف تصنيفًا جديدًا لاستخدامه في القضايا." icon="fa-list-check" :fields="$formFields" action-route="loan-types.store" back-route="loan-types.index" :record="$loanType ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
