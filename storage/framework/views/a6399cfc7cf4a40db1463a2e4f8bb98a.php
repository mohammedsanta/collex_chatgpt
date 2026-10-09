<?php $__env->startSection('content'); ?>

<div dir="rtl" class="min-h-screen bg-[#0b0f0d] px-4 py-6 text-gray-100 sm:px-6 lg:px-8">


<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
    <div>
        <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
            <a href="<?php echo e(route('banks.show', $bank)); ?>" class="transition hover:text-lime-400">
                البنوك
            </a>
            <span>/</span>
            <span>الزيارات الميدانية</span>
        </div>

        <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
            الزيارات الميدانية
        </h1>

        <p class="mt-2 text-sm text-gray-400">
            متابعة زيارات العملاء وحالات التحصيل الخاصة ببنك
            <?php echo e($bank->name); ?>

        </p>
    </div>

    <a
        href="<?php echo e(route('banks.visits.create', $bank)); ?>"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-lime-400 px-5 py-3 font-bold text-gray-950 transition hover:bg-lime-300"
    >
        <span class="text-xl">+</span>
        إضافة زيارة جديدة
    </a>
</div>


<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-400">إجمالي الزيارات</span>
            <span class="rounded-lg bg-lime-400/10 p-2 text-lime-400">▤</span>
        </div>
        <p class="mt-4 text-3xl font-bold">
            <?php echo e($visits->total()); ?>

        </p>
        <p class="mt-1 text-xs text-gray-500">عدد الزيارات المسجلة</p>
    </div>

    <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-400">زيارات اليوم</span>
            <span class="rounded-lg bg-blue-400/10 p-2 text-blue-400">◷</span>
        </div>
        <p class="mt-4 text-3xl font-bold">
            <?php echo e($visits->getCollection()->filter(fn ($visit) => $visit->created_at?->isToday())->count()); ?>

        </p>
        <p class="mt-1 text-xs text-gray-500">من النتائج المعروضة في الصفحة الحالية</p>
    </div>

    <div class="rounded-2xl border border-white/10 bg-[#121915] p-5">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-400">حالات التحصيل المرتبطة</span>
            <span class="rounded-lg bg-emerald-400/10 p-2 text-emerald-400">✓</span>
        </div>
        <p class="mt-4 text-3xl font-bold">
            <?php echo e($visits->getCollection()->pluck('debt_case_id')->filter()->unique()->count()); ?>

        </p>
        <p class="mt-1 text-xs text-gray-500">حالات مختلفة في الصفحة الحالية</p>
    </div>
</div>


<form method="GET" action="<?php echo e(route('banks.visits.index', $bank)); ?>"
      class="mb-6 rounded-2xl border border-white/10 bg-[#121915] p-4">
    <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_auto_auto]">
        <div>
            <label for="search" class="mb-2 block text-sm text-gray-300">
                البحث
            </label>
            <input
                id="search"
                name="search"
                type="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="رقم الحالة أو اسم العميل..."
                class="w-full rounded-xl border border-white/10 bg-[#0b0f0d] px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-lime-400"
            >
        </div>

        <div>
            <label for="per_page" class="mb-2 block text-sm text-gray-300">
                عدد النتائج
            </label>
            <select
                id="per_page"
                name="per_page"
                class="w-full rounded-xl border border-white/10 bg-[#0b0f0d] px-4 py-3 text-sm text-white outline-none focus:border-lime-400"
            >
                <?php $__currentLoopData = [15, 25, 50]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($size); ?>" <?php if((int) request('per_page', 15) === $size): echo 'selected'; endif; ?>>
                        <?php echo e($size); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button
                type="submit"
                class="rounded-xl bg-lime-400 px-5 py-3 font-bold text-gray-950 transition hover:bg-lime-300"
            >
                بحث
            </button>

            <a
                href="<?php echo e(route('banks.visits.index', $bank)); ?>"
                class="rounded-xl border border-white/10 px-4 py-3 text-gray-300 transition hover:bg-white/5"
            >
                إعادة ضبط
            </a>
        </div>
    </div>
</form>


<div class="overflow-hidden rounded-2xl border border-white/10 bg-[#121915]">
    <div class="flex flex-col justify-between gap-2 border-b border-white/10 px-5 py-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="font-bold">سجل الزيارات</h2>
            <p class="mt-1 text-xs text-gray-500">الزيارات المرتبطة بحالات القروض التابعة للبنك</p>
        </div>

        <span class="text-sm text-gray-400">
            <?php echo e($visits->firstItem() ?? 0); ?>–<?php echo e($visits->lastItem() ?? 0); ?>

            من <?php echo e($visits->total()); ?>

        </span>
    </div>

    <?php if(session('success')): ?>
        <div class="m-4 rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="m-4 rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm text-red-300">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[850px] text-right text-sm">
            <thead class="border-b border-white/10 bg-white/[0.02] text-xs text-gray-400">
                <tr>
                    <th class="px-5 py-4 font-medium">الزيارة</th>
                    <th class="px-5 py-4 font-medium">حالة القرض</th>
                    <th class="px-5 py-4 font-medium">الموظف</th>
                    <th class="px-5 py-4 font-medium">تاريخ التسجيل</th>
                    <th class="px-5 py-4 font-medium">الحالة</th>
                    <th class="px-5 py-4 font-medium">الإجراءات</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="transition hover:bg-white/[0.025]">
                        <td class="px-5 py-4">
                            <div class="font-semibold text-white">
                                زيارة #<?php echo e($visit->id); ?>

                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                <?php echo e(class_basename($visit)); ?>

                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <div class="font-medium text-gray-200">
                                <?php echo e($visit->debtCase?->loan_number ?: 'حالة #' . ($visit->debt_case_id ?? '—')); ?>

                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                <?php echo e($visit->debtCase?->client?->name ?? 'عميل غير محدد'); ?>

                            </div>
                        </td>

                        <td class="px-5 py-4 text-gray-300">
                            <?php echo e($visit->user?->name ?? 'غير محدد'); ?>

                        </td>

                        <td class="px-5 py-4 text-gray-300">
                            <?php echo e($visit->created_at?->format('Y-m-d H:i') ?? '—'); ?>

                        </td>

                        <td class="px-5 py-4">
                            <?php
                                $status = $visit->status?->value ?? $visit->status ?? 'scheduled';

                                $statusLabels = [
                                    'scheduled' => 'مجدولة',
                                    'planned' => 'مخططة',
                                    'in_progress' => 'قيد التنفيذ',
                                    'completed' => 'مكتملة',
                                    'cancelled' => 'ملغاة',
                                    'failed' => 'لم تتم',
                                ];

                                $statusClasses = [
                                    'scheduled' => 'bg-blue-400/10 text-blue-300',
                                    'planned' => 'bg-blue-400/10 text-blue-300',
                                    'in_progress' => 'bg-amber-400/10 text-amber-300',
                                    'completed' => 'bg-emerald-400/10 text-emerald-300',
                                    'cancelled' => 'bg-red-400/10 text-red-300',
                                    'failed' => 'bg-red-400/10 text-red-300',
                                ];
                            ?>

                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusClasses[$status] ?? 'bg-white/10 text-gray-300'); ?>">
                                <?php echo e($statusLabels[$status] ?? $status); ?>

                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <a
                                href="<?php echo e(route('banks.visits.edit', [$bank, $visit])); ?>"
                                class="inline-flex rounded-lg border border-white/10 px-3 py-2 text-xs font-semibold text-gray-300 transition hover:border-lime-400/40 hover:text-lime-300"
                            >
                                تعديل
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-400/10 text-2xl text-lime-400">
                                ⌖
                            </div>
                            <h3 class="font-bold text-white">لا توجد زيارات ميدانية</h3>
                            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                                لم يتم تسجيل زيارات مرتبطة بحالات هذا البنك حتى الآن.
                                يمكنك إنشاء أول زيارة من الزر بالأعلى.
                            </p>
                            <a
                                href="<?php echo e(route('banks.visits.create', $bank)); ?>"
                                class="mt-5 inline-flex rounded-xl bg-lime-400 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-lime-300"
                            >
                                تسجيل أول زيارة
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($visits->hasPages()): ?>
        <div class="border-t border-white/10 px-5 py-4">
            <?php echo e($visits->withQueryString()->links()); ?>

        </div>
    <?php endif; ?>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/visits/index.blade.php ENDPATH**/ ?>