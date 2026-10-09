@extends('layouts.app')
@section('title', 'تعديل بيانات العميل')
@section('content')
<x-page-header title="تعديل بيانات العميل" subtitle="حدّث معلومات العميل مع الحفاظ على سجلّه المرتبط." eyebrow="العملاء / تعديل" icon="fa-user-pen"><x-slot:actions><a href="{{ route('clients.show', $client) }}" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> العودة للملف</a></x-slot:actions></x-page-header>
<div class="mx-auto max-w-4xl"><div class="mb-4 flex items-center gap-3 rounded-xl border border-brand/20 bg-brand/5 p-4"><x-avatar :name="$client->name"/><div><p class="text-xs font-extrabold text-fg">{{ $client->name }}</p><p class="mt-1 text-[10px] text-muted">كود العميل: {{ $client->code }}</p></div></div><x-panel title="تحديث بيانات العميل" subtitle="راجع البيانات قبل الحفظ" icon="fa-pen-to-square"><form method="POST" action="{{ route('clients.update', $client) }}">@method('PUT')@include('clients._form')</form></x-panel></div>
@endsection
