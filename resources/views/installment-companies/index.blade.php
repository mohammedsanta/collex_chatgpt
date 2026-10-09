@extends('layouts.app')
@section('title', 'شركات التقسيط')
@section('topbar-title', 'شركات التقسيط')
@section('content')
@php($records = $companies ?? $installmentCompanies ?? $items ?? collect())
<x-module-index title="شركات التقسيط" subtitle="إدارة الجهات التمويلية وبياناتها الأساسية وحالة الربط." eyebrow="المحافظ والمؤسسات" icon="fa-shop" :rows="$records" :columns="[['key'=>'name','label'=>'اسم الشركة','type'=>'text'],['key'=>'code','label'=>'الكود','type'=>'mono'],['key'=>'sector','label'=>'القطاع','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']]" show-route="installment-companies.show" edit-route="installment-companies.edit" create-route="installment-companies.create" search="true" search-placeholder="اسم الشركة أو الكود..." empty-title="لا توجد شركات تقسيط" empty-description="أضف شركة تقسيط لبدء ربط المحافظ والقضايا بها." />
@endsection
