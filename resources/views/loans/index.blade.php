@extends('layouts.app')
@section('title', 'القضايا والقروض')
@section('topbar-title', 'القضايا والقروض')
@section('content')
@php($cases = $debtCases ?? $loans ?? $cases ?? $items ?? collect())
<x-module-index title="القضايا والقروض" subtitle="ملفات المديونية وحالة التحصيل والرصيد المتبقي لكل قضية." eyebrow="إدارة التحصيل" icon="fa-file-invoice-dollar" :rows="$cases" :columns="[['key'=>'loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'client.name','label'=>'العميل','type'=>'text'],['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'overdue_amount','label'=>'المتأخر','type'=>'money'],['key'=>'collected_amount','label'=>'المحصل','type'=>'money'],['key'=>'dpd','label'=>'أيام التأخير','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']]" show-route="loans.show" edit-route="loans.edit" create-route="loans.create" search="true" search-placeholder="رقم القرض أو اسم العميل..." empty-title="لا توجد قضايا" empty-description="عند استيراد محفظة أو تسجيل قضية ستظهر السجلات هنا." />
@endsection
