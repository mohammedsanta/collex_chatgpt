
@extends('layouts.app')

@section('title', 'تعديل المحافظة')
@section('topbar-title', 'تعديل المحافظة')

@section('content')
    <x-page-header
        title="تعديل المحافظة"
        subtitle="تحديث بيانات المحافظة المسجلة في النظام."
        eyebrow="إدارة المؤسسات"
        icon="fa-map-location-dot"
    />

    <div class="mx-auto max-w-3xl">
        <div class="app-card">
            <div class="app-card-header">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-xl border border-brand/20 bg-brand/10 text-brand">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>

                    <div>
                        <h2 class="text-sm font-extrabold text-fg">
                            بيانات المحافظة
                        </h2>
                        <p class="mt-1 text-xs text-muted">
                            تعديل بيانات: {{ $governorate->name }}
                        </p>
                    </div>
                </div>

                <span class="app-badge app-badge-blue">
                    <i class="fa-solid fa-file-pen"></i>
                    تعديل
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
                    action="{{ route('governorates.update', $governorate) }}"
                    method="POST"
                    class="space-y-5"
                >
                    @csrf
                    @method('PUT')

                    @include('governorates._form')

                </form>
            </div>
        </div>

        <div class="mt-4 flex items-start gap-3 rounded-xl border border-line bg-white/[0.02] p-4">
            <i class="fa-solid fa-circle-info mt-0.5 text-info"></i>
            <p class="text-xs leading-6 text-muted">
                تأكد من صحة اسم المحافظة قبل حفظ التعديلات. ستُحفظ البيانات بعد اجتياز التحقق.
            </p>
        </div>
    </div>
@endsection
