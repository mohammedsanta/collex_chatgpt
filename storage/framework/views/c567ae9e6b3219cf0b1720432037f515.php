<?php $__env->startSection('title', 'تصدير التقارير'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6" dir="rtl">

    
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="eyebrow">التقارير / التصدير</div>
            <h1 class="page-title mt-2">تصدير التقارير</h1>
            <p class="page-subtitle">
                إنشاء ملفات التقارير ومتابعة تجهيزها وتنزيل الملفات الجاهزة.
            </p>
        </div>

        <a
            href="<?php echo e(route('reports.index')); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-line bg-white/[0.02] px-4 py-3 text-xs font-bold text-muted transition hover:text-fg"
        >
            <i class="fa-solid fa-chart-column"></i>
            التقارير
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <i class="fa-solid fa-circle-check ml-2"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-xs font-bold text-red-400">
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="app-stat">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="app-stat-label"><?php echo e($stat['label']); ?></p>
                        <p class="app-stat-value mt-2">
                            <?php echo e(number_format($stat['value'])); ?>

                        </p>
                    </div>

                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-brand/10 text-brand">
                        <i class="fa-solid <?php echo e($stat['icon']); ?> text-lg"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">إنشاء تصدير جديد</h2>
                <p class="mt-1 text-[11px] text-muted">
                    اختر التقرير والصيغة والفترة المطلوبة.
                </p>
            </div>

            <i class="fa-solid fa-file-export text-brand"></i>
        </div>

        <div class="app-card-body">
            <form method="POST" action="<?php echo e(route('reports.exports.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    <div>
                        <label for="type" class="mb-2 block text-xs font-bold text-muted">
                            نوع التقرير
                        </label>

                        <select
                            id="type"
                            name="type"
                            required
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">اختر التقرير</option>

                            <?php $__currentLoopData = $reportTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($value); ?>"
                                    <?php if(old('type', $filters['type'] ?? '') === $value): echo 'selected'; endif; ?>
                                >
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-[11px] text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="format" class="mb-2 block text-xs font-bold text-muted">
                            صيغة الملف
                        </label>

                        <select
                            id="format"
                            name="format"
                            required
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">اختر الصيغة</option>

                            <?php $__currentLoopData = $formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($value); ?>"
                                    <?php if(old('format') === $value): echo 'selected'; endif; ?>
                                >
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <?php $__errorArgs = ['format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-[11px] text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="date_from" class="mb-2 block text-xs font-bold text-muted">
                            من تاريخ
                        </label>

                        <input
                            id="date_from"
                            type="date"
                            name="filters[date_from]"
                            value="<?php echo e(old('filters.date_from')); ?>"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >

                        <?php $__errorArgs = ['filters.date_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-[11px] text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="date_to" class="mb-2 block text-xs font-bold text-muted">
                            إلى تاريخ
                        </label>

                        <input
                            id="date_to"
                            type="date"
                            name="filters[date_to]"
                            value="<?php echo e(old('filters.date_to')); ?>"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >

                        <?php $__errorArgs = ['filters.date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-[11px] text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mt-5 flex flex-col gap-3 border-t border-line pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-[11px] leading-5 text-muted">
                        قد تستغرق الملفات الكبيرة بعض الوقت. ستتمكن من تنزيل الملف بعد اكتمال التجهيز.
                    </p>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-5 py-3 text-xs font-extrabold text-black transition hover:opacity-90"
                    >
                        <i class="fa-solid fa-gears"></i>
                        إنشاء طلب التصدير
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">البحث والتصفية</h2>
                <p class="mt-1 text-[11px] text-muted">
                    تصفية طلبات التصدير حسب النوع والحالة.
                </p>
            </div>

            <i class="fa-solid fa-sliders text-muted"></i>
        </div>

        <div class="app-card-body">
            <form method="GET" action="<?php echo e(route('reports.exports')); ?>">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    <div>
                        <label for="search" class="mb-2 block text-xs font-bold text-muted">
                            البحث
                        </label>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="<?php echo e($filters['search'] ?? ''); ?>"
                            placeholder="رقم طلب التصدير"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none placeholder:text-dim focus:border-brand/50"
                        >
                    </div>

                    <div>
                        <label for="filter_type" class="mb-2 block text-xs font-bold text-muted">
                            نوع التقرير
                        </label>

                        <select
                            id="filter_type"
                            name="type"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">كل التقارير</option>

                            <?php $__currentLoopData = $reportTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($value); ?>"
                                    <?php if(($filters['type'] ?? '') === $value): echo 'selected'; endif; ?>
                                >
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-xs font-bold text-muted">
                            الحالة
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border border-line bg-base px-3 py-3 text-xs text-fg outline-none focus:border-brand/50"
                        >
                            <option value="">كل الحالات</option>

                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($value); ?>"
                                    <?php if(($filters['status'] ?? '') === $value): echo 'selected'; endif; ?>
                                >
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button
                            type="submit"
                            class="inline-flex min-h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-brand px-4 py-3 text-xs font-extrabold text-black transition hover:opacity-90"
                        >
                            <i class="fa-solid fa-filter"></i>
                            تطبيق
                        </button>

                        <a
                            href="<?php echo e(route('reports.exports')); ?>"
                            class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-line px-4 py-3 text-xs font-bold text-muted transition hover:text-fg"
                            title="إعادة ضبط الفلاتر"
                        >
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">طلبات التصدير</h2>
                <p class="mt-1 text-[11px] text-muted">
                    متابعة حالة إنشاء الملفات والرجوع إلى الطلبات السابقة.
                </p>
            </div>

            <span class="rounded-lg border border-line bg-white/[0.02] px-3 py-2 text-[11px] font-bold text-muted">
                <?php echo e(number_format($exports->total())); ?> طلب
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-right">
                <thead>
                    <tr class="border-b border-line bg-white/[0.015]">
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">رقم الطلب</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">التقرير</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">الصيغة</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">تاريخ الطلب</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">الحالة</th>
                        <th class="px-5 py-4 text-[11px] font-extrabold text-muted">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-line">
                    <?php $__empty_1 = true; $__currentLoopData = $exports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $export): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $status = strtolower((string) $export->status);

                            $statusStyles = [
                                'pending' => 'border-yellow-500/20 bg-yellow-500/10 text-yellow-400',
                                'processing' => 'border-sky-500/20 bg-sky-500/10 text-sky-400',
                                'completed' => 'border-brand/20 bg-brand/10 text-brand',
                                'failed' => 'border-red-500/20 bg-red-500/10 text-red-400',
                                'expired' => 'border-white/10 bg-white/[0.04] text-muted',
                            ];

                            $statusLabels = [
                                'pending' => 'قيد الانتظار',
                                'processing' => 'جارٍ التجهيز',
                                'completed' => 'مكتمل',
                                'failed' => 'فشل',
                                'expired' => 'منتهي',
                            ];

                            $typeLabels = [
                                'collection' => 'تقرير التحصيل',
                                'performance' => 'تقرير الأداء',
                                'payment' => 'تقرير المدفوعات',
                                'portfolio' => 'تقرير النطاق',
                                'dcr' => 'تقرير التحصيل اليومي',
                            ];

                            $formatLabels = [
                                'xlsx' => 'Excel',
                                'csv' => 'CSV',
                                'pdf' => 'PDF',
                            ];
                        ?>

                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-4">
                                <span class="font-extrabold text-fg">
                                    #<?php echo e($export->getKey()); ?>

                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-xs font-bold text-fg">
                                    <?php echo e($typeLabels[$export->type] ?? $export->type); ?>

                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-2 rounded-lg border border-line bg-white/[0.02] px-3 py-2 text-[10px] font-bold text-muted">
                                    <i class="fa-solid fa-file-lines text-brand"></i>
                                    <?php echo e($formatLabels[$export->format] ?? strtoupper((string) $export->format)); ?>

                                </span>
                            </td>

                            <td class="px-5 py-4 text-xs text-muted">
                                <?php echo e($export->created_at?->format('Y-m-d h:i A') ?? '—'); ?>

                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-2 rounded-lg border px-3 py-2 text-[10px] font-extrabold <?php echo e($statusStyles[$status] ?? 'border-line bg-white/[0.02] text-muted'); ?>">
                                    <?php if($status === 'processing'): ?>
                                        <i class="fa-solid fa-spinner"></i>
                                    <?php elseif($status === 'completed'): ?>
                                        <i class="fa-solid fa-circle-check"></i>
                                    <?php elseif($status === 'failed'): ?>
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-clock"></i>
                                    <?php endif; ?>

                                    <?php echo e($statusLabels[$status] ?? $export->status); ?>

                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">

                                    <?php if($status === 'completed'): ?>
                                        <a
                                            href="<?php echo e(route('reports.exports.download', ['export' => $export->getKey()])); ?>"
                                            class="inline-flex items-center gap-2 rounded-lg border border-brand/30 bg-brand/10 px-3 py-2 text-[10px] font-extrabold text-brand transition hover:bg-brand/15"
                                        >
                                            <i class="fa-solid fa-download"></i>
                                            تنزيل
                                        </a>
                                    <?php endif; ?>

                                    <?php if(in_array($status, ['pending', 'failed', 'expired'], true)): ?>
                                        <form
                                            method="POST"
                                            action="<?php echo e(route('reports.exports.retry', ['export' => $export->getKey()])); ?>"
                                        >
                                            <?php echo csrf_field(); ?>

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-2 rounded-lg border border-line px-3 py-2 text-[10px] font-bold text-muted transition hover:text-fg"
                                            >
                                                <i class="fa-solid fa-rotate-right"></i>
                                                إعادة المحاولة
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($status !== 'processing'): ?>
                                        <form
                                            method="POST"
                                            action="<?php echo e(route('reports.exports.destroy', ['export' => $export->getKey()])); ?>"
                                            onsubmit="return confirm('هل أنت متأكد من حذف طلب التصدير؟');"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg border border-red-500/20 px-3 py-2 text-[10px] font-bold text-red-400 transition hover:bg-red-500/10"
                                                title="حذف الطلب"
                                                aria-label="حذف طلب التصدير"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl border border-line bg-white/[0.02] text-muted">
                                    <i class="fa-solid fa-file-circle-xmark text-xl"></i>
                                </div>

                                <h3 class="mt-4 text-sm font-extrabold text-fg">
                                    لا توجد طلبات تصدير
                                </h3>

                                <p class="mx-auto mt-2 max-w-md text-xs leading-6 text-muted">
                                    لا توجد طلبات مطابقة للفلاتر الحالية. يمكنك إنشاء طلب جديد من النموذج أعلاه.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($exports->hasPages()): ?>
            <div class="flex flex-col gap-3 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-[11px] text-muted">
                    عرض
                    <span class="font-bold text-fg"><?php echo e(number_format($exports->firstItem() ?? 0)); ?></span>
                    إلى
                    <span class="font-bold text-fg"><?php echo e(number_format($exports->lastItem() ?? 0)); ?></span>
                    من
                    <span class="font-bold text-fg"><?php echo e(number_format($exports->total())); ?></span>
                    طلب
                </p>

                <div class="text-xs">
                    <?php echo e($exports->withQueryString()->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/reports/exports.blade.php ENDPATH**/ ?>