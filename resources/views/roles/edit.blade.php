@extends('layouts.app')
@section('title', 'تعديل الدور')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'المعرف البرمجي', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'label', 'label' => 'اسم الدور', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'level', 'label' => 'مستوى الدور', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'description', 'label' => 'الوصف', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تعديل الدور" subtitle="حدّث اسم الدور ووصفه ومستوى الوصول." icon="fa-shield-halved" :fields="$formFields" action-route="roles.update" back-route="roles.index" :record="$role ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
