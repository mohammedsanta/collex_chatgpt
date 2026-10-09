<?php $__env->startSection('title', 'استيراد البيانات'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="space-y-6 text-slate-100">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-400">
                <a href="<?php echo e(route('banks.panel', ['bank' => $bank->id])); ?>"
                   class="transition hover:text-emerald-400">
                    البنوك
                </a>
                <span>/</span>
                <span><?php echo e($bank->name); ?></span>
                <span>/</span>
                <span class="text-emerald-400">استيراد البيانات</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight">
                استيراد بيانات العملاء والمديونيات
            </h1>

            <p class="mt-2 text-sm text-slate-400">
                ارفع ملف البنك لاستيراد بيانات العملاء وسجلات المديونيات إلى إحدى المحافظ.
            </p>
        </div>

        <a href="<?php echo e(route('banks.distribution.index', ['bank' => $bank->id])); ?>"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700
                  bg-slate-900 px-4 py-3 text-sm font-semibold text-slate-200
                  transition hover:border-emerald-500 hover:text-emerald-400">
            <span>←</span>
            العودة إلى توزيع المحافظ
        </a>
    </div>

    
    <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                            border border-emerald-500/20 bg-emerald-500/10 text-2xl text-emerald-400">
                    <span>▤</span>
                </div>

                <div>
                    <p class="text-sm text-slate-400">البنك المحدد</p>
                    <h2 class="mt-1 text-lg font-bold"><?php echo e($bank->name); ?></h2>
                    <p class="mt-1 text-xs text-slate-500">
                        كود البنك: <?php echo e($bank->code ?: '—'); ?>

                    </p>
                </div>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/70 px-4 py-3">
                <p class="text-xs text-slate-500">المحافظ المتاحة</p>
                <p class="mt-1 text-xl font-bold text-emerald-400">
                    <?php echo e($portfolios->count()); ?>

                </p>
            </div>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-300">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4">
            <p class="mb-2 font-semibold text-red-300">يرجى مراجعة البيانات التالية:</p>
            <ul class="list-inside list-disc space-y-1 text-sm text-red-200">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        
        <section class="xl:col-span-2">
            <div class="h-full rounded-2xl border border-slate-800 bg-slate-900/70 p-5 sm:p-7">
                <div class="mb-6 flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                                bg-emerald-500/10 text-xl text-emerald-400">
                        ↑
                    </div>

                    <div>
                        <h2 class="text-lg font-bold">رفع ملف الاستيراد</h2>
                        <p class="mt-1 text-sm text-slate-400">
                            حدد المحفظة والملف الذي يحتوي على بيانات العملاء والمديونيات.
                        </p>
                    </div>
                </div>

                <?php if($portfolios->isEmpty()): ?>
                    <div class="rounded-xl border border-amber-500/30 bg-amber-500/10 p-4">
                        <p class="font-semibold text-amber-300">لا توجد محافظ لهذا البنك</p>
                        <p class="mt-2 text-sm text-slate-300">
                            أنشئ محفظة أولاً، ثم ارجع إلى هذه الصفحة لاستيراد بياناتها.
                        </p>
                        <a href="<?php echo e(route('banks.distribution.index', ['bank' => $bank->id])); ?>"
                           class="mt-4 inline-flex rounded-lg bg-amber-400 px-4 py-2
                                  text-sm font-bold text-slate-950 transition hover:bg-amber-300">
                            الانتقال إلى المحافظ
                        </a>
                    </div>
                <?php else: ?>
                    <form id="portfolio-import-form"
                          method="POST"
                          action="<?php echo e(route('portfolios.import.store', ['portfolio' => $portfolios->first()->id])); ?>"
                          enctype="multipart/form-data"
                          class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label for="portfolio_id"
                                   class="mb-2 block text-sm font-semibold text-slate-200">
                                المحفظة المستهدفة
                                <span class="text-red-400">*</span>
                            </label>

                            <select id="portfolio_id"
                                    name="portfolio_id"
                                    required
                                    class="w-full rounded-xl border border-slate-700 bg-slate-950
                                           px-4 py-3 text-sm text-slate-100 outline-none
                                           transition focus:border-emerald-500 focus:ring-2
                                           focus:ring-emerald-500/10">
                                <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($portfolio->id); ?>"
                                            data-import-url="<?php echo e(route('portfolios.import.store', ['portfolio' => $portfolio->id])); ?>"
                                            <?php if((string) old('portfolio_id') === (string) $portfolio->id
                                                || (!old('portfolio_id') && $loop->first)): echo 'selected'; endif; ?>>
                                        <?php echo e($portfolio->name); ?>

                                        — <?php echo e($portfolio->period_month); ?>/<?php echo e($portfolio->period_year); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <p class="mt-2 text-xs text-slate-500">
                                سيتم ربط سجلات المديونية بالمحفظة المختارة.
                            </p>
                        </div>

                        <div>
                            <label for="file"
                                   class="mb-2 block text-sm font-semibold text-slate-200">
                                ملف العملاء والمديونيات
                                <span class="text-red-400">*</span>
                            </label>

                            <label for="file"
                                   class="flex cursor-pointer flex-col items-center justify-center
                                          rounded-2xl border-2 border-dashed border-slate-700
                                          bg-slate-950/70 px-5 py-10 text-center transition
                                          hover:border-emerald-500/70 hover:bg-emerald-500/5">
                                <span class="mb-4 flex h-14 w-14 items-center justify-center
                                             rounded-2xl bg-emerald-500/10 text-3xl text-emerald-400">
                                    ⇧
                                </span>

                                <span class="font-semibold text-slate-200">
                                    اضغط لاختيار الملف
                                </span>
                                <span class="mt-2 text-xs text-slate-500">
                                    Excel أو CSV — حسب الصيغ المدعومة في نظام الاستيراد
                                </span>

                                <span id="selected-file-name"
                                      class="mt-4 max-w-full break-all text-sm text-emerald-400">
                                    لم يتم اختيار ملف
                                </span>

                                <input id="file"
                                       name="file"
                                       type="file"
                                       required
                                       accept=".xlsx,.xls,.csv"
                                       class="sr-only">
                            </label>

                            <p class="mt-2 text-xs text-slate-500">
                                تأكد من أن الملف يحتوي على صف العناوين وأن أرقام القروض
                                والبيانات المالية مكتوبة بصورة صحيحة.
                            </p>
                        </div>

                        <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 text-lg text-amber-400">ⓘ</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-200">
                                        قبل بدء الاستيراد
                                    </p>
                                    <p class="mt-1 text-sm leading-6 text-slate-400">
                                        راجع الأعمدة المطلوبة وتأكد من صحة بيانات العميل
                                        ورقم القرض والمبالغ. تعتمد مطابقة العملاء ومنع التكرار
                                        على قواعد الاستيراد الموجودة في النظام.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 border-t border-slate-800 pt-5 sm:flex-row">
                            <button type="submit"
                                    class="inline-flex flex-1 items-center justify-center gap-2
                                           rounded-xl bg-emerald-500 px-5 py-3 font-bold
                                           text-slate-950 transition hover:bg-emerald-400
                                           focus:outline-none focus:ring-2 focus:ring-emerald-400
                                           focus:ring-offset-2 focus:ring-offset-slate-900">
                                <span>↑</span>
                                بدء الاستيراد
                            </button>

                            <button type="reset"
                                    id="reset-import-form"
                                    class="rounded-xl border border-slate-700 bg-slate-800
                                           px-5 py-3 font-semibold text-slate-300
                                           transition hover:bg-slate-700">
                                مسح الاختيار
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </section>

        
        <aside class="space-y-6">
            <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5">
                <h3 class="font-bold">خطوات الاستيراد</h3>

                <ol class="mt-5 space-y-5">
                    <li class="flex gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center
                                     rounded-full bg-emerald-500/10 text-sm font-bold text-emerald-400">
                            1
                        </span>
                        <div>
                            <p class="text-sm font-semibold">اختيار المحفظة</p>
                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                حدد المحفظة التي ستُسجل فيها المديونيات.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center
                                     rounded-full bg-emerald-500/10 text-sm font-bold text-emerald-400">
                            2
                        </span>
                        <div>
                            <p class="text-sm font-semibold">اختيار الملف</p>
                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                ارفع ملف العملاء والقروض من جهازك.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center
                                     rounded-full bg-emerald-500/10 text-sm font-bold text-emerald-400">
                            3
                        </span>
                        <div>
                            <p class="text-sm font-semibold">التحقق والمعالجة</p>
                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                يعالج النظام البيانات وفق قواعد التحقق والمطابقة المعرّفة.
                            </p>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="rounded-2xl border border-sky-500/20 bg-sky-500/5 p-5">
                <div class="flex items-center gap-2">
                    <span class="text-lg text-sky-400">✓</span>
                    <h3 class="font-bold text-sky-300">مراجعة البيانات</h3>
                </div>
                <p class="mt-3 text-sm leading-6 text-slate-400">
                    يفضل الاحتفاظ بنسخة من الملف الأصلي ومراجعة نتيجة الاستيراد
                    بعد انتهاء المعالجة، خصوصاً السجلات التي لم يتم قبولها.
                </p>
            </div>
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

    if (form && portfolioSelect) {
        const updateAction = function () {
            const selected = portfolioSelect.options[portfolioSelect.selectedIndex];

            if (selected && selected.dataset.importUrl) {
                form.action = selected.dataset.importUrl;
            }
        };

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

    if (resetButton && fileInput && fileName) {
        resetButton.addEventListener('click', function () {
            window.setTimeout(function () {
                fileName.textContent = 'لم يتم اختيار ملف';
                if (portfolioSelect) {
                    portfolioSelect.dispatchEvent(new Event('change'));
                }
            }, 0);
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/scope/import.blade.php ENDPATH**/ ?>