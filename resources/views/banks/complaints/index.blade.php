@extends('layouts.app')
@section('title', 'الشكاوى')
@section('topbar-title', 'الشكاوى')
@section('content')
@php($records = $complaints ?? $items ?? collect())
<x-module-index title="الشكاوى" subtitle="استقبال الشكاوى وتحديد الأولوية والمسؤول ومتابعة الحل حتى الإغلاق." eyebrow="إدارة التحصيل" icon="fa-message" :rows="$records" :columns="[['key'=>'reference_number','label'=>'رقم الشكوى','type'=>'mono'],['key'=>'subject','label'=>'الموضوع','type'=>'text'],['key'=>'client.name','label'=>'العميل','type'=>'text'],['key'=>'priority','label'=>'الأولوية','type'=>'status'],['key'=>'status','label'=>'الحالة','type'=>'status'],['key'=>'due_at','label'=>'موعد الاستحقاق','type'=>'date']]" show-route="banks.complaints.show" edit-route="banks.complaints.edit" create-route="banks.complaints.create" search="true" search-placeholder="رقم الشكوى أو الموضوع..." empty-title="لا توجد شكاوى" empty-description="تظهر هنا الشكاوى المسجلة مع أولوية المعالجة وحالتها الحالية." />
@endsection
