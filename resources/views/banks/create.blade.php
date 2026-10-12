@extends('layouts.app')

@section('title', 'إضافة بنك | Collex')

@section('content')
    <x-page-header
        title="إضافة بنك جديد"
        subtitle="أدخل بيانات البنك لإضافته إلى المؤسسات المسجلة في Collex."
        eyebrow="إدارة المؤسسات"
        icon="fa-building-columns"
    />

    <div class="mx-auto max-w-4xl space-y-5">

        {{-- Navigation --}}
        <div>
            <a
                href="{{ route('banks.index') }}"
                class="inline-flex items-center gap-2 text-sm text-dim transition hover:text-main"
            >
                <i class="fa-solid fa-arrow-right text-xs"></i>
                العودة إلى البنوك
            </a>
        </div>

        {{-- Create Form --}}
        <x-panel
            title="بيانات البنك"
            subtitle="أدخل البيانات المطلوبة لإنشاء سجل البنك."
            icon="fa-building"
        >
            <form
                method="POST"
                action="{{ route('banks.store') }}"
                class="space-y-6"
            >
                @csrf

                @include('banks._form')

                <div class="flex flex-wrap items-center justify-end gap-3 border-t border-line pt-5">
                    <a
                        href="{{ route('banks.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-line px-5 py-2.5 text-sm font-semibold text-dim transition hover:bg-surface hover:text-main"
                    >
                        <i class="fa-solid fa-xmark text-xs"></i>
                        إلغاء
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-6 py-2.5 text-sm font-bold text-slate-950 transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-brand/40"
                    >
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        حفظ البنك
                    </button>
                </div>
            </form>
        </x-panel>

    </div>
@endsection