@extends('layouts.app')
@section('title', 'الأرشيف الشهري')
@section('topbar-title', 'الأرشيف الشهري')
@section('content')
@php($records = $archives ?? $monthlyArchives ?? $items ?? collect())
<x-module-index title="الأرشيف الشهري" subtitle="استعراض اللقطات الشهرية للمحافظ وإجماليات الدين والتحصيل المؤرشفة." eyebrow="المحافظ والمؤسسات" icon="fa-box-archive" :rows="$records" :columns="[['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'year','label'=>'السنة','type'=>'text'],['key'=>'month','label'=>'الشهر','type'=>'text'],['key'=>'cases_count','label'=>'عدد القضايا','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'collected_amount','label'=>'إجمالي التحصيل','type'=>'money'],['key'=>'archived_at','label'=>'تاريخ الأرشفة','type'=>'date']]" show-route="archives.show" search="true" search-placeholder="البنك أو السنة..." empty-title="لا توجد أرشيفات" empty-description="ستظهر اللقطات الشهرية بعد إتمام عملية الأرشفة." />
@endsection
