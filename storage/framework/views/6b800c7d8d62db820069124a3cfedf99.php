<?php $__env->startSection('title', 'الأدوار والصلاحيات'); ?>
<?php $__env->startSection('topbar-title', 'الأدوار والصلاحيات'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $roles ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'الأدوار والصلاحيات','subtitle' => 'تعريف أدوار النظام ومستويات الوصول بما يحقق مبدأ أقل صلاحية لازمة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-shield-halved','rows' => $records,'columns' => [['key'=>'label','label'=>'اسم الدور','type'=>'text'],['key'=>'name','label'=>'المعرّف','type'=>'mono'],['key'=>'level','label'=>'مستوى الوصول','type'=>'text'],['key'=>'users_count','label'=>'عدد المستخدمين','type'=>'text'],['key'=>'is_system','label'=>'دور نظامي','type'=>'boolean']],'showRoute' => 'roles.edit','editRoute' => 'roles.edit','createRoute' => 'roles.create','search' => 'true','searchPlaceholder' => 'اسم الدور أو المعرّف...','emptyTitle' => 'لا توجد أدوار','emptyDescription' => 'أنشئ الأدوار الأساسية ثم اربط كل دور بالصلاحيات التي يحتاجها فقط.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الأدوار والصلاحيات','subtitle' => 'تعريف أدوار النظام ومستويات الوصول بما يحقق مبدأ أقل صلاحية لازمة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-shield-halved','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'label','label'=>'اسم الدور','type'=>'text'],['key'=>'name','label'=>'المعرّف','type'=>'mono'],['key'=>'level','label'=>'مستوى الوصول','type'=>'text'],['key'=>'users_count','label'=>'عدد المستخدمين','type'=>'text'],['key'=>'is_system','label'=>'دور نظامي','type'=>'boolean']]),'show-route' => 'roles.edit','edit-route' => 'roles.edit','create-route' => 'roles.create','search' => 'true','search-placeholder' => 'اسم الدور أو المعرّف...','empty-title' => 'لا توجد أدوار','empty-description' => 'أنشئ الأدوار الأساسية ثم اربط كل دور بالصلاحيات التي يحتاجها فقط.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/roles/index.blade.php ENDPATH**/ ?>