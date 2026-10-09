@extends('layouts.app')
@section('title', 'الزيارات الميدانية')
@section('topbar-title', 'الزيارات الميدانية')
@section('content')
@php($records = $visits ?? $items ?? collect())
<x-module-index title="الزيارات الميدانية" subtitle="جدولة الزيارات وتوثيق نتيجتها وربطها بالقضية والمحصل المسؤول." eyebrow="إدارة التحصيل" icon="fa-location-dot" :rows="$records" :columns="[['key'=>'debtCase.client.name','label'=>'العميل','type'=>'text'],['key'=>'debtCase.loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'user.name','label'=>'المحصل','type'=>'text'],['key'=>'scheduled_at','label'=>'الموعد','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status'],['key'=>'outcome','label'=>'النتيجة','type'=>'text']]" show-route="banks.visits.show" edit-route="banks.visits.edit" create-route="banks.visits.create" search="true" search-placeholder="اسم العميل أو المحصل..." empty-title="لا توجد زيارات مجدولة" empty-description="سجّل زيارة جديدة لمتابعة الحالات التي تحتاج إلى تواصل ميداني." />
@endsection
