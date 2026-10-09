<?php $__env->startSection('title', 'الموظفون'); ?>
<?php $__env->startSection('topbar-title', 'الموظفون'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $employees ?? $users ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'الموظفون','subtitle' => 'دليل فريق العمل ومتابعة الأدوار والمشرفين وحالة الحساب.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-user-group','rows' => $records,'columns' => [['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'الاسم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'supervisor.name','label'=>'المشرف','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']],'showRoute' => 'employees.show','editRoute' => 'users.edit','search' => 'true','searchPlaceholder' => 'اسم الموظف أو الكود...','emptyTitle' => 'لا يوجد موظفون','emptyDescription' => 'ستظهر بيانات أعضاء الفريق وحالة حساباتهم هنا.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الموظفون','subtitle' => 'دليل فريق العمل ومتابعة الأدوار والمشرفين وحالة الحساب.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-user-group','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'الاسم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'supervisor.name','label'=>'المشرف','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']]),'show-route' => 'employees.show','edit-route' => 'users.edit','search' => 'true','search-placeholder' => 'اسم الموظف أو الكود...','empty-title' => 'لا يوجد موظفون','empty-description' => 'ستظهر بيانات أعضاء الفريق وحالة حساباتهم هنا.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/employees/index.blade.php ENDPATH**/ ?>