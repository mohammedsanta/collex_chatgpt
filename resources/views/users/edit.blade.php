@extends('layouts.app')
@section('title', 'تعديل المستخدم')
@section('content')
@php
$formFields = [['name' => 'employee_code', 'label' => 'كود الموظف', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'name', 'label' => 'الاسم الكامل', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'email', 'label' => 'البريد الإلكتروني', 'type' => 'email', 'required' => true, 'full' => false],
        ['name' => 'phone', 'label' => 'رقم الهاتف', 'type' => 'text', 'required' => false, 'full' => false],
        ['name' => 'role_id', 'label' => 'رقم الدور', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'status', 'label' => 'حالة الحساب', 'type' => 'select', 'required' => true, 'full' => false, 'options' => ['pending' => 'قيد المراجعة', 'active' => 'نشط', 'inactive' => 'غير نشط', 'confirmed' => 'مؤكد', 'rejected' => 'مرفوض', 'scheduled' => 'مجدول', 'completed' => 'مكتمل', 'cancelled' => 'ملغي', 'open' => 'مفتوحة', 'in_review' => 'قيد المراجعة', 'resolved' => 'تم الحل', 'closed' => 'مغلقة']]];
@endphp
<x-module-form title="تعديل المستخدم" subtitle="تحديث بيانات المستخدم الأساسية." icon="fa-user-pen" :fields="$formFields" action-route="users.update" back-route="users.index" :record="$user ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
