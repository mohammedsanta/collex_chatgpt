<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group', 'rows' => [], 'columns' => [], 'createRoute' => null, 'showRoute' => null, 'editRoute' => null, 'search' => false, 'searchName' => 'q', 'searchPlaceholder' => 'ابحث في السجلات...', 'emptyTitle' => 'لا توجد سجلات', 'emptyDescription' => 'لا توجد بيانات مطابقة لعوامل البحث.', 'createLabel' => 'إضافة سجل']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group', 'rows' => [], 'columns' => [], 'createRoute' => null, 'showRoute' => null, 'editRoute' => null, 'search' => false, 'searchName' => 'q', 'searchPlaceholder' => 'ابحث في السجلات...', 'emptyTitle' => 'لا توجد سجلات', 'emptyDescription' => 'لا توجد بيانات مطابقة لعوامل البحث.', 'createLabel' => 'إضافة سجل']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => $title,'subtitle' => $subtitle,'eyebrow' => $eyebrow,'icon' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtitle),'eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($eyebrow),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?> <?php $__env->slot('actions', null, []); ?> <?php if($createRoute && \Illuminate\Support\Facades\Route::has($createRoute)): ?><a href="<?php echo e(route($createRoute)); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-plus"></i> <?php echo e($createLabel); ?></a><?php endif; ?> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => $title,'subtitle' => 'استعراض السجلات والبحث والتصفية','icon' => $icon,'padding' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => 'استعراض السجلات والبحث والتصفية','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'padding' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php $__env->slot('actions', null, []); ?> <?php if($search): ?><form method="GET" class="flex flex-wrap gap-2"><div class="relative"><i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-dim"></i><input class="app-input min-w-[190px] pr-8 sm:w-64" name="<?php echo e($searchName); ?>" value="<?php echo e(request($searchName)); ?>" placeholder="<?php echo e($searchPlaceholder); ?>"></div><button class="app-btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> بحث</button><?php if(request()->filled($searchName)): ?><a class="app-btn app-btn-ghost" href="<?php echo e(url()->current()); ?>">مسح</a><?php endif; ?></form><?php endif; ?> <?php $__env->endSlot(); ?>
<div class="overflow-x-auto"><table class="app-table"><thead><tr><?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><th><?php echo e($column['label'] ?? ''); ?></th><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>@if($showRoute || $editRoute)<th class="text-center">الإجراءات</th><?php endif; ?></tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr>
<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php ($value = data_get($row, $column['key'] ?? '')); ?><td>
<?php if(($column['type'] ?? '') === 'status'): ?><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $value ?? 'unknown']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value ?? 'unknown')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php elseif(($column['type'] ?? '') === 'money'): ?><span class="whitespace-nowrap font-extrabold text-fg"><?php echo e(number_format((float)($value ?? 0), 2)); ?> <small class="text-dim">ج.م</small></span>
<?php elseif(($column['type'] ?? '') === 'date'): ?><span class="whitespace-nowrap"><?php echo e(is_object($value) && method_exists($value, 'format') ? $value->format('Y-m-d') : ($value ?: '—')); ?></span>
<?php elseif(($column['type'] ?? '') === 'boolean'): ?><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $value ? 'active' : 'inactive']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value ? 'active' : 'inactive')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php elseif(($column['type'] ?? '') === 'mono'): ?><span class="font-mono text-[10px]"><?php echo e(is_scalar($value) && $value !== '' ? $value : '—'); ?></span>
<?php elseif($index === 0 && $showRoute && \Illuminate\Support\Facades\Route::has($showRoute)): ?><a href="<?php echo e(route($showRoute, $row)); ?>" class="font-extrabold text-fg hover:text-brand"><?php echo e(is_scalar($value) && $value !== '' ? $value : 'عرض السجل'); ?></a>
<?php else: ?><span><?php echo e(is_scalar($value) && $value !== '' ? $value : '—'); ?></span><?php endif; ?>
</td><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($showRoute || $editRoute): ?><td><div class="flex items-center justify-center gap-1"><?php if($showRoute && \Illuminate\Support\Facades\Route::has($showRoute)): ?><?php if (isset($component)) { $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-icon','data' => ['href' => route($showRoute, $row),'icon' => 'fa-eye','label' => 'عرض','tone' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route($showRoute, $row)),'icon' => 'fa-eye','label' => 'عرض','tone' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $attributes = $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $component = $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?><?php endif; ?> <?php if($editRoute && \Illuminate\Support\Facades\Route::has($editRoute)): ?><?php if (isset($component)) { $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-icon','data' => ['href' => route($editRoute, $row),'icon' => 'fa-pen','label' => 'تعديل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route($editRoute, $row)),'icon' => 'fa-pen','label' => 'تعديل']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $attributes = $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $component = $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?><?php endif; ?></div></td><?php endif; ?>
</tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="<?php echo e(max(1, count($columns) + (($showRoute || $editRoute) ? 1 : 0))); ?>"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => $emptyTitle,'description' => $emptyDescription,'icon' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($emptyTitle),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($emptyDescription),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></td></tr><?php endif; ?>
</tbody></table></div>
<?php if(is_object($rows) && method_exists($rows, 'links')): ?><div class="border-t border-line px-5 py-4"><?php echo e($rows->links()); ?></div><?php endif; ?>
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
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/module-index.blade.php ENDPATH**/ ?>