<?php $__env->startSection('content'); ?>
<div dir="rtl" class="min-h-screen space-y-6 bg-[#0b0f0d] p-4 text-gray-100 md:p-8">

    
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <a href="<?php echo e(route('banks.show', $bank)); ?>"
                   class="transition hover:text-[#00ff66]">
                    البنوك
                </a>
                <span>/</span>
                <span class="text-gray-300"><?php echo e($bank->name); ?></span>
                <span>/</span>
                <span class="text-[#00ff66]">الشكاوى</span>
            </div>

            <h1 class="text-2xl font-bold md:text-3xl">
                شكاوى البنك
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                متابعة وإدارة شكاوى العملاء الخاصة بـ <?php echo e($bank->name); ?>

            </p>
        </div>

        <a href="<?php echo e(route('banks.complaints.create', $bank)); ?>"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#00ff66] px-5 py-3 font-bold text-black transition hover:bg-[#00dc59]">
            <span>＋</span>
            إضافة شكوى
        </a>
    </div>

    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-white/10 bg-[#121916] p-5">
            <p class="text-sm text-gray-400">إجمالي الشكاوى</p>
            <p class="mt-3 text-3xl font-bold text-[#00ff66]">
                <?php echo e(number_format($complaints->total())); ?>

            </p>
            <p class="mt-2 text-xs text-gray-500">
                إجمالي النتائج المطابقة للبحث
            </p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-[#121916] p-5">
            <p class="text-sm text-gray-400">عدد النتائج في الصفحة</p>
            <p class="mt-3 text-3xl font-bold">
                <?php echo e($complaints->count()); ?>

            </p>
            <p class="mt-2 text-xs text-gray-500">
                من أصل <?php echo e(number_format($complaints->total())); ?> شكوى
            </p>
        </div>
    </div>

    
    <div class="rounded-2xl border border-white/10 bg-[#121916] p-4 md:p-5">
        <form method="GET"
              action="<?php echo e(route('banks.complaints.index', $bank)); ?>"
              class="flex flex-col gap-3 md:flex-row">

            <div class="relative flex-1">
                <input
                    type="search"
                    name="search"
                    value="<?php echo e($search ?? request('search')); ?>"
                    placeholder="ابحث برقم الشكوى أو اسم العميل أو عنوان الشكوى..."
                    class="w-full rounded-xl border border-white/10 bg-[#0b0f0d] px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-[#00ff66]"
                >
            </div>

            <select
                name="per_page"
                class="rounded-xl border border-white/10 bg-[#0b0f0d] px-4 py-3 text-sm text-white outline-none focus:border-[#00ff66]"
            >
                <option value="15" <?php if(($perPage ?? 15) === 15): echo 'selected'; endif; ?>>15 نتيجة</option>
                <option value="25" <?php if(($perPage ?? 15) === 25): echo 'selected'; endif; ?>>25 نتيجة</option>
                <option value="50" <?php if(($perPage ?? 15) === 50): echo 'selected'; endif; ?>>50 نتيجة</option>
            </select>

            <button
                type="submit"
                class="rounded-xl bg-white/10 px-6 py-3 text-sm font-semibold transition hover:bg-white/15"
            >
                بحث
            </button>

            <?php if(filled($search ?? request('search'))): ?>
                <a href="<?php echo e(route('banks.complaints.index', $bank)); ?>"
                   class="rounded-xl border border-white/10 px-5 py-3 text-center text-sm text-gray-300 transition hover:bg-white/5">
                    مسح
                </a>
            <?php endif; ?>
        </form>
    </div>

    
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#121916]">
        <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
            <h2 class="font-bold">سجل الشكاوى</h2>
            <span class="text-xs text-gray-400">
                <?php echo e($complaints->firstItem() ?? 0); ?>–<?php echo e($complaints->lastItem() ?? 0); ?>

                من <?php echo e(number_format($complaints->total())); ?>

            </span>
        </div>

        <?php if($complaints->isEmpty()): ?>
            <div class="px-5 py-16 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-2xl">
                    !
                </div>

                <h3 class="font-bold">لا توجد شكاوى</h3>

                <p class="mt-2 text-sm text-gray-400">
                    <?php if(filled($search ?? request('search'))): ?>
                        لم يتم العثور على نتائج تطابق البحث.
                    <?php else: ?>
                        لا توجد شكاوى مسجلة لهذا البنك حتى الآن.
                    <?php endif; ?>
                </p>

                <a href="<?php echo e(route('banks.complaints.create', $bank)); ?>"
                   class="mt-5 inline-flex rounded-xl bg-[#00ff66] px-5 py-3 text-sm font-bold text-black hover:bg-[#00dc59]">
                    تسجيل شكوى جديدة
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-right text-sm">
                    <thead class="bg-white/[0.03] text-xs text-gray-400">
                        <tr>
                            <th class="px-5 py-4 font-medium">رقم الشكوى</th>
                            <th class="px-5 py-4 font-medium">عنوان الشكوى</th>
                            <th class="px-5 py-4 font-medium">العميل</th>
                            <th class="px-5 py-4 font-medium">رقم القرض</th>
                            <th class="px-5 py-4 font-medium">المسؤول</th>
                            <th class="px-5 py-4 font-medium">الحالة</th>
                            <th class="px-5 py-4 font-medium">تاريخ التسجيل</th>
                            <th class="px-5 py-4 font-medium">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/[0.06]">
                        <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $status = strtolower((string) ($complaint->status ?? 'open'));

                                $statusStyles = [
                                    'open' => 'bg-blue-500/10 text-blue-400',
                                    'pending' => 'bg-amber-500/10 text-amber-400',
                                    'in_progress' => 'bg-purple-500/10 text-purple-400',
                                    'resolved' => 'bg-emerald-500/10 text-emerald-400',
                                    'closed' => 'bg-gray-500/10 text-gray-400',
                                    'rejected' => 'bg-red-500/10 text-red-400',
                                ];

                                $statusLabels = [
                                    'open' => 'مفتوحة',
                                    'pending' => 'قيد الانتظار',
                                    'in_progress' => 'قيد المعالجة',
                                    'resolved' => 'تم الحل',
                                    'closed' => 'مغلقة',
                                    'rejected' => 'مرفوضة',
                                ];

                                if ($complaint->status instanceof \BackedEnum) {
                                    $status = strtolower((string) $complaint->status->value);
                                }
                            ?>

                            <tr class="transition hover:bg-white/[0.025]">
                                <td class="px-5 py-4 font-semibold text-[#00ff66]">
                                    #<?php echo e($complaint->id); ?>

                                </td>

                                <td class="max-w-[240px] px-5 py-4">
                                    <div class="truncate font-medium text-gray-100">
                                        <?php echo e($complaint->subject ?? $complaint->title ?? 'شكوى بدون عنوان'); ?>

                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">
                                        <?php echo e($complaint->category ?? 'شكوى عامة'); ?>

                                    </div>
                                </td>

                                <td class="px-5 py-4 text-gray-300">
                                    <?php echo e($complaint->client?->name ?? 'غير محدد'); ?>

                                </td>

                                <td class="px-5 py-4 text-gray-400">
                                    <?php echo e($complaint->debtCase?->loan_number ?? '—'); ?>

                                </td>

                                <td class="px-5 py-4 text-gray-300">
                                    <?php echo e($complaint->assignedTo?->name ?? 'غير معيّن'); ?>

                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusStyles[$status] ?? 'bg-white/5 text-gray-300'); ?>">
                                        <?php echo e($statusLabels[$status] ?? $status); ?>

                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-gray-400">
                                    <?php echo e($complaint->created_at?->format('Y-m-d') ?? '—'); ?>

                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="<?php echo e(route('banks.complaints.show', [$bank, $complaint])); ?>"
                                            class="rounded-lg border border-white/10 px-3 py-2 text-xs transition hover:border-[#00ff66]/40 hover:text-[#00ff66]"
                                        >
                                            التفاصيل
                                        </a>

                                        <a
                                            href="<?php echo e(route('banks.complaints.edit', [$bank, $complaint])); ?>"
                                            class="rounded-lg border border-white/10 px-3 py-2 text-xs text-gray-300 transition hover:bg-white/5"
                                        >
                                            تعديل
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="border-t border-white/10 px-5 py-4">
                <?php echo e($complaints->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/complaints/index.blade.php ENDPATH**/ ?>