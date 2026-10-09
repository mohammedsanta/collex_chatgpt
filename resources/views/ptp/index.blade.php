@extends('layouts.app')
@section('title', 'وعود السداد')
@section('topbar-title', 'وعود السداد')
@section('content')
@php($records = $promises ?? $promisesToPay ?? $items ?? collect())
<x-module-index title="وعود السداد" subtitle="متابعة تعهدات العملاء بالمبالغ والمواعيد ونتائج الوفاء." eyebrow="إدارة التحصيل" icon="fa-handshake" :rows="$records" :columns="[['key'=>'debtCase.client.name','label'=>'العميل','type'=>'text'],['key'=>'debtCase.loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'user.name','label'=>'المحصل','type'=>'text'],['key'=>'promised_amount','label'=>'المبلغ الموعود','type'=>'money'],['key'=>'paid_amount','label'=>'المبلغ المدفوع','type'=>'money'],['key'=>'promise_date','label'=>'تاريخ الوعد','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']]" show-route="ptp.show" edit-route="ptp.edit" create-route="ptp.create" search="true" search-placeholder="اسم العميل أو رقم القرض..." empty-title="لا توجد وعود سداد" empty-description="ستظهر الوعود المسجلة مع المبلغ والموعد وحالة الالتزام هنا." />
@endsection
