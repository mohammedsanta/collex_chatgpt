@extends('layouts.guest')
@section('title', 'حدث خطأ')
@section('content')
<div class="text-center"><h1 class="text-xl font-extrabold">حدث خطأ</h1><p class="mt-3 text-xs text-muted">تعذر إكمال طلبك.</p><a href="{{ url('/') }}" class="app-btn app-btn-primary mt-5">العودة للرئيسية</a></div>
@endsection
