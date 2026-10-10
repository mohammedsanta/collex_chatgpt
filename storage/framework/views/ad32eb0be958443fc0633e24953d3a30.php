<?php $__env->startSection('title', 'أنواع القروض | Collex'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm text-emerald-400">COLLEX / الإدارة</p>
            <h1 class="mt-1 text-2xl font-bold">أنواع القروض</h1>
            <p class="mt-1 text-sm text-slate-400">
                إدارة أنواع القروض المتاحة داخل النظام.
            </p>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Domain\Institutions\Models\LoanType::class)): ?>
            <a
                href="<?php echo e(route('loan-types.create')); ?>"
                class="rounded-lg bg-emerald-400 px-4 py-2.5 font-bold text-slate-950 transition hover:bg-emerald-300"
            >
                + إضافة نوع قرض
            </a>
        <?php endif; ?>
    </div>

    
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">إجمالي الأنواع</p>
            <p class="mt-3 text-3xl font-bold num">
                <?php echo e(number_format($statistics['total'])); ?>

            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">الأنواع النشطة</p>
            <p class="mt-3 text-3xl font-bold text-emerald-400 num">
                <?php echo e(number_format($statistics['active'])); ?>

            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">الأنواع غير النشطة</p>
            <p class="mt-3 text-3xl font-bold text-slate-300 num">
                <?php echo e(number_format($statistics['inactive'])); ?>

            </p>
        </div>
    </div>

    
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <form
            method="GET"
            action="<?php echo e(route('loan-types.index')); ?>"
            class="grid gap-3 md:grid-cols-[1fr_220px_auto]"
        >
            <input
                type="search"
                name="search"
                value="<?php echo e($filters['search'] ?? ''); ?>"
                placeholder="ابحث باسم نوع القرض..."
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-emerald-400 focus:outline-none"
            >

            <select
                name="status"
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
            >
                <option value="">كل الحالات</option>
                <option value="active" <?php if(($filters['status'] ?? '') === 'active'): echo 'selected'; endif; ?>>
                    نشط
                </option>
                <option value="inactive" <?php if(($filters['status'] ?? '') === 'inactive'): echo 'selected'; endif; ?>>
                    غير نشط
                </option>
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="rounded-lg bg-slate-700 px-5 py-3 font-semibold transition hover:bg-slate-600"
                >
                    بحث
                </button>

                <a
                    href="<?php echo e(route('loan-types.index')); ?>"
                    class="rounded-lg border border-slate-700 px-4 py-3 transition hover:bg-slate-800"
                >
                    إعادة
                </a>
            </div>
        </form>
    </section>

    
    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800 p-5">
            <div>
                <h2 class="font-semibold">سجلات أنواع القروض</h2>
                <p class="mt-1 text-sm text-slate-400">
                    عدد النتائج: <?php echo e(number_format($loanTypes->total())); ?>

                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3">#</th>
                        <th class="whitespace-nowrap px-4 py-3">اسم نوع القرض</th>
                        <th class="whitespace-nowrap px-4 py-3">ملفات القروض المرتبطة</th>
                        <th class="whitespace-nowrap px-4 py-3">الحالة</th>
                        <th class="whitespace-nowrap px-4 py-3">تاريخ الإضافة</th>
                        <th class="whitespace-nowrap px-4 py-3">الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $loanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-800 transition hover:bg-slate-800/50">
                            <td class="whitespace-nowrap px-4 py-4 text-slate-400 num">
                                <?php echo e($loanType->id); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold">
                                <?php echo e($loanType->name); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-300 num">
                                <?php echo e(number_format($loanType->debt_cases_count)); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <?php if($loanType->is_active): ?>
                                    <span class="rounded-lg bg-emerald-400/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">
                                        نشط
                                    </span>
                                <?php else: ?>
                                    <span class="rounded-lg bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-300">
                                        غير نشط
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-400 num">
                                <?php echo e($loanType->created_at?->format('Y-m-d') ?? '—'); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $loanType)): ?>
                                        <a
                                            href="<?php echo e(route('loan-types.edit', $loanType)); ?>"
                                            class="font-semibold text-emerald-400 hover:text-emerald-300"
                                        >
                                            تعديل
                                        </a>
                                    <?php endif; ?>

                                    <?php if($loanType->is_active): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deactivate', $loanType)): ?>
                                            <form
                                                method="POST"
                                                action="<?php echo e(route('loan-types.deactivate', $loanType)); ?>"
                                            >
                                                <?php echo csrf_field(); ?>
                                                <button
                                                    type="submit"
                                                    class="font-semibold text-amber-400 hover:text-amber-300"
                                                >
                                                    تعطيل
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('activate', $loanType)): ?>
                                            <form
                                                method="POST"
                                                action="<?php echo e(route('loan-types.activate', $loanType)); ?>"
                                            >
                                                <?php echo csrf_field(); ?>
                                                <button
                                                    type="submit"
                                                    class="font-semibold text-emerald-400 hover:text-emerald-300"
                                                >
                                                    تفعيل
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if($loanType->debt_cases_count === 0): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $loanType)): ?>
                                                <form
                                                    method="POST"
                                                    action="<?php echo e(route('loan-types.destroy', $loanType)); ?>"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف نوع القرض؟')"
                                                >
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button
                                                        type="submit"
                                                        class="font-semibold text-rose-400 hover:text-rose-300"
                                                    >
                                                        حذف
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <p class="font-semibold text-slate-200">
                                    لا توجد أنواع قروض مطابقة.
                                </p>
                                <p class="mt-2 text-sm text-slate-400">
                                    جرّب تغيير البحث أو الفلاتر.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($loanTypes->hasPages()): ?>
            <div class="border-t border-slate-800 p-4">
                <?php echo e($loanTypes->links()); ?>

            </div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loan-types/index.blade.php ENDPATH**/ ?>