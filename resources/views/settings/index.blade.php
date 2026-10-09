@extends('layouts.app')
@section('title', 'إعدادات النظام')
@section('content')
<x-page-header title="إعدادات النظام" subtitle="إدارة القيم التشغيلية التي تتحكم في سلوك النظام." eyebrow="تهيئة النظام" icon="fa-sliders"><x-slot:actions><span class="inline-flex items-center gap-2 rounded-xl border border-line bg-surface px-3 py-2 text-[10px] font-bold text-muted"><i class="fa-solid fa-shield-halved text-brand"></i> صلاحيات الإدارة</span></x-slot:actions></x-page-header>
<div class="mb-5 flex items-start gap-3 rounded-xl border border-info/20 bg-info/10 p-4 text-info"><i class="fa-solid fa-circle-info mt-0.5"></i><p class="text-[10px] leading-6">عدّل الإعدادات بعناية؛ بعض القيم قد تؤثر على سلوك العمليات والتقارير. لا تحفظ بيانات حساسة مثل كلمات المرور كنص صريح.</p></div>
<form method="POST" action="{{ route('settings.update') }}" class="space-y-5">@csrf @method('PUT')
@forelse($settings as $group => $items)
    <x-panel :title="str_replace('_',' ',ucfirst($group))" subtitle="الإعدادات المصنفة ضمن هذه المجموعة" icon="fa-gear"><div class="grid gap-x-5 gap-y-4 md:grid-cols-2">@foreach($items as $setting)<label class="block"><span class="app-label">{{ $setting->label ?? str_replace('_',' ',ucfirst($setting->key)) }}</span>@if(($setting->type ?? '') === 'boolean')<select name="settings[{{ $setting->key }}]" class="app-input"><option value="1" @selected(old('settings.'.$setting->key, $setting->value) == '1')>مفعّل</option><option value="0" @selected(old('settings.'.$setting->key, $setting->value) == '0')>معطّل</option></select>@elseif(($setting->type ?? '') === 'text')<textarea name="settings[{{ $setting->key }}]" class="app-input" rows="3">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>@else<input name="settings[{{ $setting->key }}]" value="{{ old('settings.'.$setting->key, $setting->value) }}" class="app-input" maxlength="5000" @if(($setting->type ?? '') === 'integer') inputmode="numeric" @endif>@endif<span class="app-help">المفتاح: <code>{{ $setting->key }}</code> · النوع: {{ $setting->type ?? 'text' }}</span></label>@endforeach</div></x-panel>
@empty
    <x-panel title="لا توجد إعدادات" icon="fa-gear"><x-empty-state title="لم يتم إعداد أي قيم بعد" description="أضف سجلات الإعدادات من خلال أدوات التهيئة المعتمدة." icon="fa-sliders" /></x-panel>
@endforelse
<div class="flex flex-wrap items-center gap-3"><button class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> حفظ التغييرات</button><span class="text-[10px] text-dim">تُطبّق التغييرات بعد نجاح التحقق والحفظ.</span></div></form>
@endsection
