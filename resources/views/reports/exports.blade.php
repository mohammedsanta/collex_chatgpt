@extends('layouts.app')
@section('title', 'عمليات تصدير التقارير')
@section('content')
<x-module-index title="عمليات تصدير التقارير" subtitle="متابعة ملفات التصدير وحالة المعالجة وصلاحية الملفات." eyebrow="التقارير" icon="fa-file-export" :rows="$exports ?? $items ?? collect()" :columns="[['key' => 'type', 'label' => 'نوع التقرير', 'type' => 'text'], ['key' => 'format', 'label' => 'الصيغة', 'type' => 'text'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status'], ['key' => 'row_count', 'label' => 'عدد الصفوف', 'type' => 'text'], ['key' => 'generated_at', 'label' => 'تاريخ الإنشاء', 'type' => 'date'], ['key' => 'expires_at', 'label' => 'تاريخ الانتهاء', 'type' => 'date']]"   search="true" search-placeholder="ابحث بالاسم أو الكود..." />
@endsection
