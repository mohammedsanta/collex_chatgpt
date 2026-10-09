@extends('layouts.app')
@section('title', 'تعديل الشكوى')
@section('content')
@php
$formFields = [['name' => 'subject', 'label' => 'موضوع الشكوى', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'description', 'label' => 'تفاصيل الشكوى', 'type' => 'textarea', 'required' => true, 'full' => true],
        ['name' => 'source', 'label' => 'مصدر الشكوى', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['phone' => 'هاتف', 'whatsapp' => 'واتساب', 'email' => 'بريد إلكتروني', 'bank' => 'البنك', 'visit' => 'زيارة ميدانية']],
        ['name' => 'priority', 'label' => 'الأولوية', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['low' => 'منخفضة', 'medium' => 'متوسطة', 'high' => 'عالية', 'urgent' => 'عاجلة']],
        ['name' => 'status', 'label' => 'الحالة', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['pending' => 'قيد المراجعة', 'active' => 'نشط', 'inactive' => 'غير نشط', 'confirmed' => 'مؤكد', 'rejected' => 'مرفوض', 'scheduled' => 'مجدول', 'completed' => 'مكتمل', 'cancelled' => 'ملغي', 'open' => 'مفتوحة', 'in_review' => 'قيد المراجعة', 'resolved' => 'تم الحل', 'closed' => 'مغلقة']],
        ['name' => 'due_at', 'label' => 'موعد الاستحقاق', 'type' => 'date', 'required' => false, 'full' => false],
        ['name' => 'resolution', 'label' => 'الإجراء المتخذ', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تعديل الشكوى" subtitle="تحديث بيانات الشكوى وحالة المعالجة." icon="fa-message" :fields="$formFields" action-route="banks.complaints.update" back-route="banks.complaints.index" :record="$bank ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
