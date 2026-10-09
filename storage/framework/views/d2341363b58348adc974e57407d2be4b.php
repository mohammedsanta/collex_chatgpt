<?php $__env->startSection('title', 'شركات التقسيط'); ?>
<?php $__env->startSection('topbar-title', 'شركات التقسيط'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $companies ?? $installmentCompanies ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'شركات التقسيط','subtitle' => 'إدارة الجهات التمويلية وبياناتها الأساسية وحالة الربط.','eyebrow' => 'المحافظ والمؤسسات','icon' => 'fa-shop','rows' => $records,'columns' => [['key'=>'name','label'=>'اسم الشركة','type'=>'text'],['key'=>'code','label'=>'الكود','type'=>'mono'],['key'=>'sector','label'=>'القطاع','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']],'showRoute' => 'installment-companies.show','editRoute' => 'installment-companies.edit','createRoute' => 'installment-companies.create','search' => 'true','searchPlaceholder' => 'اسم الشركة أو الكود...','emptyTitle' => 'لا توجد شركات تقسيط','emptyDescription' => 'أضف شركة تقسيط لبدء ربط المحافظ والقضايا بها.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'شركات التقسيط','subtitle' => 'إدارة الجهات التمويلية وبياناتها الأساسية وحالة الربط.','eyebrow' => 'المحافظ والمؤسسات','icon' => 'fa-shop','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'name','label'=>'اسم الشركة','type'=>'text'],['key'=>'code','label'=>'الكود','type'=>'mono'],['key'=>'sector','label'=>'القطاع','type'=>'text'],['key'=>'is_active','label'=>'الحالة','type'=>'boolean'],['key'=>'created_at','label'=>'تاريخ الإضافة','type'=>'date']]),'show-route' => 'installment-companies.show','edit-route' => 'installment-companies.edit','create-route' => 'installment-companies.create','search' => 'true','search-placeholder' => 'اسم الشركة أو الكود...','empty-title' => 'لا توجد شركات تقسيط','empty-description' => 'أضف شركة تقسيط لبدء ربط المحافظ والقضايا بها.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/installment-companies/index.blade.php ENDPATH**/ ?>