<?php $__env->startSection('title', 'جدولة زيارة ميدانية'); ?>
<?php $__env->startSection('content'); ?>
<?php
$formFields = [['name' => 'debt_case_id', 'label' => 'رقم القضية', 'type' => 'number', 'required' => true, 'full' => false],
        ['name' => 'scheduled_at', 'label' => 'موعد الزيارة', 'type' => 'datetime-local', 'required' => true, 'full' => false],
        ['name' => 'address', 'label' => 'عنوان الزيارة', 'type' => 'text', 'required' => false, 'full' => true],
        ['name' => 'notes', 'label' => 'ملاحظات للمحصل', 'type' => 'textarea', 'required' => false, 'full' => true]];
?>
<?php if (isset($component)) { $__componentOriginale6b10d29baeb7b12105a4d7827ab65d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-form','data' => ['title' => 'جدولة زيارة ميدانية','subtitle' => 'حدد القضية والموعد والبيانات المتاحة للزيارة.','icon' => 'fa-location-dot','fields' => $formFields,'actionRoute' => 'banks.visits.store','backRoute' => 'banks.visits.index','record' => $bank ?? $record ?? null,'editing' => false,'submitLabel' => 'إنشاء السجل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'جدولة زيارة ميدانية','subtitle' => 'حدد القضية والموعد والبيانات المتاحة للزيارة.','icon' => 'fa-location-dot','fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formFields),'action-route' => 'banks.visits.store','back-route' => 'banks.visits.index','record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bank ?? $record ?? null),'editing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'submit-label' => 'إنشاء السجل']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/visits/create.blade.php ENDPATH**/ ?>