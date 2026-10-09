<?php $__env->startSection('title', 'أرشيف البنك | Collex'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold text-emerald-400">
                COLLEX / إدارة البنوك / الأرشيف
            </p>

            <h1 class="mt-2 text-2xl font-bold md:text-3xl">
                أرشيف <?php echo e($bank->name); ?>

            </h1>

            <p class="mt-2 text-sm leading-6 text-slate-400">
                استعراض اللقطات الشهرية التاريخية لمحافظ البنك ومؤشرات التحصيل.
            </p>
        </div>

        <a href="<?php echo e(route('banks.panel', ['bank' => $bank->id])); ?>"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700 px-4 py-3 text-sm transition hover:border-emerald-500 hover:bg-slate-900">
            <i class="fa-solid fa-arrow-right"></i>
            العودة إلى لوحة البنك
        </a>
    </div>

    
    <?php echo $__env->make('banks._nav', ['bank' => $bank], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-400">عدد الأرشيفات</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-400/10 text-sky-400">
                    <i class="fa-solid fa-box-archive"></i>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-white">
                <?php echo e(number_format($stats['archives_count'])); ?>

            </p>
            <p class="mt-2 text-xs text-slate-500">السجلات الشهرية المحفوظة</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-400">إجمالي الحالات المؤرشفة</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-400/10 text-violet-400">
                    <i class="fa-solid fa-file-invoice"></i>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-white">
                <?php echo e(number_format($stats['cases_count'])); ?>

            </p>
            <p class="mt-2 text-xs text-slate-500">مجموع أعداد الحالات المسجلة بالأرشيف</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-400">إجمالي المديونية</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-400/10 text-amber-400">
                    <i class="fa-solid fa-scale-balanced"></i>
                </span>
            </div>
            <p class="mt-4 break-words text-2xl font-bold text-amber-300">
                <?php echo e(number_format($stats['total_debt'], 2)); ?>

                <span class="text-xs font-medium text-slate-500">ج.م</span>
            </p>
            <p class="mt-2 text-xs text-slate-500">إجمالي المديونية المسجلة في اللقطات</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <div class="flex items-center justify-between gap-3">
                <span class="text-sm text-slate-400">إجمالي التحصيل</span>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-400">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </span>
            </div>
            <p class="mt-4 break-words text-2xl font-bold text-emerald-300">
                <?php echo e(number_format($stats['collected_amount'], 2)); ?>

                <span class="text-xs font-medium text-slate-500">ج.م</span>
            </p>
            <p class="mt-2 text-xs text-slate-500">إجمالي التحصيل المسجل في اللقطات</p>
        </div>

    </div>

    
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <div class="mb-4">
            <h2 class="font-bold text-white">البحث وتصفية الأرشيف</h2>
            <p class="mt-1 text-xs text-slate-500">
                حدد السنة أو الشهر أو ابحث باسم المحفظة أو ملاحظات الأرشيف.
            </p>
        </div>

        <form method="GET"
              action="<?php echo e(route('banks.archives.index', ['bank' => $bank->id])); ?>"
              class="grid grid-cols-1 items-end gap-3 sm:grid-cols-2 xl:grid-cols-4">

            <div>
                <label for="search" class="mb-2 block text-sm text-slate-300">
                    بحث
                </label>
                <input id="search"
                       type="search"
                       name="search"
                       value="<?php echo e($search); ?>"
                       maxlength="100"
                       placeholder="اسم المحفظة أو ملاحظات..."
                       class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none placeholder:text-slate-600 focus:border-emerald-400">
            </div>

            <div>
                <label for="year" class="mb-2 block text-sm text-slate-300">
                    السنة
                </label>
                <select id="year"
                        name="year"
                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-emerald-400">
                    <option value="">كل السنوات</option>
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archiveYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($archiveYear); ?>"
                            <?php if((string) $year === (string) $archiveYear): echo 'selected'; endif; ?>>
                            <?php echo e($archiveYear); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label for="month" class="mb-2 block text-sm text-slate-300">
                    الشهر
                </label>
                <select id="month"
                        name="month"
                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-emerald-400">
                    <option value="">كل الشهور</option>
                    <?php $__currentLoopData = [
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
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monthNumber => $monthName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($monthNumber); ?>"
                            <?php if((string) $month === (string) $monthNumber): echo 'selected'; endif; ?>>
                            <?php echo e($monthName); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:bg-emerald-300">
                    <i class="fa-solid fa-filter"></i>
                    تطبيق
                </button>

                <a href="<?php echo e(route('banks.archives.index', ['bank' => $bank->id])); ?>"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700 px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800">
                    <i class="fa-solid fa-rotate-left"></i>
                    إعادة ضبط
                </a>
            </div>
        </form>
    </section>

    
    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">

        <div class="flex flex-col justify-between gap-3 border-b border-slate-800 p-5 sm:flex-row sm:items-center">
            <div>
                <h2 class="font-bold text-white">السجل التاريخي</h2>
                <p class="mt-1 text-xs text-slate-500">
                    <?php echo e(number_format($archives->total())); ?> سجل مطابق للفلاتر
                </p>
            </div>

            <span class="text-xs text-slate-400">
                عرض <?php echo e($archives->firstItem() ?? 0); ?>

                إلى <?php echo e($archives->lastItem() ?? 0); ?>

                من <?php echo e($archives->total()); ?>

            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-right text-sm">
                <thead class="border-b border-slate-800 bg-slate-950/60 text-xs text-slate-400">
                    <tr>
                        <th class="px-5 py-4 font-medium">الفترة</th>
                        <th class="px-5 py-4 font-medium">المحفظة</th>
                        <th class="px-5 py-4 font-medium">عدد الحالات</th>
                        <th class="px-5 py-4 font-medium">إجمالي المديونية</th>
                        <th class="px-5 py-4 font-medium">إجمالي التحصيل</th>
                        <th class="px-5 py-4 font-medium">تاريخ الأرشفة</th>
                        <th class="px-5 py-4 text-center font-medium">التفاصيل</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800/80">
                    <?php $__empty_1 = true; $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
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
                        ?>

                        <tr class="transition hover:bg-slate-800/40">
                            <td class="px-5 py-4">
                                <div class="font-bold text-white">
                                    <?php echo e($monthNames[$archive->month] ?? $archive->month); ?>

                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    <?php echo e($archive->year); ?>

                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-200">
                                    <?php echo e($archive->portfolio?->name ?? 'أرشيف البنك بالكامل'); ?>

                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    <?php echo e($archive->portfolio ? 'محفظة محددة' : 'لقطة مجمعة'); ?>

                                </div>
                            </td>

                            <td class="px-5 py-4 font-semibold text-slate-200">
                                <?php echo e(number_format($archive->cases_count)); ?>

                            </td>

                            <td class="px-5 py-4 whitespace-nowrap text-amber-300">
                                <?php echo e(number_format((float) $archive->total_debt, 2)); ?>

                                <span class="text-xs text-slate-500">ج.م</span>
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap font-semibold text-emerald-300">
                                <?php echo e(number_format((float) $archive->collected_amount, 2)); ?>

                                <span class="text-xs text-slate-500">ج.م</span>
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                <?php echo e($archive->archived_at?->format('Y-m-d') ?? '—'); ?>

                                <div class="mt-1 text-xs text-slate-500">
                                    <?php echo e($archive->archivedBy?->name ?? 'النظام'); ?>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <a href="<?php echo e(route('banks.archives.show', [
                                        'bank' => $bank->id,
                                        'archive' => $archive->id,
                                    ])); ?>"
                                   class="inline-flex items-center gap-2 rounded-lg border border-sky-400/20 bg-sky-400/10 px-3 py-2 text-xs font-semibold text-sky-300 transition hover:bg-sky-400/20">
                                    <i class="fa-solid fa-eye"></i>
                                    عرض
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-800 bg-slate-950 text-slate-500">
                                    <i class="fa-solid fa-box-open text-xl"></i>
                                </div>

                                <h3 class="mt-4 font-bold text-white">
                                    لا توجد أرشيفات مطابقة
                                </h3>

                                <p class="mt-2 text-sm text-slate-500">
                                    لا توجد سجلات للفترة المحددة، أو لم يتم إنشاء أرشيف شهري لهذا البنك بعد.
                                </p>

                                <?php if($search !== '' || $year || $month): ?>
                                    <a href="<?php echo e(route('banks.archives.index', ['bank' => $bank->id])); ?>"
                                       class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-emerald-400 hover:text-emerald-300">
                                        <i class="fa-solid fa-rotate-left"></i>
                                        عرض كل الأرشيفات
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($archives->hasPages()): ?>
            <div class="border-t border-slate-800 px-5 py-4">
                <?php echo e($archives->links()); ?>

            </div>
        <?php endif; ?>
    </section>

    <p class="text-xs leading-6 text-slate-500">
        ملاحظة: الأرقام المعروضة هي مجموع لقطات الأرشيف المحفوظة، وليست بالضرورة أرصدة البنك الحالية.
        لا يتم إنشاء أو تعديل أي أرشيف من خلال صفحة العرض هذه.
    </p>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/archives/index.blade.php ENDPATH**/ ?>