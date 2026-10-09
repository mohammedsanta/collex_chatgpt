<?php $__env->startSection('title', 'تسجيل شكوى'); ?>
<?php $__env->startSection('content'); ?>
<?php
$formFields = [['name' => 'subject', 'label' => 'موضوع الشكوى', 'type' => 'text', 'required' => true, 'full' => false],
        ['name' => 'description', 'label' => 'تفاصيل الشكوى', 'type' => 'textarea', 'required' => true, 'full' => true],
        ['name' => 'source', 'label' => 'مصدر الشكوى', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['phone' => 'هاتف', 'whatsapp' => 'واتساب', 'email' => 'بريد إلكتروني', 'bank' => 'البنك', 'visit' => 'زيارة ميدانية']],
        ['name' => 'priority', 'label' => 'الأولوية', 'type' => 'select', 'required' => false, 'full' => false, 'options' => ['low' => 'منخفضة', 'medium' => 'متوسطة', 'high' => 'عالية', 'urgent' => 'عاجلة']],
        ['name' => 'due_at', 'label' => 'موعد الاستحقاق', 'type' => 'date', 'required' => false, 'full' => false]];
?>
<?php if (isset($component)) { $__componentOriginale6b10d29baeb7b12105a4d7827ab65d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6b10d29baeb7b12105a4d7827ab65d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-form','data' => ['title' => 'تسجيل شكوى','subtitle' => 'سجل الشكوى وحدد الأولوية والجهة المسؤولة.','icon' => 'fa-message','fields' => $formFields,'actionRoute' => 'banks.complaints.store','backRoute' => 'banks.complaints.index','record' => $bank ?? $record ?? null,'editing' => false,'submitLabel' => 'إنشاء السجل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تسجيل شكوى','subtitle' => 'سجل الشكوى وحدد الأولوية والجهة المسؤولة.','icon' => 'fa-message','fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formFields),'action-route' => 'banks.complaints.store','back-route' => 'banks.complaints.index','record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bank ?? $record ?? null),'editing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'submit-label' => 'إنشاء السجل']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/complaints/create.blade.php ENDPATH**/ ?>