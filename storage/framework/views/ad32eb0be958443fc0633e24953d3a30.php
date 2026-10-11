<?php $__env->startSection('title', 'أنواع القروض | Collex'); ?>
<?php $__env->startSection('topbar-title', 'أنواع القروض'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6" dir="rtl">

        
        <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'أنواع القروض','subtitle' => 'إدارة أنواع القروض المتاحة داخل النظام.','eyebrow' => 'الإدارة','icon' => 'fa-solid fa-layer-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'أنواع القروض','subtitle' => 'إدارة أنواع القروض المتاحة داخل النظام.','eyebrow' => 'الإدارة','icon' => 'fa-solid fa-layer-group']); ?>
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

        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'إجمالي الأنواع','value' => number_format($statistics['total']),'icon' => 'fa-solid fa-layer-group','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'إجمالي الأنواع','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($statistics['total'])),'icon' => 'fa-solid fa-layer-group','color' => 'blue']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'الأنواع النشطة','value' => number_format($statistics['active']),'icon' => 'fa-solid fa-circle-check','color' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الأنواع النشطة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($statistics['active'])),'icon' => 'fa-solid fa-circle-check','color' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'الأنواع غير النشطة','value' => number_format($statistics['inactive']),'icon' => 'fa-solid fa-circle-pause','color' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الأنواع غير النشطة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($statistics['inactive'])),'icon' => 'fa-solid fa-circle-pause','color' => 'orange']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        </div>

        
        <section class="app-card">
            <div class="app-card-header">
                <div>
                    <h2 class="font-semibold text-fg">البحث والتصفية</h2>
                    <p class="mt-1 text-sm text-muted">
                        ابحث عن نوع قرض أو صفِّ النتائج حسب الحالة.
                    </p>
                </div>
            </div>

            <div class="app-card-body">
                <form
                    method="GET"
                    action="<?php echo e(route('loan-types.index')); ?>"
                    class="grid grid-cols-1 items-end gap-4 md:grid-cols-[minmax(0,1fr)_220px_auto]"
                >
                    <div>
                        <label for="search" class="app-label">
                            اسم نوع القرض
                        </label>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="<?php echo e($filters['search'] ?? ''); ?>"
                            placeholder="ابحث باسم نوع القرض..."
                            class="app-input w-full"
                        >
                    </div>

                    <div>
                        <label for="status" class="app-label">
                            الحالة
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="app-input w-full"
                        >
                            <option value="">كل الحالات</option>
                            <option
                                value="active"
                                <?php if(($filters['status'] ?? '') === 'active'): echo 'selected'; endif; ?>
                            >
                                نشط
                            </option>
                            <option
                                value="inactive"
                                <?php if(($filters['status'] ?? '') === 'inactive'): echo 'selected'; endif; ?>
                            >
                                غير نشط
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="app-btn app-btn-primary">
                            <i class="fa-solid fa-magnifying-glass ms-1"></i>
                            بحث
                        </button>

                        <a
                            href="<?php echo e(route('loan-types.index')); ?>"
                            class="app-btn app-btn-secondary"
                        >
                            <i class="fa-solid fa-rotate-right ms-1"></i>
                            إعادة ضبط
                        </a>
                    </div>
                </form>
            </div>
        </section>

        
        <section class="app-card overflow-hidden">
            <div class="app-card-header flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-semibold text-fg">سجلات أنواع القروض</h2>
                    <p class="mt-1 text-sm text-muted">
                        إجمالي النتائج:
                        <span class="font-semibold text-fg">
                            <?php echo e(number_format($loanTypes->total())); ?>

                        </span>
                    </p>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Domain\Institutions\Models\LoanType::class)): ?>
                    <a
                        href="<?php echo e(route('loan-types.create')); ?>"
                        class="app-btn app-btn-primary"
                    >
                        <i class="fa-solid fa-plus ms-1"></i>
                        إضافة نوع قرض
                    </a>
                <?php endif; ?>
            </div>

            <div class="overflow-x-auto">
                <table class="app-table w-full">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">اسم نوع القرض</th>
                            <th class="whitespace-nowrap">ملفات القروض المرتبطة</th>
                            <th class="whitespace-nowrap">الحالة</th>
                            <th class="whitespace-nowrap">تاريخ الإضافة</th>
                            <th class="whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $loanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="whitespace-nowrap text-muted">
                                    <?php echo e($loanType->id); ?>

                                </td>

                                <td class="whitespace-nowrap font-semibold text-fg">
                                    <?php echo e($loanType->name); ?>

                                </td>

                                <td class="whitespace-nowrap">
                                    <span class="font-semibold text-fg">
                                        <?php echo e(number_format($loanType->debt_cases_count)); ?>

                                    </span>
                                </td>

                                <td class="whitespace-nowrap">
                                    <?php if($loanType->is_active): ?>
                                        <span class="app-badge app-badge-green">
                                            نشط
                                        </span>
                                    <?php else: ?>
                                        <span class="app-badge app-badge-gray">
                                            غير نشط
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="whitespace-nowrap text-muted">
                                    <?php echo e($loanType->created_at?->format('Y-m-d') ?? '—'); ?>

                                </td>

                                <td>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $loanType)): ?>
                                            <a
                                                href="<?php echo e(route('loan-types.edit', $loanType)); ?>"
                                                class="app-btn app-btn-secondary"
                                            >
                                                <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                تعديل
                                            </a>
                                        <?php endif; ?>

                                        <?php if($loanType->is_active): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deactivate', $loanType)): ?>
                                                <form
                                                    method="POST"
                                                    action="<?php echo e(route('loan-types.deactivate', $loanType)); ?>"
                                                >
                                                    <?php echo csrf_field(); ?>

                                                    <button
                                                        type="submit"
                                                        class="app-btn app-btn-secondary"
                                                    >
                                                        <i class="fa-solid fa-ban ms-1"></i>
                                                        تعطيل
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('activate', $loanType)): ?>
                                                <form
                                                    method="POST"
                                                    action="<?php echo e(route('loan-types.activate', $loanType)); ?>"
                                                >
                                                    <?php echo csrf_field(); ?>

                                                    <button
                                                        type="submit"
                                                        class="app-btn app-btn-secondary"
                                                    >
                                                        <i class="fa-solid fa-check ms-1"></i>
                                                        تفعيل
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <?php if($loanType->debt_cases_count === 0): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $loanType)): ?>
                                                    <form
                                                        method="POST"
                                                        action="<?php echo e(route('loan-types.destroy', $loanType)); ?>"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف نوع القرض؟')"
                                                    >
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>

                                                        <button
                                                            type="submit"
                                                            class="app-btn app-btn-danger"
                                                        >
                                                            <i class="fa-solid fa-trash ms-1"></i>
                                                            حذف
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <div class="app-empty">
                                        <i class="fa-solid fa-layer-group mb-3 text-2xl text-muted"></i>

                                        <p class="font-semibold text-fg">
                                            لا توجد أنواع قروض مطابقة.
                                        </p>

                                        <p class="mt-2 text-sm text-muted">
                                            جرّب تغيير البحث أو الفلاتر.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($loanTypes->hasPages()): ?>
                <div class="app-card-body border-t border-line">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-muted">
                            عرض
                            <span class="font-semibold text-fg">
                                <?php echo e(number_format($loanTypes->firstItem() ?? 0)); ?>

                            </span>
                            إلى
                            <span class="font-semibold text-fg">
                                <?php echo e(number_format($loanTypes->lastItem() ?? 0)); ?>

                            </span>
                            من
                            <span class="font-semibold text-fg">
                                <?php echo e(number_format($loanTypes->total())); ?>

                            </span>
                            نتيجة
                        </p>

                        <nav
                            class="flex flex-wrap items-center gap-1"
                            aria-label="التنقل بين صفحات أنواع القروض"
                        >
                            <?php if($loanTypes->onFirstPage()): ?>
                                <span class="app-btn app-btn-secondary opacity-50" aria-disabled="true">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </span>
                            <?php else: ?>
                                <a
                                    href="<?php echo e($loanTypes->previousPageUrl()); ?>"
                                    class="app-btn app-btn-secondary"
                                    aria-label="الصفحة السابقة"
                                >
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <span class="sr-only">السابق</span>
                                </a>
                            <?php endif; ?>

                            <?php $__currentLoopData = $loanTypes->getUrlRange(
                                max(1, $loanTypes->currentPage() - 2),
                                min($loanTypes->lastPage(), $loanTypes->currentPage() + 2)
                            ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a
                                    href="<?php echo e($url); ?>"
                                    <?php if($page === $loanTypes->currentPage()): ?> aria-current="page" <?php endif; ?>
                                    class="app-btn <?php echo e($page === $loanTypes->currentPage() ? 'app-btn-primary' : 'app-btn-secondary'); ?>"
                                >
                                    <?php echo e($page); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($loanTypes->hasMorePages()): ?>
                                <a
                                    href="<?php echo e($loanTypes->nextPageUrl()); ?>"
                                    class="app-btn app-btn-secondary"
                                    aria-label="الصفحة التالية"
                                >
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span class="sr-only">التالي</span>
                                </a>
                            <?php else: ?>
                                <span class="app-btn app-btn-secondary opacity-50" aria-disabled="true">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span class="sr-only">التالي</span>
                                </span>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loan-types/index.blade.php ENDPATH**/ ?>