
<?php
    $bankNavigation = [
        ['route' => 'banks.show', 'label' => 'نظرة عامة', 'icon' => '⌂'],
        ['route' => 'banks.panel', 'label' => 'لوحة البنك', 'icon' => '▦'],
        ['route' => 'banks.clients.index', 'label' => 'العملاء', 'icon' => '♙'],
        ['route' => 'banks.distribution.index', 'label' => 'توزيع المحافظ', 'icon' => '⇄'],
        ['route' => 'banks.scope.import', 'label' => 'استيراد النطاق', 'icon' => '↑'],
        ['route' => 'banks.scope.edit', 'label' => 'نطاق البنك', 'icon' => '▤'],
        ['route' => 'banks.archives.index', 'label' => 'الأرشيف', 'icon' => '▣'],
        ['route' => 'banks.ptp.index', 'label' => 'وعود السداد', 'icon' => '✓'],
        ['route' => 'banks.visits.index', 'label' => 'الزيارات', 'icon' => '⌖'],
        ['route' => 'banks.complaints.index', 'label' => 'الشكاوى', 'icon' => '!'],
        ['route' => 'banks.dcr.index', 'label' => 'تقارير DCR', 'icon' => '▥'],
    ];
?>

<nav class="mb-6 rounded-2xl border border-slate-800 bg-slate-900 p-3">
    <div class="flex flex-wrap gap-2">
        <?php $__currentLoopData = $bankNavigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a
                href="<?php echo e(route($item['route'], ['bank' => $bank->id])); ?>"
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition',
                    'bg-emerald-400 text-slate-950' =>
                        request()->routeIs($item['route']),
                    'text-slate-300 hover:bg-slate-800 hover:text-white' =>
                        ! request()->routeIs($item['route']),
                ]); ?>"
            >
                <span><?php echo e($item['icon']); ?></span>
                <?php echo e($item['label']); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</nav><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/_nav.blade.php ENDPATH**/ ?>