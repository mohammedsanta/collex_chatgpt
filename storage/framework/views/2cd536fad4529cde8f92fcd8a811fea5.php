```blade


<?php $__env->startSection('title', 'تفاصيل الأرشيف'); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'تفاصيل الأرشيف الشهري','subtitle' => 'عرض البيانات التاريخية للتحصيل المحفوظة وقت إنشاء الأرشيف.','eyebrow' => 'الأرشيف / التفاصيل','icon' => 'fa-box-archive']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تفاصيل الأرشيف الشهري','subtitle' => 'عرض البيانات التاريخية للتحصيل المحفوظة وقت إنشاء الأرشيف.','eyebrow' => 'الأرشيف / التفاصيل','icon' => 'fa-box-archive']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <?php if(\Illuminate\Support\Facades\Route::has('banks.archives.index')): ?>
                <a
                    href="<?php echo e(route('banks.archives.index', ['bank' => $bank->id])); ?>"
                    class="app-btn app-btn-secondary"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    العودة للأرشيف
                </a>
            <?php endif; ?>
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


    
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'السنة','value' => $archive->year ?? '—','icon' => 'fa-calendar','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'السنة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($archive->year ?? '—'),'icon' => 'fa-calendar','color' => 'blue']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'الشهر','value' => $archive->month ?? '—','icon' => 'fa-calendar-days','color' => 'purple']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الشهر','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($archive->month ?? '—'),'icon' => 'fa-calendar-days','color' => 'purple']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'عدد القضايا','value' => number_format((int) ($archive->cases_count ?? 0)),'icon' => 'fa-file-invoice','color' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'عدد القضايا','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format((int) ($archive->cases_count ?? 0))),'icon' => 'fa-file-invoice','color' => 'green']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'إجمالي الدين','value' => number_format((float) ($archive->total_debt ?? 0), 2) . ' ج.م','icon' => 'fa-scale-balanced','color' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'إجمالي الدين','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format((float) ($archive->total_debt ?? 0), 2) . ' ج.م'),'icon' => 'fa-scale-balanced','color' => 'orange']); ?>
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


    
    <div class="mt-5 grid gap-4 sm:grid-cols-2">

        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'ملخص التحصيل','icon' => 'fa-money-bill-transfer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'ملخص التحصيل','icon' => 'fa-money-bill-transfer']); ?>

            <div class="space-y-4">

                <div class="flex items-center justify-between gap-4">
                    <span class="text-xs text-dim">
                        إجمالي الدين
                    </span>

                    <span class="text-sm font-extrabold">
                        <?php echo e(number_format((float) ($archive->total_debt ?? 0), 2)); ?>

                        ج.م
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-xs text-dim">
                        إجمالي التحصيل
                    </span>

                    <span class="text-sm font-extrabold text-brand">
                        <?php echo e(number_format((float) ($archive->collected_amount ?? 0), 2)); ?>

                        ج.م
                    </span>
                </div>

                <div class="border-t border-white/5 pt-4">

                    <div class="mb-2 flex items-center justify-between gap-4">
                        <span class="text-xs text-dim">
                            نسبة التحصيل
                        </span>

                        <?php
                            $totalDebt = (float) ($archive->total_debt ?? 0);
                            $collectedAmount = (float) ($archive->collected_amount ?? 0);

                            $collectionRate = $totalDebt > 0
                                ? ($collectedAmount / $totalDebt) * 100
                                : 0;

                            $collectionRate = max(0, min(100, $collectionRate));
                        ?>

                        <span class="text-xs font-extrabold text-brand">
                            <?php echo e(number_format($totalDebt > 0 ? ($collectedAmount / $totalDebt) * 100 : 0, 2)); ?>%
                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-white/5">
                        <div
                            class="h-full rounded-full bg-brand transition-all"
                            style="width: <?php echo e($collectionRate); ?>%"
                        ></div>
                    </div>

                </div>

            </div>

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


        
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'معلومات الأرشيف','icon' => 'fa-circle-info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'معلومات الأرشيف','icon' => 'fa-circle-info']); ?>

            <dl class="grid gap-4 sm:grid-cols-2">

                <div>
                    <dt class="text-[10px] text-dim">
                        البنك
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        <?php echo e($archive->bank?->name ?? $bank->name ?? '—'); ?>

                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        رقم الأرشيف
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        #<?php echo e($archive->id); ?>

                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        تاريخ الأرشفة
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        <?php echo e($archive->archived_at?->format('Y-m-d H:i') ?? '—'); ?>

                    </dd>
                </div>

                <div>
                    <dt class="text-[10px] text-dim">
                        أُنشئ السجل في
                    </dt>

                    <dd class="mt-1 text-xs font-extrabold">
                        <?php echo e($archive->created_at?->format('Y-m-d H:i') ?? '—'); ?>

                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-[10px] text-dim">
                        ملاحظات
                    </dt>

                    <dd class="mt-1 whitespace-pre-line text-xs leading-6">
                        <?php echo e(filled($archive->notes) ? $archive->notes : 'لا توجد ملاحظات مسجلة.'); ?>

                    </dd>
                </div>

            </dl>

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


    
    <div class="mt-5">

        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'ملف اللقطة التاريخية','icon' => 'fa-file-arrow-down']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'ملف اللقطة التاريخية','icon' => 'fa-file-arrow-down']); ?>

            <?php if($archive->snapshot_path): ?>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-brand/20 bg-brand/5 text-brand">
                            <i class="fa-solid fa-file-archive text-lg"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs font-extrabold">
                                ملف الأرشيف
                            </p>

                            <p class="mt-1 break-all text-[10px] text-dim">
                                <?php echo e($archive->snapshot_path); ?>

                            </p>
                        </div>

                    </div>

                    <a
                        class="app-btn app-btn-primary shrink-0"
                        href="<?php echo e(\Illuminate\Support\Facades\Storage::disk('public')->url($archive->snapshot_path)); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="fa-solid fa-download"></i>
                        عرض / تنزيل الملف
                    </a>

                </div>

            <?php else: ?>

                <div class="flex items-start gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-4">

                    <i class="fa-solid fa-circle-info mt-0.5 text-dim"></i>

                    <div>
                        <p class="text-xs font-bold">
                            لا يوجد ملف لقطة محفوظ
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-dim">
                            تم حفظ بيانات الأرشيف في قاعدة البيانات، لكن لم يتم ربط ملف لقطة تاريخية بهذا السجل.
                        </p>
                    </div>

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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/archives/show.blade.php ENDPATH**/ ?>