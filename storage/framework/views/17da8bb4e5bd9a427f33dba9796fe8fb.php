<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'subtitle' => null, 'icon' => 'fa-pen-to-square', 'fields' => [], 'actionRoute' => null, 'backRoute' => null, 'record' => null, 'editing' => false, 'submitLabel' => 'حفظ البيانات']));

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

foreach (array_filter((['title', 'subtitle' => null, 'icon' => 'fa-pen-to-square', 'fields' => [], 'actionRoute' => null, 'backRoute' => null, 'record' => null, 'editing' => false, 'submitLabel' => 'حفظ البيانات']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php ($actionExists = $actionRoute && \Illuminate\Support\Facades\Route::has($actionRoute)); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => $title,'subtitle' => $subtitle,'eyebrow' => 'إدارة البيانات','icon' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtitle),'eyebrow' => 'إدارة البيانات','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?> <?php $__env->slot('actions', null, []); ?> <?php if($backRoute && \Illuminate\Support\Facades\Route::has($backRoute)): ?><a href="<?php echo e(route($backRoute)); ?>" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> العودة للقائمة</a><?php endif; ?> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mx-auto max-w-4xl"><?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => $title,'subtitle' => 'أدخل البيانات المطلوبة ثم راجعها قبل الحفظ','icon' => $icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => 'أدخل البيانات المطلوبة ثم راجعها قبل الحفظ','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon)]); ?><form method="POST" action="<?php echo e($actionExists ? ($editing ? route($actionRoute, $record) : route($actionRoute)) : '#'); ?>"><?php echo csrf_field(); ?> <?php if($editing): ?><?php echo method_field('PUT'); ?><?php endif; ?>
<div class="grid gap-x-5 gap-y-4 md:grid-cols-2"><?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php ($fieldName = $field['name']); ?><?php ($fieldValue = old($fieldName, data_get($record, $fieldName))); ?><div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['md:col-span-2' => ($field['full'] ?? false)]); ?>">
<?php if(($field['type'] ?? 'text') === 'textarea'): ?><?php if (isset($component)) { $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea-field','data' => ['label' => $field['label'],'name' => $fieldName,'value' => $fieldValue,'required' => $field['required'] ?? false,'rows' => $field['rows'] ?? 4,'placeholder' => $field['placeholder'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['label']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldName),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldValue),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['required'] ?? false),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['rows'] ?? 4),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['placeholder'] ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $attributes = $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $component = $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?>
<?php elseif(($field['type'] ?? '') === 'select'): ?><?php if (isset($component)) { $__componentOriginala2fbd5dd19e5d391186efe67b2f11409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-field','data' => ['label' => $field['label'],'name' => $fieldName,'value' => $fieldValue,'options' => $field['options'] ?? [],'required' => $field['required'] ?? false,'placeholder' => $field['placeholder'] ?? 'اختر...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['label']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldName),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldValue),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['options'] ?? []),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['required'] ?? false),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['placeholder'] ?? 'اختر...')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $attributes = $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $component = $__componentOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
<?php elseif(($field['type'] ?? '') === 'checkbox'): ?><label class="flex items-center gap-3 rounded-xl border border-line p-3"><input type="checkbox" name="<?php echo e($fieldName); ?>" value="1" <?php if((bool)$fieldValue): echo 'checked'; endif; ?> class="rounded border-line text-brand focus:ring-brand/30"><span class="text-[11px] font-bold"><?php echo e($field['label']); ?></span></label>
<?php else: ?><?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => $field['label'],'name' => $fieldName,'type' => $field['type'] ?? 'text','value' => $fieldValue,'required' => $field['required'] ?? false,'placeholder' => $field['placeholder'] ?? null,'help' => $field['help'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['label']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldName),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['type'] ?? 'text'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fieldValue),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['required'] ?? false),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['placeholder'] ?? null),'help' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($field['help'] ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?><?php endif; ?>
</div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
<div class="mt-7 flex flex-wrap items-center gap-2 border-t border-line pt-5"><?php if($actionExists): ?><button type="submit" class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> <?php echo e($submitLabel); ?></button><?php else: ?><button type="button" disabled class="app-btn cursor-not-allowed bg-surface-raised text-dim"><i class="fa-solid fa-link-slash"></i> الحفظ غير متاح حتى ربط المسار</button><?php endif; ?> <?php if($backRoute && \Illuminate\Support\Facades\Route::has($backRoute)): ?><a href="<?php echo e(route($backRoute)); ?>" class="app-btn app-btn-secondary">إلغاء</a><?php endif; ?></div>
<?php if(!$actionExists): ?><div class="mt-4 rounded-xl border border-warning/20 bg-warning/10 p-3 text-[10px] leading-5 text-warning"><i class="fa-solid fa-circle-info ml-1"></i> هذه الواجهة جاهزة بصريًا، لكن مسار الحفظ غير مسجل حاليًا في routes/web.php؛ تم تعطيل الإرسال لتجنب طلب غير صالح.</div><?php endif; ?>
</form> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/module-form.blade.php ENDPATH**/ ?>