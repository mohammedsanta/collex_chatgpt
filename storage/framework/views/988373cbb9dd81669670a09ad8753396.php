
<div class="grid grid-cols-2 gap-3 xl:grid-cols-4">

    <?php $__currentLoopData = [
        [
            'label' => 'حالات المديونية',
            'value' => $collectionSummary['cases_count'],
            'icon' => 'fa-folder-open',
            'color' => 'text-cyan-400',
        ],
        [
            'label' => 'إجمالي المديونية',
            'value' => number_format($collectionSummary['total_debt'], 2) . ' ج.م',
            'icon' => 'fa-file-invoice-dollar',
            'color' => 'text-rose-400',
        ],
        [
            'label' => 'إجمالي المحصل',
            'value' => number_format($collectionSummary['total_collected'], 2) . ' ج.م',
            'icon' => 'fa-circle-check',
            'color' => 'text-emerald-400',
        ],
        [
            'label' => 'المتبقي',
            'value' => number_format($collectionSummary['remaining'], 2) . ' ج.م',
            'icon' => 'fa-wallet',
            'color' => 'text-amber-400',
        ],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="rounded-2xl border border-[#1e252b] bg-[#111418] p-4 md:p-5">
            <div class="flex items-center justify-between gap-2">
                <p class="text-xs text-slate-400 md:text-sm"><?php echo e($stat['label']); ?></p>
                <i class="fa-solid <?php echo e($stat['icon']); ?> <?php echo e($stat['color']); ?>"></i>
            </div>
            <p class="mt-3 break-words text-xl font-bold tabular-nums md:text-2xl">
                <?php echo e($stat['value']); ?>

            </p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<div class="grid grid-cols-2 gap-3 xl:grid-cols-4">
    <?php $__currentLoopData = [
        ['label' => 'المتأخرات', 'value' => $collectionSummary['total_overdue'], 'icon' => 'fa-clock', 'color' => 'text-rose-300'],
        ['label' => 'وعود السداد', 'value' => $collectionSummary['promises_count'], 'icon' => 'fa-calendar-check', 'color' => 'text-amber-300'],
        ['label' => 'المدفوعات', 'value' => $collectionSummary['payments_count'], 'icon' => 'fa-money-bill-transfer', 'color' => 'text-emerald-300'],
        ['label' => 'الزيارات', 'value' => $collectionSummary['visits_count'], 'icon' => 'fa-location-dot', 'color' => 'text-cyan-300'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="rounded-xl border border-[#1e252b] bg-[#111418] p-4">
            <p class="text-xs text-slate-500"><?php echo e($stat['label']); ?></p>
            <div class="mt-3 flex items-center justify-between gap-2">
                <span class="break-words text-lg font-bold tabular-nums">
                    <?php if($stat['label'] === 'المتأخرات'): ?>
                        <?php echo e(number_format((float) $stat['value'], 2)); ?> ج.م
                    <?php else: ?>
                        <?php echo e(number_format((int) $stat['value'])); ?>

                    <?php endif; ?>
                </span>
                <i class="fa-solid <?php echo e($stat['icon']); ?> <?php echo e($stat['color']); ?>"></i>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/summary.blade.php ENDPATH**/ ?>