
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-id-card ml-2 text-emerald-400"></i>
            البيانات الشخصية
        </h2>
    </div>

    <div class="grid gap-5 p-5 sm:grid-cols-2 xl:grid-cols-3">
        <div>
            <p class="text-xs text-slate-500">اسم العميل</p>
            <p class="mt-2 font-semibold"><?php echo e($client->name ?: '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">كود العميل</p>
            <p class="mt-2 font-mono"><?php echo e($client->code ?: '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">الرقم القومي</p>
            <p class="mt-2 font-mono"><?php echo e($client->national_id ?: '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">البريد الإلكتروني</p>
            <?php if($client->email): ?>
                <a href="mailto:<?php echo e($client->email); ?>" class="mt-2 inline-block break-all text-emerald-400 hover:underline">
                    <?php echo e($client->email); ?>

                </a>
            <?php else: ?>
                <p class="mt-2">—</p>
            <?php endif; ?>
        </div>

        <div>
            <p class="text-xs text-slate-500">المحافظة</p>
            <p class="mt-2"><?php echo e($client->governorate?->name ?? '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">العنوان</p>
            <p class="mt-2 whitespace-pre-line leading-7"><?php echo e($client->address ?: '—'); ?></p>
        </div>
    </div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/personal-info.blade.php ENDPATH**/ ?>