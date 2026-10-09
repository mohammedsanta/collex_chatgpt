<?php $__env->startSection('title', 'أنواع القروض'); ?>
<?php $__env->startSection('topbar-title', 'أنواع القروض'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $loanTypes ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'أنواع القروض','subtitle' => 'إدارة التصنيفات المستخدمة عند تسجيل القضايا والملفات المالية.','eyebrow' => 'إعدادات النظام','icon' => 'fa-list-check','rows' => $records,'columns' => [['key'=>'name','label'=>'نوع القرض','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']],'editRoute' => 'loan-types.edit','createRoute' => 'loan-types.create','search' => 'true','searchPlaceholder' => 'اسم نوع القرض...','emptyTitle' => 'لا توجد أنواع قروض','emptyDescription' => 'أضف أنواع القروض المستخدمة لتوحيد تصنيف القضايا.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'أنواع القروض','subtitle' => 'إدارة التصنيفات المستخدمة عند تسجيل القضايا والملفات المالية.','eyebrow' => 'إعدادات النظام','icon' => 'fa-list-check','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'name','label'=>'نوع القرض','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']]),'edit-route' => 'loan-types.edit','create-route' => 'loan-types.create','search' => 'true','search-placeholder' => 'اسم نوع القرض...','empty-title' => 'لا توجد أنواع قروض','empty-description' => 'أضف أنواع القروض المستخدمة لتوحيد تصنيف القضايا.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loan-types/index.blade.php ENDPATH**/ ?>