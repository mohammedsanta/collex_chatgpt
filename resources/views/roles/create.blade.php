@extends('layouts.app')
@section('title', 'إنشاء دور جديد')
@section('content')
@php
$formFields = [['name' => 'name', 'label' => 'المعرف البرمجي', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'label', 'label' => 'اسم الدور', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'level', 'label' => 'مستوى الدور', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'description', 'label' => 'الوصف', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="إنشاء دور جديد" subtitle="أنشئ دورًا وحدد مستوى الوصول الخاص به." icon="fa-shield-halved" :fields="$formFields" action-route="roles.store" back-route="roles.index" :record="$role ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
