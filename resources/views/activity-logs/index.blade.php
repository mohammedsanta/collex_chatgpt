@extends('layouts.app')
@section('title', 'سجل النشاط')
@section('topbar-title', 'سجل النشاط')
@section('content')
@php($records = $logs ?? $activityLogs ?? $items ?? collect())
<x-module-index title="سجل النشاط" subtitle="سجل تدقيقي للأحداث المهمة والتغييرات التي جرت داخل النظام." eyebrow="الفريق والإدارة" icon="fa-clock-rotate-left" :rows="$records" :columns="[['key'=>'created_at','label'=>'التوقيت','type'=>'date'],['key'=>'user.name','label'=>'المستخدم','type'=>'text'],['key'=>'event','label'=>'الحدث','type'=>'text'],['key'=>'description','label'=>'الوصف','type'=>'text'],['key'=>'ip_address','label'=>'عنوان IP','type'=>'mono']]" search="true" search-placeholder="المستخدم أو الحدث..." empty-title="لا توجد أحداث مسجلة" empty-description="ستظهر الأحداث بعد تفعيل تسجيل النشاط في العمليات ذات الصلة." />
@endsection
