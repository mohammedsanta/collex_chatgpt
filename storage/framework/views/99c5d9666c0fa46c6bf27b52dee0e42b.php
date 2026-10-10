<?php $__env->startSection('title', 'تعديل نوع القرض'); ?>
<?php $__env->startSection('content'); ?>
<?php
$formFields = [['name' => 'name', 'label' => 'اسم نوع القرض', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'is_active', 'label' => 'نوع القرض فعال', 'type' => 'checkbox', 'required' => false, 'full' => false]];
?>
<?php if (isset($component)) { $__componentOriginale6b10d29baeb7b12105a4d7827ab65d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-form','data' => ['title' => 'تعديل نوع القرض','subtitle' => 'تحديث اسم التصنيف وحالته.','icon' => 'fa-list-check','fields' => $formFields,'actionRoute' => 'loan-types.update','backRoute' => 'loan-types.index','record' => $loanType ?? $record ?? null,'editing' => true,'submitLabel' => 'حفظ التعديلات']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تعديل نوع القرض','subtitle' => 'تحديث اسم التصنيف وحالته.','icon' => 'fa-list-check','fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formFields),'action-route' => 'loan-types.update','back-route' => 'loan-types.index','record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loanType ?? $record ?? null),'editing' => true,'submit-label' => 'حفظ التعديلات']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6)): ?>
<?php $attributes = $__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6; ?>
<?php unset($__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale6b10d29baeb7b12105a4d7827ab65d6)): ?>
<?php $component = $__componentOriginale6b10d29baeb7b12105a4d7827ab65d6; ?>
<?php unset($__componentOriginale6b10d29baeb7b12105a4d7827ab65d6); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loan-types/edit.blade.php ENDPATH**/ ?>