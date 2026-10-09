```blade


<?php $__env->startSection('title', 'توزيع المحافظ'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="space-y-6">

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'توزيع المحافظ','subtitle' => 'تابع محافظ البنك، وحجم الحالات والديون، وانتقل إلى توزيع الحالات على المحافظ.','eyebrow' => 'البنوك / التوزيع','icon' => 'fa-layer-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'توزيع المحافظ','subtitle' => 'تابع محافظ البنك، وحجم الحالات والديون، وانتقل إلى توزيع الحالات على المحافظ.','eyebrow' => 'البنوك / التوزيع','icon' => 'fa-layer-group']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a
                href="<?php echo e(route('banks.distribution.create', ['bank' => $bank->id])); ?>"
                class="app-btn app-btn-primary"
            >
                <i class="fa-solid fa-plus"></i>
                إنشاء محفظة جديدة
            </a>

            <a
                href="<?php echo e(route('banks.clients.assign', ['bank' => $bank->id])); ?>"
                class="app-btn app-btn-secondary"
            >
                <i class="fa-solid fa-arrows-left-right-to-line"></i>
                توزيع الحالات
            </a>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    
    <?php if(session('success')): ?>
        <div
            role="status"
            class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-300"
        >
            <i class="fa-solid fa-circle-check ml-2"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div
            role="alert"
            class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300"
        >
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <section class="rounded-2xl border border-white/10 bg-[#121816] p-5 sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-sm text-gray-400">البنك الحالي</p>

                <h2 class="mt-2 text-2xl font-bold text-white">
                    <?php echo e($bank->name); ?>

                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    كود البنك:
                    <span class="font-medium text-gray-300">
                        <?php echo e($bank->code ?: '—'); ?>

                    </span>
                </p>
            </div>

            <div>
                <?php if($bank->is_active): ?>
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-sm text-emerald-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        بنك نشط
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-2 rounded-full border border-red-400/20 bg-red-400/10 px-4 py-2 text-sm text-red-300">
                        <span class="h-2 w-2 rounded-full bg-red-400"></span>
                        بنك غير نشط
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">

        
        <div class="rounded-2xl border border-white/10 bg-[#121816] p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-400">إجمالي المحافظ</p>

                    <p class="mt-3 text-3xl font-bold text-white">
                        <?php echo e(number_format($stats['portfolios_count'])); ?>

                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
                    <i class="fa-solid fa-layer-group text-xl"></i>
                </div>
            </div>

            <p class="mt-4 text-xs text-gray-500">
                عدد المحافظ المسجلة لهذا البنك
            </p>
        </div>

        
        <div class="rounded-2xl border border-white/10 bg-[#121816] p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-400">إجمالي حالات المديونية</p>

                    <p class="mt-3 text-3xl font-bold text-white">
                        <?php echo e(number_format($stats['cases_count'])); ?>

                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sky-400/10 text-sky-300">
                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                </div>
            </div>

            <p class="mt-4 text-xs text-gray-500">
                مجموع الحالات الموجودة داخل محافظ البنك
            </p>
        </div>

        
        <div class="rounded-2xl border border-white/10 bg-[#121816] p-5 sm:col-span-2 xl:col-span-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-400">إجمالي الديون</p>

                    <p class="mt-3 break-words text-2xl font-bold text-emerald-300">
                        <?php echo e(number_format((float) $stats['total_debt'], 2)); ?>

                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                    <i class="fa-solid fa-coins text-xl"></i>
                </div>
            </div>

            <p class="mt-4 text-xs text-gray-500">
                مجموع قيمة الديون المسجلة في الحالات
            </p>
        </div>

    </section>

    
    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'محافظ البنك','subtitle' => 'ابحث عن محفظة واستعرض الفترة وعدد الحالات وإجمالي المديونية.','icon' => 'fa-table-list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'محافظ البنك','subtitle' => 'ابحث عن محفظة واستعرض الفترة وعدد الحالات وإجمالي المديونية.','icon' => 'fa-table-list']); ?>
        
        <form
            method="GET"
            action="<?php echo e(route('banks.distribution.index', ['bank' => $bank->id])); ?>"
            class="mb-5 flex flex-col gap-3 sm:flex-row"
        >
            <div class="relative min-w-0 flex-1">
                <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-500"></i>

                <input
                    type="search"
                    name="search"
                    value="<?php echo e($search); ?>"
                    placeholder="ابحث باسم المحفظة أو الحالة أو السنة..."
                    aria-label="البحث في المحافظ"
                    class="w-full rounded-xl border border-white/10 bg-[#0b0f0e] py-3 pr-11 pl-4 text-white outline-none placeholder:text-gray-500 focus:border-emerald-400"
                >
            </div>

            <button type="submit" class="app-btn app-btn-primary justify-center">
                <i class="fa-solid fa-magnifying-glass"></i>
                بحث
            </button>

            <?php if($search !== ''): ?>
                <a
                    href="<?php echo e(route('banks.distribution.index', ['bank' => $bank->id])); ?>"
                    class="app-btn app-btn-secondary justify-center"
                >
                    <i class="fa-solid fa-xmark"></i>
                    مسح البحث
                </a>
            <?php endif; ?>
        </form>

        
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3 text-sm">
            <p class="text-gray-400">
                عدد النتائج:
                <span class="font-semibold text-emerald-300">
                    <?php echo e(number_format($portfolios->total())); ?>

                </span>
            </p>

            <p class="text-gray-500">
                الصفحة <?php echo e($portfolios->currentPage()); ?>

                من <?php echo e(max(1, $portfolios->lastPage())); ?>

            </p>
        </div>

        
        <div class="overflow-x-auto rounded-xl border border-white/5">
            <table class="w-full min-w-[850px] text-right text-sm">
                <thead class="bg-white/[0.025]">
                    <tr class="border-b border-white/10 text-gray-400">
                        <th scope="col" class="px-4 py-4 font-medium">المحفظة</th>
                        <th scope="col" class="px-4 py-4 font-medium">الفترة</th>
                        <th scope="col" class="px-4 py-4 font-medium">عدد الحالات</th>
                        <th scope="col" class="px-4 py-4 font-medium">إجمالي الديون</th>
                        <th scope="col" class="px-4 py-4 font-medium">الحالة</th>
                        <th scope="col" class="px-4 py-4 font-medium">تاريخ الإنشاء</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    <?php $__empty_1 = true; $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $status = strtolower((string) $portfolio->status);

                            [$statusLabel, $statusClass] = match ($status) {
                                'active', 'activated' => [
                                    'نشطة',
                                    'bg-emerald-400/10 text-emerald-300 ring-emerald-400/20',
                                ],
                                'archived' => [
                                    'مؤرشفة',
                                    'bg-gray-400/10 text-gray-300 ring-gray-400/20',
                                ],
                                'draft' => [
                                    'مسودة',
                                    'bg-amber-400/10 text-amber-300 ring-amber-400/20',
                                ],
                                'pending' => [
                                    'قيد الانتظار',
                                    'bg-amber-400/10 text-amber-300 ring-amber-400/20',
                                ],
                                default => [
                                    $portfolio->status ?: 'غير محدد',
                                    'bg-sky-400/10 text-sky-300 ring-sky-400/20',
                                ],
                            };
                        ?>

                        <tr class="transition hover:bg-white/[0.03]">
                            <td class="px-4 py-4">
                                <div class="font-semibold text-white">
                                    <?php echo e($portfolio->name); ?>

                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    رقم المحفظة: #<?php echo e($portfolio->id); ?>

                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-gray-300">
                                <?php echo e($portfolio->period_year); ?>/<?php echo e(str_pad((string) $portfolio->period_month, 2, '0', STR_PAD_LEFT)); ?>

                            </td>

                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-lg bg-sky-400/10 px-3 py-1 text-sky-300">
                                    <?php echo e(number_format($portfolio->debt_cases_count)); ?>

                                </span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-emerald-300">
                                <?php echo e(number_format((float) ($portfolio->debt_cases_sum_total_debt ?? 0), 2)); ?>

                            </td>

                            <td class="px-4 py-4">
                                <span class="inline-flex whitespace-nowrap rounded-full px-3 py-1 text-xs ring-1 <?php echo e($statusClass); ?>">
                                    <?php echo e($statusLabel); ?>

                                </span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-gray-400">
                                <?php echo e($portfolio->created_at?->format('Y-m-d') ?? '—'); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-14 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-gray-500">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>

                                <p class="mt-4 font-semibold text-gray-300">
                                    <?php if($search !== ''): ?>
                                        لا توجد نتائج مطابقة
                                    <?php else: ?>
                                        لا توجد محافظ لهذا البنك
                                    <?php endif; ?>
                                </p>

                                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                                    <?php if($search !== ''): ?>
                                        جرّب البحث باستخدام اسم آخر أو امسح البحث لعرض جميع المحافظ.
                                    <?php else: ?>
                                        يمكنك إنشاء أول محفظة لهذا البنك من خلال زر إنشاء محفظة جديدة بالأعلى.
                                    <?php endif; ?>
                                </p>

                                <?php if($search !== ''): ?>
                                    <a
                                        href="<?php echo e(route('banks.distribution.index', ['bank' => $bank->id])); ?>"
                                        class="app-btn app-btn-secondary mt-4"
                                    >
                                        مسح البحث
                                    </a>
                                <?php else: ?>
                                    <a
                                        href="<?php echo e(route('banks.distribution.create', ['bank' => $bank->id])); ?>"
                                        class="app-btn app-btn-primary mt-4"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        إنشاء أول محفظة
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($portfolios->hasPages()): ?>
            <div class="mt-5 border-t border-white/10 pt-5">
                <?php echo e($portfolios->links()); ?>

            </div>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
```

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/distribution/index.blade.php ENDPATH**/ ?>