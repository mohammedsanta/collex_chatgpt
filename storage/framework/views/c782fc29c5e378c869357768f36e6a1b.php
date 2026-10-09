<?php $__env->startSection('title', 'تقارير التحصيل اليومية'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'تقارير التحصيل اليومية','subtitle' => 'إدارة التقارير اليومية المرسلة من فريق التحصيل.','eyebrow' => 'banks','icon' => 'fa-calendar-check','rows' => $reports ?? $items ?? collect(),'columns' => [['key' => 'user.name', 'label' => 'الموظف', 'type' => 'text'], ['key' => 'report_date', 'label' => 'التاريخ', 'type' => 'date'], ['key' => 'cases_worked', 'label' => 'القضايا', 'type' => 'text'], ['key' => 'calls_count', 'label' => 'المكالمات', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'الموعود', 'type' => 'money'], ['key' => 'collected_amount', 'label' => 'المحصل', 'type' => 'money'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']],'createRoute' => 'banks.dcr.create','search' => 'true','searchPlaceholder' => 'ابحث بالاسم أو الكود...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تقارير التحصيل اليومية','subtitle' => 'إدارة التقارير اليومية المرسلة من فريق التحصيل.','eyebrow' => 'banks','icon' => 'fa-calendar-check','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($reports ?? $items ?? collect()),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key' => 'user.name', 'label' => 'الموظف', 'type' => 'text'], ['key' => 'report_date', 'label' => 'التاريخ', 'type' => 'date'], ['key' => 'cases_worked', 'label' => 'القضايا', 'type' => 'text'], ['key' => 'calls_count', 'label' => 'المكالمات', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'الموعود', 'type' => 'money'], ['key' => 'collected_amount', 'label' => 'المحصل', 'type' => 'money'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']]),'create-route' => 'banks.dcr.create','search' => 'true','search-placeholder' => 'ابحث بالاسم أو الكود...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1de2d9a167cf552228534b52dfe24088)): ?>
<?php $attributes = $__attributesOriginal1de2d9a167cf552228534b52dfe24088; ?>
<?php unset($__attributesOriginal1de2d9a167cf552228534b52dfe24088); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1de2d9a167cf552228534b52dfe24088)): ?>
<?php $component = $__componentOriginal1de2d9a167cf552228534b52dfe24088; ?>
<?php unset($__componentOriginal1de2d9a167cf552228534b52dfe24088); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/dcr/index.blade.php ENDPATH**/ ?>