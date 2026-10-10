
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-location-dot ml-2 text-cyan-400"></i>
            سجل الزيارات
        </h2>
    </div>

    <div class="divide-y divide-[#1e252b]">
        <?php $__empty_1 = true; $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="grid gap-4 p-5 sm:grid-cols-2 xl:grid-cols-4">
                <div>
                    <p class="text-xs text-slate-500">موعد الزيارة</p>
                    <p class="mt-2"><?php echo e($visit->scheduled_at?->format('Y-m-d H:i') ?? '—'); ?></p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">تاريخ التنفيذ</p>
                    <p class="mt-2"><?php echo e($visit->visited_at?->format('Y-m-d H:i') ?? 'لم تنفذ بعد'); ?></p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">الموظف المسؤول</p>
                    <p class="mt-2"><?php echo e($visit->user?->name ?? '—'); ?></p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">الحالة</p>
                    <p class="mt-2"><?php echo e($visit->status ?: '—'); ?></p>
                </div>

                <div class="sm:col-span-2 xl:col-span-4">
                    <p class="text-xs text-slate-500">العنوان</p>
                    <p class="mt-2"><?php echo e($visit->address ?: '—'); ?></p>
                </div>

                <div class="sm:col-span-2 xl:col-span-4">
                    <p class="text-xs text-slate-500">النتيجة والملاحظات</p>
                    <p class="mt-2 whitespace-pre-line leading-7 text-slate-300">
                        <?php echo e($visit->outcome ?: '—'); ?>

                        <?php if($visit->notes): ?>
                            <?php echo e("\n" . $visit->notes); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="p-8 text-center text-sm text-slate-500">
                لا توجد زيارات مسجلة.
            </p>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/visits.blade.php ENDPATH**/ ?>