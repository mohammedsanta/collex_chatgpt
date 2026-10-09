@extends('layouts.app')
@section('title', 'تعديل الزيارة')
@section('content')
@php
$formFields = [['name' => 'scheduled_at', 'label' => 'موعد الزيارة', 'type' => 'datetime-local', 'required' => true, 'full' => false],
        ['name' => 'status', 'label' => 'حالة الزيارة', 'type' => 'select', 'required' => true, 'full' => false, 'options' => ['pending' => 'قيد المراجعة', 'active' => 'نشط', 'inactive' => 'غير نشط', 'confirmed' => 'مؤكد', 'rejected' => 'مرفوض', 'scheduled' => 'مجدول', 'completed' => 'مكتمل', 'cancelled' => 'ملغي', 'open' => 'مفتوحة', 'in_review' => 'قيد المراجعة', 'resolved' => 'تم الحل', 'closed' => 'مغلقة']],
        ['name' => 'outcome', 'label' => 'نتيجة الزيارة', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['client_found' => 'تم الوصول للعميل', 'not_home' => 'لم يكن بالمنزل', 'refused' => 'رفض', 'promised' => 'وعد بالسداد', 'paid' => 'تم السداد']],
        ['name' => 'address', 'label' => 'العنوان', 'type' => 'text', 'required' => false, 'full' => true],
        ['name' => 'notes', 'label' => 'ملاحظات', 'type' => 'textarea', 'required' => false, 'full' => true]];
@endphp
<x-module-form title="تعديل الزيارة" subtitle="تحديث موعد الزيارة أو حالتها ونتيجتها." icon="fa-location-dot" :fields="$formFields" action-route="banks.visits.update" back-route="banks.visits.index" :record="$bank ?? $record ?? null" :editing="true" submit-label="حفظ التعديلات" />
@endsection
