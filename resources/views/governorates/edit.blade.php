@extends('layouts.app')
@section('title', 'تعديل المحافظة')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'اسم المحافظة', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'name_en', 'label' => 'الاسم بالإنجليزية', 'type' => 'text', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="تعديل المحافظة" subtitle="تحديث اسم المحافظة بالعربية والإنجليزية." icon="fa-map-location-dot" :fields="$formFields" action-route="governorates.update" back-route="governorates.index" :record="$governorate ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
