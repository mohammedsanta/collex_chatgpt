@extends('layouts.app')
@section('title', 'المحافظات')
@section('topbar-title', 'المحافظات')
@section('content')
@php($records = $governorates ?? $items ?? collect())
<x-module-index title="المحافظات" subtitle="إدارة المحافظات المستخدمة في عناوين العملاء وتقارير التوزيع الجغرافي." eyebrow="إعدادات النظام" icon="fa-map-location-dot" :rows="$records" :columns="[['key'=>'name','label'=>'اسم المحافظة','type'=>'text'],['key'=>'name_en','label'=>'الاسم بالإنجليزية','type'=>'text'],['key'=>'clients_count','label'=>'عدد العملاء','type'=>'text']]" edit-route="governorates.edit" create-route="governorates.create" search="true" search-placeholder="اسم المحافظة..." empty-title="لا توجد محافظات" empty-description="أضف المحافظات المستخدمة في ملفات العملاء." />
@endsection
