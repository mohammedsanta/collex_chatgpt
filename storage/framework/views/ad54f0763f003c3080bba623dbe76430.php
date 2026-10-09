<?php $__env->startSection('title', 'سجل النشاط'); ?>
<?php $__env->startSection('topbar-title', 'سجل النشاط'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $logs ?? $activityLogs ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'سجل النشاط','subtitle' => 'سجل تدقيقي للأحداث المهمة والتغييرات التي جرت داخل النظام.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-clock-rotate-left','rows' => $records,'columns' => [['key'=>'created_at','label'=>'التوقيت','type'=>'date'],['key'=>'user.name','label'=>'المستخدم','type'=>'text'],['key'=>'event','label'=>'الحدث','type'=>'text'],['key'=>'description','label'=>'الوصف','type'=>'text'],['key'=>'ip_address','label'=>'عنوان IP','type'=>'mono']],'search' => 'true','searchPlaceholder' => 'المستخدم أو الحدث...','emptyTitle' => 'لا توجد أحداث مسجلة','emptyDescription' => 'ستظهر الأحداث بعد تفعيل تسجيل النشاط في العمليات ذات الصلة.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'سجل النشاط','subtitle' => 'سجل تدقيقي للأحداث المهمة والتغييرات التي جرت داخل النظام.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-clock-rotate-left','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'created_at','label'=>'التوقيت','type'=>'date'],['key'=>'user.name','label'=>'المستخدم','type'=>'text'],['key'=>'event','label'=>'الحدث','type'=>'text'],['key'=>'description','label'=>'الوصف','type'=>'text'],['key'=>'ip_address','label'=>'عنوان IP','type'=>'mono']]),'search' => 'true','search-placeholder' => 'المستخدم أو الحدث...','empty-title' => 'لا توجد أحداث مسجلة','empty-description' => 'ستظهر الأحداث بعد تفعيل تسجيل النشاط في العمليات ذات الصلة.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/activity-logs/index.blade.php ENDPATH**/ ?>