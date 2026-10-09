@extends('layouts.app')
@section('title', 'البنوك')
@section('topbar-title', 'البنوك')
@section('content')
@php($records = $banks ?? $items ?? collect())
<x-module-index title="البنوك" subtitle="إدارة المؤسسات البنكية وربط المحافظ والصلاحيات والتقارير بكل بنك." eyebrow="المحافظ والمؤسسات" icon="fa-building-columns" :rows="$records" :columns="[['key'=>'name','label'=>'اسم البنك','type'=>'text'],['key'=>'code','label'=>'الكود','type'=>'mono'],['key'=>'sector','label'=>'القطاع','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']]" show-route="banks.show" edit-route="banks.edit" create-route="banks.create" search="true" search-placeholder="اسم البنك أو الكود..." empty-title="لا توجد بنوك مسجلة" empty-description="ابدأ بإضافة المؤسسة البنكية أو استيراد بياناتها الأساسية." />
@endsection
