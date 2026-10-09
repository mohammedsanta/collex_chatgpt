@extends('layouts.app')
@section('title', 'تقارير التحصيل اليومية')
@section('content')
<x-module-index title="تقارير التحصيل اليومية" subtitle="إدارة التقارير اليومية المرسلة من فريق التحصيل." eyebrow="banks" icon="fa-calendar-check" :rows="$reports ?? $items ?? collect()" :columns="[['key' => 'user.name', 'label' => 'الموظف', 'type' => 'text'], ['key' => 'report_date', 'label' => 'التاريخ', 'type' => 'date'], ['key' => 'cases_worked', 'label' => 'القضايا', 'type' => 'text'], ['key' => 'calls_count', 'label' => 'المكالمات', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'الموعود', 'type' => 'money'], ['key' => 'collected_amount', 'label' => 'المحصل', 'type' => 'money'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']]" create-route="banks.dcr.create"  search="true" search-placeholder="ابحث بالاسم أو الكود..." />
@endsection
