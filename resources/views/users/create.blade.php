@extends('layouts.app')
@section('title', 'إضافة مستخدم')
@section('content')
@php
$formFields = [['name' => 'employee_code', 'label' => 'كود الموظف', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'name', 'label' => 'الاسم الكامل', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'email', 'label' => 'البريد الإلكتروني', 'type' => 'email', 'required' => true, 'full' => false],
        ['name' => 'phone', 'label' => 'رقم الهاتف', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'role_id', 'label' => 'رقم الدور', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'password', 'label' => 'كلمة المرور الأولية', 'type' => 'password', 'required' => true, 'full' => false]];
@endphp
<x-module-form title="إضافة مستخدم" subtitle="إنشاء حساب جديد وربطه بدور وصلاحيات مناسبة." icon="fa-user-plus" :fields="$formFields" action-route="users.store" back-route="users.index" :record="$user ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
