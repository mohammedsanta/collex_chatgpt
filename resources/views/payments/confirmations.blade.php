@extends('layouts.app')

@section('title', 'تأكيد التحصيلات')
@section('topbar-title', 'تأكيد التحصيلات')

@section('content')
    <x-page-header
        title="تأكيد التحصيلات"
        subtitle="مراجعة التحصيلات المعلقة وتأكيدها أو رفضها"
        eyebrow="إدارة التحصيل"
        icon="fa-solid fa-circle-check"
    />

    @if (session('status'))
        <div
            role="status"
            class="app-flash mb-4"
        >
            <i class="fa-solid fa-circle-check ml-2"></i>
            {{ session('status') }}
        </div>
    @endif

    @include('payments.partials._statistics')

    <x-panel title="مراجعة التحصيلات" :padding="false">
        @include('payments.partials._filters')
        @include('payments.partials._table')
    </x-panel>
@endsection