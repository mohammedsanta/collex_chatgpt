<?php $__env->startSection('title', ($bank->name ?? 'البنك') . ' | Collex'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-emerald-400">COLLEX / البنوك</p>
            <h1 class="mt-2 text-3xl font-bold"><?php echo e($bank->name); ?></h1>
            <p class="mt-2 text-sm text-slate-400">
                كود البنك: <?php echo e($bank->code); ?> · رقم السجل: #<?php echo e($bank->id); ?>

            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="<?php echo e(route('banks.index')); ?>"
               class="rounded-xl border border-slate-700 px-4 py-3 hover:bg-slate-800">
                كل البنوك
            </a>
            <a href="<?php echo e(route('banks.edit', $bank)); ?>"
               class="rounded-xl bg-emerald-400 px-4 py-3 font-bold text-slate-950 hover:bg-emerald-300">
                تعديل البنك
            </a>
        </div>
    </div>

    <?php echo $__env->make('banks._nav', ['bank' => $bank], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(session('success')): ?>
        <div class="rounded-xl border border-emerald-700 bg-emerald-950 p-4 text-emerald-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold">بيانات البنك</h2>
                <p class="mt-1 text-sm text-slate-400">ملخص البيانات الأساسية وحالة البنك.</p>
            </div>

            <?php if($bank->is_active): ?>
                <span class="rounded-full bg-emerald-950 px-3 py-1 text-sm text-emerald-300">
                    نشط
                </span>
            <?php else: ?>
                <span class="rounded-full bg-slate-800 px-3 py-1 text-sm text-slate-400">
                    غير نشط
                </span>
            <?php endif; ?>
        </div>

        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">القطاع</p>
                <p class="mt-2 font-semibold"><?php echo e($bank->sector ?: 'غير محدد'); ?></p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">المستخدمون المرتبطون</p>
                <p class="mt-2 text-2xl font-bold"><?php echo e(number_format($bank->users_count ?? 0)); ?></p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">المحافظ</p>
                <p class="mt-2 text-2xl font-bold"><?php echo e(number_format($bank->portfolios_count ?? 0)); ?></p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">تاريخ الإنشاء</p>
                <p class="mt-2 font-semibold"><?php echo e($bank->created_at?->format('Y-m-d') ?? '—'); ?></p>
            </div>
        </div>

        <?php if($bank->notes): ?>
            <div class="mt-5 rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">ملاحظات</p>
                <p class="mt-2 whitespace-pre-line text-slate-300"><?php echo e($bank->notes); ?></p>
            </div>
        <?php endif; ?>
    </section>

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold">محافظ البنك</h2>
                <p class="mt-1 text-sm text-slate-400">أحدث المحافظ المسجلة لهذا البنك.</p>
            </div>
            <a href="<?php echo e(route('banks.distribution.index', $bank)); ?>"
               class="text-sm font-semibold text-emerald-400 hover:text-emerald-300">
                عرض التوزيع ←
            </a>
        </div>

        <div class="mt-5 overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="px-4 py-3">اسم المحفظة</th>
                        <th class="px-4 py-3">الفترة</th>
                        <th class="px-4 py-3">عدد الحالات</th>
                        <th class="px-4 py-3">إجمالي المديونية</th>
                        <th class="px-4 py-3">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <?php $__empty_1 = true; $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-4 font-semibold"><?php echo e($portfolio->name); ?></td>
                            <td class="px-4 py-4 text-slate-300">
                                <?php echo e($portfolio->period_month); ?>/<?php echo e($portfolio->period_year); ?>

                            </td>
                            <td class="px-4 py-4"><?php echo e(number_format($portfolio->cases_count ?? 0)); ?></td>
                            <td class="px-4 py-4 tabular-nums">
                                <?php echo e(number_format((float) ($portfolio->total_debt ?? 0), 2)); ?>

                            </td>
                            <td class="px-4 py-4 text-slate-300"><?php echo e($portfolio->status ?? '—'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-500">
                                لا توجد محافظ مسجلة لهذا البنك حتى الآن.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($portfolios->links()); ?></div>
    </section>

    <section class="rounded-2xl border border-rose-900/60 bg-slate-900 p-5">
        <h2 class="font-bold text-rose-300">إجراءات إدارية</h2>
        <p class="mt-2 text-sm text-slate-400">
            حذف البنك إجراء دائم وقد يتأثر بالسجلات المرتبطة به.
        </p>

        <form method="POST" action="<?php echo e(route('banks.destroy', $bank)); ?>"
              class="mt-4"
              onsubmit="return confirm('هل أنت متأكد من حذف هذا البنك؟')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit"
                    class="rounded-xl border border-rose-800 px-4 py-2 text-sm text-rose-300 hover:bg-rose-950">
                حذف البنك
            </button>
        </form>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/show.blade.php ENDPATH**/ ?>