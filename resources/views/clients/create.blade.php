@extends('layouts.app')
@section('title', 'إضافة عميل')
@section('content')
<x-page-header title="إضافة عميل جديد" subtitle="أنشئ ملفًا مركزيًا يحتوي على بيانات الهوية والتواصل والعمل." eyebrow="العملاء / إضافة" icon="fa-user-plus"><x-slot:actions><a href="{{ route('clients.index') }}" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> العودة للعملاء</a></x-slot:actions></x-page-header>
<div class="mx-auto max-w-4xl"><x-panel title="بيانات العميل" subtitle="الحقول المعلّمة بنجمة مطلوبة" icon="fa-id-card"><form method="POST" action="{{ route('clients.store') }}">@include('clients._form')</form></x-panel></div>
@endsection
