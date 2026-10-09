@extends('layouts.app')
@section('title', 'التقارير')
@section('topbar-title', 'التقارير')
@section('content')
<x-page-header title="التقارير" subtitle="اختر نوع التقرير والفترة المطلوبة، ثم راجع النتائج أو صدّرها حسب الصلاحيات المتاحة." eyebrow="الفريق والإدارة" icon="fa-chart-column" />
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
@foreach([['تحصيل يومي','ملخص التحصيل والمكالمات والزيارات والوعود حسب الموظف والبنك.','fa-calendar-day','reports.daily'],['أداء الفريق','مقارنة الأداء والأهداف والنتائج بين أعضاء فريق التحصيل.','fa-chart-line','reports.performance'],['تحليل المحافظ','عرض عدد القضايا وإجمالي الدين والتحصيل حسب المحفظة.','fa-layer-group','reports.portfolios'],['حالة الوعود','متابعة الوعود التي تم الوفاء بها أو كسرها أو تأجيلها.','fa-handshake','reports.promises'],['سجل التصدير','متابعة ملفات التصدير ونتائجها وتاريخ انتهاء صلاحيتها.','fa-file-export','reports.exports'],['سجل النشاط','مراجعة الأحداث المهمة والتغييرات المسجلة على النظام.','fa-clock-rotate-left','activity-logs.index']] as $report)
<div class="app-card flex flex-col p-5"><span class="grid h-11 w-11 place-items-center rounded-xl border border-brand/20 bg-brand/10 text-brand"><i class="fa-solid {{ $report[2] }}"></i></span><h2 class="mt-4 text-sm font-extrabold text-fg">{{ $report[0] }}</h2><p class="mt-2 flex-1 text-[11px] leading-6 text-muted">{{ $report[1] }}</p><div class="mt-5">@if(\Illuminate\Support\Facades\Route::has($report[3]))<a href="{{ route($report[3]) }}" class="app-btn app-btn-secondary w-full">فتح التقرير <i class="fa-solid fa-arrow-left"></i></a>@else<span class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-line px-3 py-2.5 text-[10px] font-bold text-dim"><i class="fa-solid fa-link-slash"></i> المسار غير مربوط بعد</span>@endif</div></div>
@endforeach
</div>
<div class="mt-5">@if(\Illuminate\Support\Facades\Route::has('reports.exports'))<a href="{{ route('reports.exports') }}" class="app-btn app-btn-primary"><i class="fa-solid fa-file-export"></i> متابعة عمليات التصدير</a>@endif</div>
@endsection
