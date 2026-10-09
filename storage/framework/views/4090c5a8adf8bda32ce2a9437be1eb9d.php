<?php $__env->startSection('title', 'البنوك | Collex'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-emerald-400">COLLEX / الإدارة</p>
            <h1 class="mt-2 text-3xl font-bold">البنوك</h1>
            <p class="mt-2 text-sm text-slate-400">
                إدارة الجهات البنكية ومحافظ التحصيل وبياناتها.
            </p>
        </div>

        <a href="<?php echo e(route('banks.create')); ?>"
           class="rounded-xl bg-emerald-400 px-5 py-3 font-bold text-slate-950 hover:bg-emerald-300">
            + إضافة بنك
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="rounded-xl border border-emerald-700 bg-emerald-950 p-4 text-emerald-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="rounded-xl border border-rose-700 bg-rose-950 p-4 text-rose-300">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <?php $__currentLoopData = [
            ['label' => 'إجمالي البنوك', 'value' => $stats['total'] ?? 0],
            ['label' => 'البنوك النشطة', 'value' => $stats['active'] ?? 0],
            ['label' => 'البنوك غير النشطة', 'value' => $stats['inactive'] ?? 0],
            ['label' => 'المحافظ', 'value' => $stats['portfolios'] ?? 0],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <p class="text-sm text-slate-400"><?php echo e($stat['label']); ?></p>
                <p class="mt-3 text-3xl font-bold tabular-nums">
                    <?php echo e(number_format($stat['value'])); ?>

                </p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <form method="GET" action="<?php echo e(route('banks.index')); ?>"
              class="grid gap-3 md:grid-cols-[1fr_200px_auto_auto]">

            <input
                type="search"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="ابحث باسم البنك أو الكود أو القطاع..."
                class="rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-emerald-400 focus:outline-none"
            >

            <select name="status"
                    class="rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none">
                <option value="">كل الحالات</option>
                <option value="active" <?php if(request('status') === 'active'): echo 'selected'; endif; ?>>نشط</option>
                <option value="inactive" <?php if(request('status') === 'inactive'): echo 'selected'; endif; ?>>غير نشط</option>
            </select>

            <button class="rounded-xl bg-slate-700 px-5 py-3 font-semibold hover:bg-slate-600">
                بحث
            </button>

            <a href="<?php echo e(route('banks.index')); ?>"
               class="rounded-xl border border-slate-700 px-5 py-3 text-center text-slate-300 hover:bg-slate-800">
                إعادة ضبط
            </a>
        </form>

        <div class="mt-5 overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="px-4 py-4">البنك</th>
                        <th class="px-4 py-4">الكود</th>
                        <th class="px-4 py-4">القطاع</th>
                        <th class="px-4 py-4">العملاء المرتبطون</th>
                        <th class="px-4 py-4">المحافظ</th>
                        <th class="px-4 py-4">الحالة</th>
                        <th class="px-4 py-4">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800">
                    <?php $__empty_1 = true; $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-4 py-4">
                                <a href="<?php echo e(route('banks.show', $bank)); ?>"
                                   class="font-bold text-white hover:text-emerald-300">
                                    <?php echo e($bank->name); ?>

                                </a>
                                <p class="mt-1 text-xs text-slate-500">
                                    رقم #<?php echo e($bank->id); ?>

                                </p>
                            </td>

                            <td class="px-4 py-4 font-mono text-slate-300">
                                <?php echo e($bank->code); ?>

                            </td>

                            <td class="px-4 py-4 text-slate-300">
                                <?php echo e($bank->sector ?: '—'); ?>

                            </td>

                            <td class="px-4 py-4 tabular-nums">
                                <?php echo e(number_format($bank->users_count ?? 0)); ?>

                            </td>

                            <td class="px-4 py-4 tabular-nums">
                                <?php echo e(number_format($bank->portfolios_count ?? 0)); ?>

                            </td>

                            <td class="px-4 py-4">
                                <?php if($bank->is_active): ?>
                                    <span class="rounded-full bg-emerald-950 px-3 py-1 text-xs font-semibold text-emerald-300">
                                        نشط
                                    </span>
                                <?php else: ?>
                                    <span class="rounded-full bg-slate-800 px-3 py-1 text-xs font-semibold text-slate-400">
                                        غير نشط
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="<?php echo e(route('banks.panel', $bank)); ?>"
                                       class="rounded-lg bg-slate-800 px-3 py-2 hover:bg-slate-700">
                                        فتح
                                    </a>

                                    <a href="<?php echo e(route('banks.edit', $bank)); ?>"
                                       class="rounded-lg border border-slate-700 px-3 py-2 hover:border-emerald-400">
                                        تعديل
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-14 text-center">
                                <p class="font-semibold text-slate-300">لا توجد بنوك</p>
                                <p class="mt-2 text-sm text-slate-500">
                                    أضف بنكًا جديدًا أو غيّر خيارات البحث.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <?php echo e($banks->links()); ?>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/index.blade.php ENDPATH**/ ?>