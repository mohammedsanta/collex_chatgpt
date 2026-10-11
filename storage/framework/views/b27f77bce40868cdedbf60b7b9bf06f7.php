<?php $__env->startSection('title', 'المحافظات'); ?>
<?php $__env->startSection('topbar-title', 'إدارة المحافظات'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'المحافظات','subtitle' => 'إدارة المحافظات المسجلة في النظام والبحث عنها وتحديث بياناتها.','eyebrow' => 'المؤسسات','icon' => 'fa-map-location-dot']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'المحافظات','subtitle' => 'إدارة المحافظات المسجلة في النظام والبحث عنها وتحديث بياناتها.','eyebrow' => 'المؤسسات','icon' => 'fa-map-location-dot']); ?>
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

    <?php
        $totalGovernorates = $governorates->total();
    ?>

    
    <div class="mb-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'إجمالي المحافظات','value' => number_format($totalGovernorates),'icon' => 'fa-map-location-dot','color' => 'green','hint' => 'عدد المحافظات المسجلة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'إجمالي المحافظات','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($totalGovernorates)),'icon' => 'fa-map-location-dot','color' => 'green','hint' => 'عدد المحافظات المسجلة']); ?>
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

    
    <?php if(session('success')): ?>
        <div class="app-flash app-flash-success" role="status">
            <i class="fa-solid fa-circle-check mt-1"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="app-flash app-flash-error" role="alert">
            <i class="fa-solid fa-circle-exclamation mt-1"></i>
            <span><?php echo e(session('error')); ?></span>
        </div>
    <?php endif; ?>

    
    <div class="app-card mb-5">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">البحث والتصفية</h2>
                <p class="mt-1 text-[11px] text-muted">
                    ابحث باسم المحافظة بالعربية أو الإنجليزية.
                </p>
            </div>

            <a href="<?php echo e(route('governorates.create')); ?>"
               class="app-btn app-btn-primary">
                <i class="fa-solid fa-plus"></i>
                إضافة محافظة
            </a>
        </div>

        <div class="app-card-body">
            <form action="<?php echo e(route('governorates.index')); ?>"
                  method="GET"
                  class="grid gap-3 sm:grid-cols-[1fr_auto_auto] sm:items-end">

                <div>
                    <label for="search" class="app-label">اسم المحافظة</label>

                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-xs text-dim"></i>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="<?php echo e($search ?? request('search')); ?>"
                            placeholder="ابحث عن محافظة..."
                            class="app-input pr-9"
                        >
                    </div>
                </div>

                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    بحث
                </button>

                <?php if(filled($search ?? request('search'))): ?>
                    <a href="<?php echo e(route('governorates.index')); ?>"
                       class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-right"></i>
                        إعادة تعيين
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    
    <div class="app-card">
        <div class="app-card-header">
            <div>
                <h2 class="text-sm font-extrabold text-fg">قائمة المحافظات</h2>
                <p class="mt-1 text-[11px] text-muted">
                    بيانات المحافظات المسجلة في النظام.
                </p>
            </div>

            <span class="app-badge app-badge-green">
                <i class="fa-solid fa-layer-group"></i>
                <?php echo e(number_format($totalGovernorates)); ?> محافظة
            </span>
        </div>

        <?php if($governorates->count()): ?>
            <div class="overflow-x-auto">
                <table class="app-table">
                    <thead>
                        <tr>
                            <th class="w-20">#</th>
                            <th>اسم المحافظة بالعربية</th>
                            <th>اسم المحافظة بالإنجليزية</th>
                            <th class="w-36 text-center">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $governorates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $governorate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <span class="num text-[11px] font-bold text-dim">
                                        <?php echo e($governorates->firstItem() + $loop->index); ?>

                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl border border-brand/15 bg-brand/10 text-brand">
                                            <i class="fa-solid fa-map-pin"></i>
                                        </span>

                                        <span class="font-bold text-fg">
                                            <?php echo e($governorate->name); ?>

                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <?php if($governorate->name_en): ?>
                                        <span dir="ltr" class="inline-block text-right text-xs text-muted">
                                            <?php echo e($governorate->name_en); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-dim">—</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            href="<?php echo e(route('governorates.edit', $governorate)); ?>"
                                            class="app-btn app-btn-secondary !min-h-9 !px-3"
                                            title="تعديل المحافظة"
                                            aria-label="تعديل المحافظة <?php echo e($governorate->name); ?>"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-info"></i>
                                            <span>تعديل</span>
                                        </a>

                                        <form
                                            action="<?php echo e(route('governorates.destroy', $governorate)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف المحافظة <?php echo e($governorate->name); ?>؟');"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="app-btn app-btn-danger !min-h-9 !px-3"
                                                title="حذف المحافظة"
                                                aria-label="حذف المحافظة <?php echo e($governorate->name); ?>"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            
<?php if($governorates->hasPages()): ?>
    <div class="flex flex-col gap-4 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-[11px] text-muted">
            عرض
            <span class="font-extrabold text-fg"><?php echo e(number_format($governorates->firstItem())); ?></span>
            إلى
            <span class="font-extrabold text-fg"><?php echo e(number_format($governorates->lastItem())); ?></span>
            من
            <span class="font-extrabold text-fg"><?php echo e(number_format($governorates->total())); ?></span>
            نتيجة
        </p>

        <nav aria-label="التنقل بين صفحات المحافظات"
             class="flex flex-wrap items-center gap-1.5">

            
            <?php if($governorates->onFirstPage()): ?>
                <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50"
                      aria-disabled="true">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    السابق
                </span>
            <?php else: ?>
                <a href="<?php echo e($governorates->previousPageUrl()); ?>"
                   rel="prev"
                   class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    السابق
                </a>
            <?php endif; ?>

            
            <?php $__currentLoopData = $governorates->getUrlRange(1, $governorates->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page === $governorates->currentPage()): ?>
                    <span aria-current="page"
                          class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-brand/30 bg-brand/10 px-3 text-xs font-extrabold text-brand">
                        <?php echo e($page); ?>

                    </span>
                <?php else: ?>
                    <a href="<?php echo e($url); ?>"
                       class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand"
                       aria-label="الصفحة <?php echo e($page); ?>">
                        <?php echo e($page); ?>

                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($governorates->hasMorePages()): ?>
                <a href="<?php echo e($governorates->nextPageUrl()); ?>"
                   rel="next"
                   class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                    التالي
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </a>
            <?php else: ?>
                <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50"
                      aria-disabled="true">
                    التالي
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </span>
            <?php endif; ?>
        </nav>
    </div>
<?php endif; ?>

        <?php else: ?>
            
            <div class="app-empty">
                <span class="app-empty-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </span>

                <h3 class="text-sm font-extrabold text-fg">
                    <?php if(filled($search ?? request('search'))): ?>
                        لا توجد نتائج مطابقة
                    <?php else: ?>
                        لا توجد محافظات مسجلة
                    <?php endif; ?>
                </h3>

                <p class="mt-2 max-w-sm text-xs leading-6 text-muted">
                    <?php if(filled($search ?? request('search'))): ?>
                        جرّب البحث باسم مختلف أو ألغِ التصفية لعرض جميع المحافظات.
                    <?php else: ?>
                        ابدأ بإضافة أول محافظة لتظهر بياناتها هنا.
                    <?php endif; ?>
                </p>

                <div class="mt-5 flex flex-wrap justify-center gap-2">
                    <?php if(filled($search ?? request('search'))): ?>
                        <a href="<?php echo e(route('governorates.index')); ?>"
                           class="app-btn app-btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i>
                            عرض الكل
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('governorates.create')); ?>"
                       class="app-btn app-btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        إضافة محافظة
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/governorates/index.blade.php ENDPATH**/ ?>