@extends('layouts.app')

@section('title', 'إضافة مستخدم')

@section('content')

    <x-page-header
        title="إضافة مستخدم جديد"
        subtitle="إنشاء حساب موظف وربطه بالدور الوظيفي والمشرف."
        eyebrow="إدارة المستخدمين / إضافة"
        icon="fa-user-plus"
    >
        <x-slot:actions>
            <a href="{{ route('users.index') }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للمستخدمين
            </a>
        </x-slot:actions>
    </x-page-header>

    @include('users.partials.form')

@endsection