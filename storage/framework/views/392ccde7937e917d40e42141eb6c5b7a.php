<?php $__env->startSection('title', 'إعدادات النظام'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'إعدادات النظام','subtitle' => 'إدارة القيم التشغيلية التي تتحكم في سلوك النظام.','eyebrow' => 'تهيئة النظام','icon' => 'fa-sliders']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'إعدادات النظام','subtitle' => 'إدارة القيم التشغيلية التي تتحكم في سلوك النظام.','eyebrow' => 'تهيئة النظام','icon' => 'fa-sliders']); ?> <?php $__env->slot('actions', null, []); ?> <span class="inline-flex items-center gap-2 rounded-xl border border-line bg-surface px-3 py-2 text-[10px] font-bold text-muted"><i class="fa-solid fa-shield-halved text-brand"></i> صلاحيات الإدارة</span> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mb-5 flex items-start gap-3 rounded-xl border border-info/20 bg-info/10 p-4 text-info"><i class="fa-solid fa-circle-info mt-0.5"></i><p class="text-[10px] leading-6">عدّل الإعدادات بعناية؛ بعض القيم قد تؤثر على سلوك العمليات والتقارير. لا تحفظ بيانات حساسة مثل كلمات المرور كنص صريح.</p></div>
<form method="POST" action="<?php echo e(route('settings.update')); ?>" class="space-y-5"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<?php $__empty_1 = true; $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => str_replace('_',' ',ucfirst($group)),'subtitle' => 'الإعدادات المصنفة ضمن هذه المجموعة','icon' => 'fa-gear']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(str_replace('_',' ',ucfirst($group))),'subtitle' => 'الإعدادات المصنفة ضمن هذه المجموعة','icon' => 'fa-gear']); ?><div class="grid gap-x-5 gap-y-4 md:grid-cols-2"><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label class="block"><span class="app-label"><?php echo e($setting->label ?? str_replace('_',' ',ucfirst($setting->key))); ?></span><?php if(($setting->type ?? '') === 'boolean'): ?><select name="settings[<?php echo e($setting->key); ?>]" class="app-input"><option value="1" <?php if(old('settings.'.$setting->key, $setting->value) == '1'): echo 'selected'; endif; ?>>مفعّل</option><option value="0" <?php if(old('settings.'.$setting->key, $setting->value) == '0'): echo 'selected'; endif; ?>>معطّل</option></select><?php elseif(($setting->type ?? '') === 'text'): ?><textarea name="settings[<?php echo e($setting->key); ?>]" class="app-input" rows="3"><?php echo e(old('settings.'.$setting->key, $setting->value)); ?></textarea><?php else: ?><input name="settings[<?php echo e($setting->key); ?>]" value="<?php echo e(old('settings.'.$setting->key, $setting->value)); ?>" class="app-input" maxlength="5000" <?php if(($setting->type ?? '') === 'integer'): ?> inputmode="numeric" <?php endif; ?>><?php endif; ?><span class="app-help">المفتاح: <code><?php echo e($setting->key); ?></code> · النوع: <?php echo e($setting->type ?? 'text'); ?></span></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'لا توجد إعدادات','icon' => 'fa-gear']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'لا توجد إعدادات','icon' => 'fa-gear']); ?><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'لم يتم إعداد أي قيم بعد','description' => 'أضف سجلات الإعدادات من خلال أدوات التهيئة المعتمدة.','icon' => 'fa-sliders']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'لم يتم إعداد أي قيم بعد','description' => 'أضف سجلات الإعدادات من خلال أدوات التهيئة المعتمدة.','icon' => 'fa-sliders']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php endif; ?>
<div class="flex flex-wrap items-center gap-3"><button class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> حفظ التغييرات</button><span class="text-[10px] text-dim">تُطبّق التغييرات بعد نجاح التحقق والحفظ.</span></div></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/settings/index.blade.php ENDPATH**/ ?>