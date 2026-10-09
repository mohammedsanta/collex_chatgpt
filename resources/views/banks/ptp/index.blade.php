@extends('layouts.app')
@section('title', 'وعود السداد')
@section('content')
<x-module-index title="وعود السداد" subtitle="متابعة الوعود المسجلة لعملاء البنك وحالة الالتزام بها." eyebrow="banks" icon="fa-handshake" :rows="$promises ?? $items ?? collect()" :columns="[['key' => 'debtCase.client.name', 'label' => 'العميل', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'money'], ['key' => 'paid_amount', 'label' => 'المبلغ المدفوع', 'type' => 'money'], ['key' => 'promise_date', 'label' => 'تاريخ الوعد', 'type' => 'date'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']]" create-route="banks.ptp.create" show-route="banks.ptp.show" search="true" search-placeholder="ابحث بالاسم أو الكود..." />
@endsection
