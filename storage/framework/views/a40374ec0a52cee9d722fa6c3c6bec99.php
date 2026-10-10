<?php $__env->startSection('title', 'القضايا والقروض'); ?>
<?php $__env->startSection('topbar-title', 'القضايا والقروض'); ?>
<?php $__env->startSection('content'); ?>
<?php ($cases = $debtCases ?? $loans ?? $cases ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'القضايا والقروض','subtitle' => 'ملفات المديونية وحالة التحصيل والرصيد المتبقي لكل قضية.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-file-invoice-dollar','rows' => $cases,'columns' => [['key'=>'loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'client.name','label'=>'العميل','type'=>'text'],['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'overdue_amount','label'=>'المتأخر','type'=>'money'],['key'=>'collected_amount','label'=>'المحصل','type'=>'money'],['key'=>'dpd','label'=>'أيام التأخير','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']],'showRoute' => 'loans.show','editRoute' => 'loans.edit','createRoute' => 'loans.create','search' => 'true','searchPlaceholder' => 'رقم القرض أو اسم العميل...','emptyTitle' => 'لا توجد قضايا','emptyDescription' => 'عند استيراد محفظة أو تسجيل قضية ستظهر السجلات هنا.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'القضايا والقروض','subtitle' => 'ملفات المديونية وحالة التحصيل والرصيد المتبقي لكل قضية.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-file-invoice-dollar','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cases),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'client.name','label'=>'العميل','type'=>'text'],['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'overdue_amount','label'=>'المتأخر','type'=>'money'],['key'=>'collected_amount','label'=>'المحصل','type'=>'money'],['key'=>'dpd','label'=>'أيام التأخير','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']]),'show-route' => 'loans.show','edit-route' => 'loans.edit','create-route' => 'loans.create','search' => 'true','search-placeholder' => 'رقم القرض أو اسم العميل...','empty-title' => 'لا توجد قضايا','empty-description' => 'عند استيراد محفظة أو تسجيل قضية ستظهر السجلات هنا.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/loans/index.blade.php ENDPATH**/ ?>