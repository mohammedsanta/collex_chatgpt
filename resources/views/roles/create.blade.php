
@extends('layouts.app')

@section('title', 'إضافة دور - Collex')

@section('content')
<div class="space-y-6" dir="rtl">

    <x-page-header
        title="إضافة دور جديد"
        subtitle="إنشاء دور مخصص لتحديد مسؤوليات الموظفين."
    />

    <x-flash />

    <x-panel title="بيانات الدور">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            @include('roles.partials.form')
        </form>
    </x-panel>

</div>
@endsection
