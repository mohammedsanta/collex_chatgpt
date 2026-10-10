
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#1e252b] px-5 py-4">
        <div>
            <h2 class="font-bold">
                <i class="fa-solid fa-file-invoice-dollar ml-2 text-amber-400"></i>
                حالات المديونية
            </h2>
            <p class="mt-1 text-xs text-slate-500">الحالات المرتبطة بالعميل</p>
        </div>
        <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-400">
            <?php echo e($debtCases->count()); ?> حالة
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] text-right text-sm">
            <thead class="bg-[#0a0c0e] text-slate-400">
                <tr>
                    <th class="px-5 py-4">رقم الحالة</th>
                    <th class="px-5 py-4">رقم القرض</th>
                    <th class="px-5 py-4">البنك</th>
                    <th class="px-5 py-4">المحفظة</th>
                    <th class="px-5 py-4">أصل الدين</th>
                    <th class="px-5 py-4">المتأخرات</th>
                    <th class="px-5 py-4">المحصل</th>
                    <th class="px-5 py-4">المتبقي التقريبي</th>
                    <th class="px-5 py-4">الموظف</th>
                    <th class="px-5 py-4">الحالة</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#1e252b]">
                <?php $__empty_1 = true; $__currentLoopData = $debtCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition hover:bg-white/[0.02]">
                        <td class="px-5 py-4 font-mono">#<?php echo e($case->id); ?></td>
                        <td class="px-5 py-4 font-mono">
                            <?php echo e($case->loan_number ?: '—'); ?>

                        </td>
                        <td class="px-5 py-4">
                            <?php echo e($case->bank?->name ?? '—'); ?>

                        </td>
                        <td class="px-5 py-4">
                            <?php echo e($case->portfolio?->name ?? '—'); ?>

                        </td>
                        <td class="px-5 py-4 tabular-nums">
                            <?php echo e(number_format((float) $case->total_debt, 2)); ?>

                        </td>
                        <td class="px-5 py-4 tabular-nums text-rose-300">
                            <?php echo e(number_format((float) $case->overdue_amount, 2)); ?>

                        </td>
                        <td class="px-5 py-4 tabular-nums text-emerald-300">
                            <?php echo e(number_format((float) $case->collected_amount, 2)); ?>

                        </td>
                        <td class="px-5 py-4 tabular-nums">
                            <?php echo e(number_format(max(0, (float) $case->total_debt - (float) $case->collected_amount), 2)); ?>

                        </td>
                        <td class="px-5 py-4">
                            <?php echo e($case->assignedUser?->name ?? 'غير معين'); ?>

                        </td>
                        <td class="px-5 py-4">
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-300">
                                <?php echo e($case->status); ?>

                            </span>

                            <?php if((int) $case->dpd > 0): ?>
                                <p class="mt-2 text-xs text-rose-300">
                                    تأخير <?php echo e($case->dpd); ?> يوم
                                </p>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr class="bg-[#0a0c0e]/60">
                        <td colspan="10" class="px-5 py-3 text-xs text-slate-500">
                            نوع القرض: <?php echo e($case->loanType?->name ?? '—'); ?>

                            <span class="mx-2">|</span>
                            القسط: <?php echo e($case->installment_value !== null ? number_format((float) $case->installment_value, 2) . ' ج.م' : '—'); ?>

                            <span class="mx-2">|</span>
                            موعد القسط القادم: <?php echo e($case->next_due_date?->format('Y-m-d') ?? '—'); ?>

                            <span class="mx-2">|</span>
                            آخر دفعة: <?php echo e($case->last_payment_date?->format('Y-m-d') ?? '—'); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10" class="px-5 py-12 text-center text-slate-500">
                            لا توجد حالات مديونية مرتبطة بهذا العميل.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/debt-cases.blade.php ENDPATH**/ ?>