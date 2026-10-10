
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="flex items-center justify-between border-b border-[#1e252b] px-5 py-4">
        <div>
            <h2 class="font-bold">
                <i class="fa-solid fa-phone ml-2 text-emerald-400"></i>
                أرقام التواصل
            </h2>
            <p class="mt-1 text-xs text-slate-500">أرقام الهاتف المسجلة للعميل</p>
        </div>
        <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-400">
            <?php echo e($client->phones->count()); ?> رقم
        </span>
    </div>

    <div class="divide-y divide-[#1e252b]">
        <?php $__empty_1 = true; $__currentLoopData = $client->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-400">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>

                    <div>
                        <p class="font-mono font-semibold"><?php echo e($phone->phone); ?></p>
                        <p class="mt-1 text-xs text-slate-500">
                            <?php echo e($phone->label ?: 'رقم هاتف'); ?>

                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <?php if($phone->is_valid): ?>
                        <span class="rounded-full bg-emerald-400/10 px-3 py-1 text-xs text-emerald-300">
                            صالح
                        </span>
                    <?php else: ?>
                        <span class="rounded-full bg-rose-400/10 px-3 py-1 text-xs text-rose-300">
                            غير مؤكد
                        </span>
                    <?php endif; ?>

                    <a href="tel:<?php echo e($phone->phone); ?>"
                       class="rounded-lg border border-[#1e252b] px-3 py-2 text-xs text-emerald-400 hover:bg-white/5">
                        <i class="fa-solid fa-phone ml-1"></i>
                        اتصال
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="p-8 text-center text-sm text-slate-500">
                لا توجد أرقام هاتف مسجلة.
            </p>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/phones.blade.php ENDPATH**/ ?>