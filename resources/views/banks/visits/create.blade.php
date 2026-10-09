@extends('layouts.app')
@section('title', 'جدولة زيارة ميدانية')
@section('content')
@php
$formFields = [['name' => 'debt_case_id', 'label' => 'رقم القضية', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'scheduled_at', 'label' => 'موعد الزيارة', 'type' => 'datetime-local', 'required' => true, 'full' => false],
        ['name' => 'address', 'label' => 'عنوان الزيارة', 'type' => 'text', 'required' => false, 'full' => true],
        ['name' => 'notes', 'label' => 'ملاحظات للمحصل', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="جدولة زيارة ميدانية" subtitle="حدد القضية والموعد والبيانات المتاحة للزيارة." icon="fa-location-dot" :fields="$formFields" action-route="banks.visits.store" back-route="banks.visits.index" :record="$bank ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
