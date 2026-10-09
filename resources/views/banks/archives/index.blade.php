@extends('layouts.app')
@section('title', 'أرشيف البنك')
@section('content')
<x-module-index title="أرشيف البنك" subtitle="الأرشيفات الشهرية المرتبطة بهذه المؤسسة." eyebrow="banks" icon="fa-box-archive" :rows="$archives ?? $items ?? collect()" :columns="[['key' => 'year', 'label' => 'السنة', 'type' => 'text'], ['key' => 'month', 'label' => 'الشهر', 'type' => 'text'], ['key' => 'cases_count', 'label' => 'عدد القضايا', 'type' => 'text'], ['key' => 'total_debt', 'label' => 'إجمالي الدين', 'type' => 'money'], ['key' => 'collected_amount', 'label' => 'إجمالي التحصيل', 'type' => 'money'], ['key' => 'archived_at', 'label' => 'تاريخ الأرشفة', 'type' => 'date']]" create-route="banks.archives.create" show-route="banks.archives.show" search="true" search-placeholder="ابحث بالاسم أو الكود..." />
@endsection
