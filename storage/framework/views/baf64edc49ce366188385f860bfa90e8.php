<?php $__env->startSection('title', 'المستخدمون'); ?>
<?php $__env->startSection('topbar-title', 'المستخدمون'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $users ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'المستخدمون','subtitle' => 'إدارة حسابات الدخول وربطها بالأدوار والمشرفين ومراجعة الحالة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-user-gear','rows' => $records,'columns' => [['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'اسم المستخدم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'last_login_at','label'=>'آخر دخول','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']],'showRoute' => 'users.show','editRoute' => 'users.edit','createRoute' => 'users.create','search' => 'true','searchPlaceholder' => 'اسم المستخدم أو البريد...','emptyTitle' => 'لا توجد حسابات مستخدمين','emptyDescription' => 'أنشئ حسابًا جديدًا وحدد له الدور والصلاحيات اللازمة.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'المستخدمون','subtitle' => 'إدارة حسابات الدخول وربطها بالأدوار والمشرفين ومراجعة الحالة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-user-gear','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'اسم المستخدم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'last_login_at','label'=>'آخر دخول','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']]),'show-route' => 'users.show','edit-route' => 'users.edit','create-route' => 'users.create','search' => 'true','search-placeholder' => 'اسم المستخدم أو البريد...','empty-title' => 'لا توجد حسابات مستخدمين','empty-description' => 'أنشئ حسابًا جديدًا وحدد له الدور والصلاحيات اللازمة.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/users/index.blade.php ENDPATH**/ ?>