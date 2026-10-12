@extends('layouts.app')

@section('title', 'استيراد البيانات')

@section('content')
<div dir="rtl" class="space-y-6">

    {{-- Header --}}
    <x-page-header
        title="استيراد بيانات العملاء والمديونيات"
        subtitle="ارفع ملف البنك لاستيراد بيانات العملاء وسجلات المديونيات إلى المحفظة المحددة."
        eyebrow="إدارة المحافظ"
        icon="fa-file-import"
    />

    <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2 text-sm text-muted">
            <a
                href="{{ route('banks.panel', ['bank' => $bank->id]) }}"
                class="transition hover:text-brand"
            >
                البنوك
            </a>

            <i class="fa-solid fa-chevron-left text-xs"></i>

            <span>{{ $bank->name }}</span>

            <i class="fa-solid fa-chevron-left text-xs"></i>

            <span class="text-brand">استيراد البيانات</span>
        </div>

        <a
            href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
            class="inline-flex items-center gap-2 rounded-xl border border-line bg-surface px-4 py-2.5 text-sm font-semibold transition hover:border-brand hover:text-brand"
        >
            <i class="fa-solid fa-arrow-right"></i>
            العودة إلى توزيع المحافظ
        </a>
    </div>

    {{-- Bank information --}}
    <x-panel
        title="البنك المحدد"
        subtitle="راجع بيانات البنك قبل بدء عملية الاستيراد."
        icon="fa-building-columns"
    >
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-brand/10 text-xl text-brand">
                    <i class="fa-solid fa-building-columns"></i>
                </div>

                <div>
                    <h2 class="font-bold">{{ $bank->name }}</h2>

                    <p class="mt-1 text-xs text-muted">
                        كود البنك:
                        {{ $bank->code ?: '—' }}
                    </p>
                </div>
            </div>

            <div class="rounded-xl border border-line bg-surface-raised px-5 py-3">
                <p class="text-xs text-muted">المحافظ المتاحة</p>

                <p class="mt-1 text-xl font-extrabold text-brand">
                    {{ $portfolios->count() }}
                </p>
            </div>
        </div>
    </x-panel>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="rounded-xl border border-brand/30 bg-brand/10 p-4 text-sm">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-check mt-0.5 text-brand"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-xl border border-danger/30 bg-danger/10 p-4 text-sm">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation mt-0.5 text-danger"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-xl border border-danger/30 bg-danger/10 p-4">
            <p class="mb-3 text-sm font-bold text-danger">
                يرجى مراجعة البيانات التالية:
            </p>

            <ul class="list-inside list-disc space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Import form --}}
        <section class="xl:col-span-2">
            <x-panel
                title="رفع ملف الاستيراد"
                subtitle="حدد المحفظة المستهدفة ثم اختر ملف العملاء والمديونيات."
                icon="fa-cloud-arrow-up"
            >
                @if ($portfolios->isEmpty())
                    <div class="rounded-xl border border-warning/30 bg-warning/10 p-5">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-triangle-exclamation mt-1 text-warning"></i>

                            <div>
                                <p class="font-bold">لا توجد محافظ لهذا البنك</p>

                                <p class="mt-2 text-sm leading-6 text-muted">
                                    أنشئ محفظة أولاً، ثم ارجع إلى هذه الصفحة لاستيراد البيانات.
                                </p>

                                <a
                                    href="{{ route('banks.distribution.index', ['bank' => $bank->id]) }}"
                                    class="mt-4 inline-flex items-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-bold text-slate-950 transition hover:opacity-90"
                                >
                                    <i class="fa-solid fa-folder-plus"></i>
                                    الانتقال إلى المحافظ
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <form
                        id="portfolio-import-form"
                        method="POST"
                        action="{{ route('portfolios.import.store', ['portfolio' => $portfolios->first()->id]) }}"
                        enctype="multipart/form-data"
                        class="space-y-6"
                    >
                        @csrf

                        {{-- Portfolio --}}
                        <div>
                            <label
                                for="portfolio_id"
                                class="mb-2 block text-sm font-bold"
                            >
                                المحفظة المستهدفة
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                id="portfolio_id"
                                name="portfolio_id"
                                required
                                class="app-input w-full"
                            >
                                @foreach ($portfolios as $portfolio)
                                    <option
                                        value="{{ $portfolio->id }}"
                                        data-import-url="{{ route('portfolios.import.store', ['portfolio' => $portfolio->id]) }}"
                                        @selected(
                                            (string) old('portfolio_id', $portfolios->first()->id)
                                            === (string) $portfolio->id
                                        )
                                    >
                                        {{ $portfolio->name }}
                                        — {{ $portfolio->period_month }}/{{ $portfolio->period_year }}
                                    </option>
                                @endforeach
                            </select>

                            @error('portfolio_id')
                                <p class="mt-2 text-xs text-danger">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs text-muted">
                                سيتم ربط سجلات المديونية بالمحفظة المختارة.
                            </p>
                        </div>

                        {{-- File upload --}}
                        <div>
                            <label
                                for="file"
                                class="mb-2 block text-sm font-bold"
                            >
                                ملف العملاء والمديونيات
                                <span class="text-danger">*</span>
                            </label>

                            <label
                                for="file"
                                class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-line bg-surface-raised p-6 text-center transition hover:border-brand sm:p-10"
                            >
                                <span class="grid h-14 w-14 place-items-center rounded-2xl bg-brand/10 text-2xl text-brand">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </span>

                                <span class="mt-4 text-sm font-bold">
                                    اضغط لاختيار الملف
                                </span>

                                <span class="mt-2 text-xs leading-6 text-muted">
                                    الصيغ المدعومة في الواجهة: CSV وExcel
                                    (.csv, .xlsx, .xls)
                                </span>

                                <span
                                    id="selected-file-name"
                                    class="mt-4 max-w-full break-all text-sm text-brand"
                                    aria-live="polite"
                                >
                                    لم يتم اختيار ملف
                                </span>

                                <input
                                    id="file"
                                    name="file"
                                    type="file"
                                    required
                                    accept=".xlsx,.xls,.csv"
                                    class="sr-only"
                                >
                            </label>

                            @error('file')
                                <p class="mt-2 text-xs text-danger">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs leading-6 text-muted">
                                تأكد من وجود صف العناوين وصحة أرقام القروض
                                والبيانات المالية قبل رفع الملف.
                            </p>
                        </div>

                        {{-- Import notes --}}
                        <div>
                            <x-textarea-field
                                label="ملاحظات الاستيراد"
                                name="notes"
                                rows="3"
                            />

                            @error('notes')
                                <p class="mt-2 text-xs text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Notice --}}
                        <div class="rounded-xl border border-line bg-surface-raised p-4">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-info mt-0.5 text-brand"></i>

                                <div>
                                    <p class="text-sm font-bold">قبل بدء الاستيراد</p>

                                    <p class="mt-2 text-sm leading-6 text-muted">
                                        راجع الأعمدة المطلوبة وتأكد من صحة بيانات العميل
                                        ورقم القرض والمبالغ. تعتمد مطابقة العملاء ومنع التكرار
                                        على قواعد الاستيراد الموجودة في النظام.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col gap-3 border-t border-line pt-5 sm:flex-row">
                            <button
                                type="submit"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-brand px-5 py-3 text-sm font-bold text-slate-950 transition hover:opacity-90"
                            >
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                بدء الاستيراد
                            </button>

                            <button
                                type="reset"
                                id="reset-import-form"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-line bg-surface px-5 py-3 text-sm font-semibold transition hover:border-brand hover:text-brand"
                            >
                                <i class="fa-solid fa-rotate-left"></i>
                                مسح الاختيار
                            </button>
                        </div>
                    </form>
                @endif
            </x-panel>
        </section>

        {{-- Instructions --}}
        <aside class="space-y-6">
            <x-panel
                title="خطوات الاستيراد"
                subtitle="اتبع الخطوات بالترتيب."
                icon="fa-list-check"
            >
                <ol class="space-y-5">
                    <li class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-brand/10 font-bold text-brand">
                            1
                        </span>

                        <div>
                            <p class="text-sm font-bold">اختيار المحفظة</p>

                            <p class="mt-1 text-xs leading-6 text-muted">
                                حدد المحفظة التي ستُسجل فيها المديونيات.
                            </p>
                        </div>
                    </li>

                    <li class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-brand/10 font-bold text-brand">
                            2
                        </span>

                        <div>
                            <p class="text-sm font-bold">اختيار الملف</p>

                            <p class="mt-1 text-xs leading-6 text-muted">
                                ارفع ملف العملاء والقروض من جهازك.
                            </p>
                        </div>
                    </li>

                    <li class="flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-brand/10 font-bold text-brand">
                            3
                        </span>

                        <div>
                            <p class="text-sm font-bold">التحقق والمعالجة</p>

                            <p class="mt-1 text-xs leading-6 text-muted">
                                يعالج النظام البيانات وفق قواعد التحقق والمطابقة المعرّفة.
                            </p>
                        </div>
                    </li>
                </ol>
            </x-panel>

            <x-panel
                title="مراجعة البيانات"
                icon="fa-shield-halved"
            >
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-check mt-1 text-brand"></i>

                    <p class="text-sm leading-6 text-muted">
                        احتفظ بنسخة من الملف الأصلي وراجع نتيجة الاستيراد بعد انتهاء
                        المعالجة، خصوصاً السجلات التي لم يتم قبولها.
                    </p>
                </div>
            </x-panel>
        </aside>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('portfolio-import-form');
    const portfolioSelect = document.getElementById('portfolio_id');
    const fileInput = document.getElementById('file');
    const fileName = document.getElementById('selected-file-name');
    const resetButton = document.getElementById('reset-import-form');

    function updateAction() {
        if (!form || !portfolioSelect) {
            return;
        }

        const selected = portfolioSelect.options[portfolioSelect.selectedIndex];

        if (selected && selected.dataset.importUrl) {
            form.action = selected.dataset.importUrl;
        }
    }

    if (portfolioSelect) {
        portfolioSelect.addEventListener('change', updateAction);
        updateAction();
    }

    if (fileInput && fileName) {
        fileInput.addEventListener('change', function () {
            fileName.textContent = fileInput.files.length
                ? fileInput.files[0].name
                : 'لم يتم اختيار ملف';
        });
    }

    if (resetButton && form) {
        resetButton.addEventListener('click', function () {
            window.setTimeout(function () {
                if (fileName) {
                    fileName.textContent = 'لم يتم اختيار ملف';
                }

                updateAction();
            }, 0);
        });
    }
});
</script>
@endsection