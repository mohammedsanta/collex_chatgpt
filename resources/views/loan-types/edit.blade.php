@extends('layouts.app')
@section('title', 'تعديل نوع القرض')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم نوع القرض', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'is_active', 'label' => 'نوع القرض فعال', 'type' => 'checkbox', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="تعديل نوع القرض" subtitle="تحديث اسم التصنيف وحالته." icon="fa-list-check" :fields="$formFields" action-route="loan-types.update" back-route="loan-types.index" :record="$loanType ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
