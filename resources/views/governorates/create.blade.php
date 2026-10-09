@extends('layouts.app')
@section('title', 'إضافة محافظة')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم المحافظة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'name_en', 'label' => 'الاسم بالإنجليزية', 'type' => 'text', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="إضافة محافظة" subtitle="أضف محافظة لاستخدامها في ملفات العملاء." icon="fa-map-location-dot" :fields="$formFields" action-route="governorates.store" back-route="governorates.index" :record="$governorate ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
