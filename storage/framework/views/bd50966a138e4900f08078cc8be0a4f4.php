
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-briefcase ml-2 text-cyan-400"></i>
            بيانات العمل
        </h2>
    </div>

    <div class="grid gap-5 p-5 sm:grid-cols-2 xl:grid-cols-3">
        <div>
            <p class="text-xs text-slate-500">جهة العمل</p>
            <p class="mt-2 font-semibold"><?php echo e($client->employer_name ?: '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">المسمى الوظيفي</p>
            <p class="mt-2"><?php echo e($client->job_title ?: '—'); ?></p>
        </div>

        <div>
            <p class="text-xs text-slate-500">عنوان العمل</p>
            <p class="mt-2 whitespace-pre-line leading-7"><?php echo e($client->work_address ?: '—'); ?></p>
        </div>
    </div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/partials/employment.blade.php ENDPATH**/ ?>