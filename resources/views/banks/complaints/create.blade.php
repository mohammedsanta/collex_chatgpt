@extends('layouts.app')
@section('title', 'تسجيل شكوى')
@section('content')
@php
$formFields = [['name' => 'subject', 'label' => 'موضوع الشكوى', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'description', 'label' => 'تفاصيل الشكوى', 'type' => 'textarea', 'required' => true, 'full' => true],
        ['name' => 'source', 'label' => 'مصدر الشكوى', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['phone' => 'هاتف', 'whatsapp' => 'واتساب', 'email' => 'بريد إلكتروني', 'bank' => 'البنك', 'visit' => 'زيارة ميدانية']],
        ['name' => 'priority', 'label' => 'الأولوية', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['low' => 'منخفضة', 'medium' => 'متوسطة', 'high' => 'عالية', 'urgent' => 'عاجلة']],
        ['name' => 'due_at', 'label' => 'موعد الاستحقاق', 'type' => 'date', 'required' => false, 'full' => false]];
@endphp
<x-module-form title="تسجيل شكوى" subtitle="سجل الشكوى وحدد الأولوية والجهة المسؤولة." icon="fa-message" :fields="$formFields" action-route="banks.complaints.store" back-route="banks.complaints.index" :record="$bank ?? $record ?? null" :editing="false" submit-label="إنشاء السجل" />
@endsection
