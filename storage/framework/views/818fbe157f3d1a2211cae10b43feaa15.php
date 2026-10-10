
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="text-xs font-semibold tracking-widest text-emerald-400">
            COLLEX / إدارة العملاء / ملف العميل
        </p>

        <h1 class="mt-2 text-2xl font-bold md:text-3xl">
            <?php echo e($client->name); ?>

        </h1>

        <p class="mt-2 text-sm text-slate-400">
            كود العميل: <?php echo e($client->code ?: 'غير مسجل'); ?>

            <span class="mx-2 text-slate-700">|</span>
            الرقم القومي: <?php echo e($client->national_id ?: 'غير مسجل'); ?>

        </p>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="<?php echo e(route('clients.index')); ?>"
           class="rounded-xl border border-[#1e252b] px-4 py-3 text-sm text-slate-300 hover:bg-white/5">
            <i class="fa-solid fa-arrow-right ml-2"></i>
            قائمة العملاء
        </a>

        <?php if(\Illuminate\Support\Facades\Route::has('clients.edit')): ?>
            <a href="<?php echo e(route('clients.edit', $client)); ?>"
               class="rounded-xl bg-emerald-400 px-4 py-3 text-sm font-bold text-slate-950 hover:bg-emerald-300">
                <i class="fa-solid fa-pen ml-2"></i>
                تعديل العميل
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="rounded-xl border border-emerald-800 bg-emerald-950/40 p-4 text-sm text-emerald-300">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="rounded-xl border border-rose-800 bg-rose-950/40 p-4 text-sm text-rose-300">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/header.blade.php ENDPATH**/ ?>