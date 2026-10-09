```blade
@extends('layouts.app')

@section('title', 'تعديل المستخدم')

@section('content')

    <x-page-header
        title="تعديل بيانات المستخدم"
        subtitle="تحديث بيانات الحساب والدور والحالة الوظيفية."
        eyebrow="إدارة المستخدمين / تعديل"
        icon="fa-user-pen"
    >
        <x-slot:actions>
            <a href="{{ route('users.show', $user) }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للتفاصيل
            </a>
        </x-slot:actions>
    </x-page-header>

    @include('users.partials.form')

@endsection
```