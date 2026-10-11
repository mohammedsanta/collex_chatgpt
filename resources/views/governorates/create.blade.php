
@extends('layouts.app')

@section('title', 'إضافة محافظة')
@section('topbar-title', 'إضافة محافظة')

@section('content')
    <x-page-header
        title="إضافة محافظة"
        subtitle="تسجيل محافظة جديدة لاستخدامها داخل النظام."
        eyebrow="إدارة المؤسسات"
        icon="fa-map-location-dot"
    />

    <div class="mx-auto max-w-3xl">
        <div class="app-card">
            <div class="app-card-header">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-xl border border-brand/20 bg-brand/10 text-brand">
                        <i class="fa-solid fa-plus"></i>
                    </span>

                    <div>
                        <h2 class="text-sm font-extrabold text-fg">
                            بيانات المحافظة
                        </h2>
                        <p class="mt-1 text-xs text-muted">
                            أدخل بيانات المحافظة الجديدة.
                        </p>
                    </div>
                </div>

                <span class="app-badge app-badge-green">
                    <i class="fa-solid fa-circle-plus"></i>
                    سجل جديد
                </span>
            </div>

            <div class="app-card-body">
                @if ($errors->any())
                    <div class="app-flash app-flash-error" role="alert">
                        <i class="fa-solid fa-circle-exclamation mt-1"></i>
                        <div>
                            <p class="font-extrabold">يرجى مراجعة البيانات التالية:</p>
                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form
                    action="{{ route('governorates.store') }}"
                    method="POST"
                    class="space-y-5"
                >
                    @csrf

                    @include('governorates._form')

                </form>
            </div>
        </div>
    </div>
@endsection
