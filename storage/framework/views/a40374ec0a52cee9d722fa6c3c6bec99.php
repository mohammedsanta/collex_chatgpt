<?php $__env->startSection('title', 'القروض | Collex'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[70vh] space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm text-emerald-400">COLLEX / الإدارة</p>
            <h1 class="mt-1 text-2xl font-bold">القروض</h1>
            <p class="mt-1 text-sm text-slate-400">
                متابعة ملفات القروض والمديونيات والتحصيل.
            </p>
        </div>
    </div>

    
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">إجمالي القروض</p>
            <p class="mt-3 text-3xl font-bold num">
                <?php echo e(number_format($statistics['total'] ?? 0)); ?>

            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">القروض النشطة</p>
            <p class="mt-3 text-3xl font-bold text-emerald-400 num">
                <?php echo e(number_format($statistics['active'] ?? 0)); ?>

            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">إجمالي المتأخرات</p>
            <p class="mt-3 text-2xl font-bold text-rose-400 num">
                <?php echo e(number_format((float) ($statistics['overdue'] ?? 0), 2)); ?>

            </p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">إجمالي المحصل</p>
            <p class="mt-3 text-2xl font-bold text-emerald-400 num">
                <?php echo e(number_format((float) ($statistics['collected'] ?? 0), 2)); ?>

            </p>
        </div>

    </div>

    
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">

        <div class="mb-4">
            <h2 class="font-semibold">البحث والتصفية</h2>
            <p class="mt-1 text-sm text-slate-400">
                ابحث عن قرض أو حدد البنك والحالة وموظف التحصيل.
            </p>
        </div>

        <form method="GET" action="<?php echo e(route('loans.index')); ?>"
              class="grid gap-3 md:grid-cols-2 xl:grid-cols-5">

            <input
                type="search"
                name="search"
                value="<?php echo e($filters['search'] ?? ''); ?>"
                placeholder="رقم القرض أو اسم العميل..."
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-emerald-400 focus:outline-none"
            >

            <select
                name="bank_id"
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
            >
                <option value="">كل البنوك</option>

                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($bank->id); ?>"
                        <?php if((string) ($filters['bank_id'] ?? '') === (string) $bank->id): echo 'selected'; endif; ?>
                    >
                        <?php echo e($bank->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select
                name="status"
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
            >
                <option value="">كل الحالات</option>
                <option value="active" <?php if(($filters['status'] ?? '') === 'active'): echo 'selected'; endif; ?>>
                    نشط
                </option>
                <option value="paid" <?php if(($filters['status'] ?? '') === 'paid'): echo 'selected'; endif; ?>>
                    مسدد
                </option>
                <option value="overdue" <?php if(($filters['status'] ?? '') === 'overdue'): echo 'selected'; endif; ?>>
                    متأخر
                </option>
            </select>

            <select
                name="assignment"
                class="rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
            >
                <option value="">كل ملفات الإسناد</option>
                <option value="assigned" <?php if(($filters['assignment'] ?? '') === 'assigned'): echo 'selected'; endif; ?>>
                    مسند لموظف
                </option>
                <option value="unassigned" <?php if(($filters['assignment'] ?? '') === 'unassigned'): echo 'selected'; endif; ?>>
                    غير مسند
                </option>
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="flex-1 rounded-lg bg-emerald-400 px-4 py-3 font-bold text-slate-950 transition hover:bg-emerald-300"
                >
                    بحث
                </button>

                <a
                    href="<?php echo e(route('loans.index')); ?>"
                    class="rounded-lg border border-slate-700 px-4 py-3 text-center transition hover:bg-slate-800"
                >
                    إعادة
                </a>
            </div>

        </form>
    </section>

    
    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800 p-5">
            <div>
                <h2 class="font-semibold">سجلات القروض</h2>
                <p class="mt-1 text-sm text-slate-400">
                    عدد النتائج: <?php echo e(number_format($cases->total())); ?>

                </p>
            </div>

            <span class="rounded-lg border border-slate-700 px-3 py-2 text-xs text-slate-300">
                <?php echo e($cases->currentPage()); ?> / <?php echo e($cases->lastPage() ?: 1); ?>

            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-right text-sm">

                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">رقم القرض</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">العميل</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">البنك</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">إجمالي الدين</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">المتأخرات</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">المحصل</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">أيام التأخير</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">موظف التحصيل</th>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">الحالة</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $status = strtolower((string) $case->status);

                            $statusStyles = match ($status) {
                                'active' => 'bg-sky-400/10 text-sky-400',
                                'paid' => 'bg-emerald-400/10 text-emerald-400',
                                'overdue' => 'bg-rose-400/10 text-rose-400',
                                'closed' => 'bg-slate-700 text-slate-300',
                                default => 'bg-amber-400/10 text-amber-400',
                            };

                            $statusLabels = [
                                'active' => 'نشط',
                                'paid' => 'مسدد',
                                'overdue' => 'متأخر',
                                'closed' => 'مغلق',
                            ];
                        ?>

                        <tr class="border-t border-slate-800 transition hover:bg-slate-800/50">

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="font-semibold text-slate-100">
                                    <?php echo e($case->loan_number ?: '—'); ?>

                                </span>
                                <p class="mt-1 text-xs text-slate-500">
                                    #<?php echo e($case->id); ?>

                                </p>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="font-medium text-slate-200">
                                    <?php echo e($case->client?->name ?? '—'); ?>

                                </span>

                                <?php if($case->client?->national_id): ?>
                                    <p class="mt-1 text-xs text-slate-500 num">
                                        <?php echo e($case->client->national_id); ?>

                                    </p>
                                <?php endif; ?>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-300">
                                <?php echo e($case->bank?->name ?? '—'); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 num">
                                <?php echo e(number_format((float) $case->total_debt, 2)); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 num <?php echo e((float) $case->overdue_amount > 0 ? 'text-rose-400' : 'text-slate-300'); ?>">
                                <?php echo e(number_format((float) $case->overdue_amount, 2)); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-emerald-400 num">
                                <?php echo e(number_format((float) $case->collected_amount, 2)); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-300 num">
                                <?php echo e($case->dpd ?? 0); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-slate-300">
                                <?php echo e($case->assignedUser?->name ?? 'غير مسند'); ?>

                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="inline-flex rounded-lg px-3 py-1.5 text-xs font-semibold <?php echo e($statusStyles); ?>">
                                    <?php echo e($statusLabels[$status] ?? str_replace('_', ' ', $status ?: 'غير محدد')); ?>

                                </span>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center">
                                <p class="font-medium text-slate-200">
                                    لا توجد قروض مطابقة.
                                </p>
                                <p class="mt-2 text-xs text-slate-400">
                                    جرّب تغيير كلمات البحث أو الفلاتر.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        
        <?php if($cases->hasPages()): ?>
            <div class="border-t border-slate-800 p-4">
                <?php echo e($cases->links()); ?>

            </div>
        <?php endif; ?>

    </section>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loans/index.blade.php ENDPATH**/ ?>