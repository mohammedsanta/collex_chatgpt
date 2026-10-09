@extends('layouts.app')
@section('title', 'أنواع القروض')
@section('topbar-title', 'أنواع القروض')
@section('content')
@php($records = $loanTypes ?? $items ?? collect())
<x-module-index title="أنواع القروض" subtitle="إدارة التصنيفات المستخدمة عند تسجيل القضايا والملفات المالية." eyebrow="إعدادات النظام" icon="fa-list-check" :rows="$records" :columns="[['key'=>'name','label'=>'نوع القرض','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']]" edit-route="loan-types.edit" create-route="loan-types.create" search="true" search-placeholder="اسم نوع القرض..." empty-title="لا توجد أنواع قروض" empty-description="أضف أنواع القروض المستخدمة لتوحيد تصنيف القضايا." />
@endsection
