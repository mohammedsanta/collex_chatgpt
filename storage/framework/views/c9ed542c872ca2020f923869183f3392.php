<?php $__env->startSection('title', 'وعود السداد'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'وعود السداد','subtitle' => 'متابعة الوعود المسجلة لعملاء البنك وحالة الالتزام بها.','eyebrow' => 'banks','icon' => 'fa-handshake','rows' => $promises ?? $items ?? collect(),'columns' => [['key' => 'debtCase.client.name', 'label' => 'العميل', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'money'], ['key' => 'paid_amount', 'label' => 'المبلغ المدفوع', 'type' => 'money'], ['key' => 'promise_date', 'label' => 'تاريخ الوعد', 'type' => 'date'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']],'createRoute' => 'banks.ptp.create','showRoute' => 'banks.ptp.show','search' => 'true','searchPlaceholder' => 'ابحث بالاسم أو الكود...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'وعود السداد','subtitle' => 'متابعة الوعود المسجلة لعملاء البنك وحالة الالتزام بها.','eyebrow' => 'banks','icon' => 'fa-handshake','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($promises ?? $items ?? collect()),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key' => 'debtCase.client.name', 'label' => 'العميل', 'type' => 'text'], ['key' => 'promised_amount', 'label' => 'المبلغ الموعود', 'type' => 'money'], ['key' => 'paid_amount', 'label' => 'المبلغ المدفوع', 'type' => 'money'], ['key' => 'promise_date', 'label' => 'تاريخ الوعد', 'type' => 'date'], ['key' => 'status', 'label' => 'الحالة', 'type' => 'status']]),'create-route' => 'banks.ptp.create','show-route' => 'banks.ptp.show','search' => 'true','search-placeholder' => 'ابحث بالاسم أو الكود...']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/ptp/index.blade.php ENDPATH**/ ?>