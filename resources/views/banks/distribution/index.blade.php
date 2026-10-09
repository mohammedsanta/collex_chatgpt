@extends('layouts.app')
@section('title', 'توزيع المحافظ')
@section('topbar-title', 'توزيع المحافظ')
@section('content')
@php($records = $portfolios ?? $items ?? collect())
<x-page-header title="توزيع المحافظ" subtitle="توزيع ملفات التحصيل على الفرق ومتابعة حالة كل محفظة." eyebrow="المحافظ والمؤسسات" icon="fa-diagram-project" />
<div class="mb-5 grid gap-3 sm:grid-cols-3"><x-stat-card label="إجمالي المحافظ المعروضة" :value="number_format(method_exists($records, 'count') ? $records->count() : count($records))" icon="fa-boxes-stacked" color="green" hint="حسب النتائج الحالية"/><x-stat-card label="محافظ نشطة" :value="number_format(collect($records)->where('status','active')->count())" icon="fa-circle-play" color="blue" hint="جاهزة للتحصيل"/><x-stat-card label="محافظ مسودة" :value="number_format(collect($records)->where('status','draft')->count())" icon="fa-file-pen" color="orange" hint="تحتاج مراجعة قبل التفعيل"/></div>
<x-module-index title="المحافظ" subtitle="اختَر محفظة لمراجعة بياناتها وتوزيع المسؤوليات." icon="fa-diagram-project" :rows="$records" :columns="[['key'=>'name','label'=>'اسم المحفظة','type'=>'text'],['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'period_year','label'=>'السنة','type'=>'text'],['key'=>'period_month','label'=>'الشهر','type'=>'text'],['key'=>'cases_count','label'=>'عدد القضايا','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'status','label'=>'الحالة','type'=>'status']]" show-route="banks.distribution.show" edit-route="banks.distribution.edit" search="true" search-placeholder="اسم المحفظة أو البنك..." empty-title="لا توجد محافظ للتوزيع" empty-description="بعد إنشاء المحفظة أو استيراد ملفها، ستظهر هنا لتوزيع القضايا على أعضاء الفريق." />
@endsection
