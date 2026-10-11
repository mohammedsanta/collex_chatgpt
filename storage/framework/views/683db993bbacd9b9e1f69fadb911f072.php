<?php $__env->startSection('title', 'تفاصيل الأرشيف'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $attributes = $archive->getAttributes();

    $fieldLabels = [
        'id' => 'رقم الأرشيف',
        'bank_id' => 'رقم البنك',
        'portfolio_id' => 'رقم النطاق',
        'year' => 'السنة',
        'month' => 'الشهر',
        'status' => 'الحالة',
        'notes' => 'ملاحظات',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'آخر تحديث',
        'archived_at' => 'تاريخ الأرشفة',
        'archived_by' => 'رقم المستخدم الذي أرشف',
        'archived_by_id' => 'رقم المستخدم الذي أرشف',
    ];

    $monthNames = [
        1 => 'يناير',
        2 => 'فبراير',
        3 => 'مارس',
        4 => 'أبريل',
        5 => 'مايو',
        6 => 'يونيو',
        7 => 'يوليو',
        8 => 'أغسطس',
        9 => 'سبتمبر',
        10 => 'أكتوبر',
        11 => 'نوفمبر',
        12 => 'ديسمبر',
    ];

    $month = (int) ($attributes['month'] ?? 0);
    $year = $attributes['year'] ?? null;

    $period = ($monthNames[$month] ?? null)
        ? $monthNames[$month] . ($year ? ' ' . $year : '')
        : ($year ? (string) $year : 'أرشيف شهري');

    $dateFields = ['created_at', 'updated_at', 'archived_at'];
?>

<div class="space-y-6" dir="rtl">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="eyebrow">إدارة البيانات</div>

            <h1 class="page-title mt-2">تفاصيل الأرشيف</h1>

            <p class="page-subtitle mt-1">
                عرض بيانات سجل الأرشيف رقم #<?php echo e($archive->getKey()); ?>

            </p>
        </div>

        <a href="<?php echo e(route('archives.index')); ?>" class="app-btn app-btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            العودة إلى الأرشيف
        </a>
    </div>

    
    <div class="app-card">
        <div class="app-card-header flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="font-bold text-fg"><?php echo e($period); ?></h2>
                <p class="mt-1 text-sm text-muted">
                    بيانات الأرشيف المحفوظة في النظام
                </p>
            </div>

            <span class="app-badge-green">
                <i class="fa-solid fa-box-archive ml-1"></i>
                سجل محفوظ
            </span>
        </div>

        <div class="app-card-body">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">

                <div class="app-stat">
                    <div class="text-sm text-muted">رقم الأرشيف</div>
                    <div class="mt-2 text-2xl font-extrabold text-fg">
                        #<?php echo e($archive->getKey()); ?>

                    </div>
                </div>

                <div class="app-stat">
                    <div class="text-sm text-muted">الفترة المؤرشفة</div>
                    <div class="mt-2 text-xl font-bold text-fg">
                        <?php echo e($period); ?>

                    </div>
                </div>

                <div class="app-stat">
                    <div class="text-sm text-muted">تاريخ الإنشاء</div>
                    <div class="mt-2 font-bold text-fg">
                        <?php if($archive->created_at): ?>
                            <?php echo e($archive->created_at->format('Y-m-d H:i')); ?>

                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <div class="app-card">
        <div class="app-card-header">
            <h2 class="font-bold text-fg">البيانات المسجلة</h2>
            <p class="mt-1 text-sm text-muted">
                الحقول المسجلة لهذا الأرشيف في قاعدة البيانات
            </p>
        </div>

        <div class="app-card-body">
            <dl class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($key, ['id', 'created_at', 'updated_at'], true)) continue; ?>
                    <?php if(str_ends_with($key, '_snapshot') && $value === null) continue; ?>

                    <div class="rounded-xl border border-line p-4">
                        <dt class="text-sm text-muted">
                            <?php echo e($fieldLabels[$key] ?? str_replace('_', ' ', ucfirst($key))); ?>

                        </dt>

                        <dd class="mt-2 break-words font-semibold text-fg">
                            <?php if(in_array($key, $dateFields, true) && $value): ?>
                                <?php echo e(\Illuminate\Support\Carbon::parse($value)->format('Y-m-d H:i')); ?>

                            <?php elseif($key === 'month' && $value): ?>
                                <?php echo e($monthNames[(int) $value] ?? $value); ?>

                            <?php elseif(is_array($value) || is_object($value)): ?>
                                <?php echo e(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); ?>

                            <?php elseif(is_bool($value)): ?>
                                <?php echo e($value ? 'نعم' : 'لا'); ?>

                            <?php elseif($value === null || $value === ''): ?>
                                —
                            <?php else: ?>
                                <?php echo e($value); ?>

                            <?php endif; ?>
                        </dd>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </dl>
        </div>
    </div>

    
    <div class="app-card">
        <div class="app-card-body flex items-start gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">
                <i class="fa-solid fa-lock"></i>
            </div>

            <div>
                <h3 class="font-bold text-fg">الأرشيف للعرض فقط</h3>
                <p class="mt-1 text-sm leading-6 text-muted">
                    هذه الصفحة مخصصة لمراجعة البيانات المؤرشفة.
                    لا يتم تعديل أو حذف السجل من هذه الصفحة.
                </p>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/archives/show.blade.php ENDPATH**/ ?>