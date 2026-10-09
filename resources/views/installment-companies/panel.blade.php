@extends('layouts.app')
@section('title', 'شركات التقسيط')
@section('content')
<x-page-header title="مركز شركات التقسيط" subtitle="إدارة المؤسسات الشريكة وملفاتها الأساسية." eyebrow="المؤسسات" icon="fa-shop"><x-slot:actions>@if(\Illuminate\Support\Facades\Route::has('installment-companies.create'))<a href="{{ route('installment-companies.create') }}" class="app-btn app-btn-primary"><i class="fa-solid fa-plus"></i> إضافة شركة</a>@endif</x-slot:actions></x-page-header>
<div class="grid gap-4 sm:grid-cols-2"><x-hub-tile title="كل الشركات" description="عرض قائمة شركات التقسيط وحالتها." icon="fa-shop" href="{{ \Illuminate\Support\Facades\Route::has('installment-companies.index') ? route('installment-companies.index') : '#' }}" :available="\Illuminate\Support\Facades\Route::has('installment-companies.index')"/><x-hub-tile title="إضافة شركة" description="تسجيل مؤسسة جديدة في النظام." icon="fa-circle-plus" href="{{ \Illuminate\Support\Facades\Route::has('installment-companies.create') ? route('installment-companies.create') : '#' }}" :available="\Illuminate\Support\Facades\Route::has('installment-companies.create')"/></div>
@endsection
