<?php $__env->startSection('title', 'الأرشيف الشهري'); ?>
<?php $__env->startSection('topbar-title', 'الأرشيف الشهري'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $archives ?? $monthlyArchives ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'الأرشيف الشهري','subtitle' => 'استعراض اللقطات الشهرية للمحافظ وإجماليات الدين والتحصيل المؤرشفة.','eyebrow' => 'المحافظ والمؤسسات','icon' => 'fa-box-archive','rows' => $records,'columns' => [['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'year','label'=>'السنة','type'=>'text'],['key'=>'month','label'=>'الشهر','type'=>'text'],['key'=>'cases_count','label'=>'عدد القضايا','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'collected_amount','label'=>'إجمالي التحصيل','type'=>'money'],['key'=>'archived_at','label'=>'تاريخ الأرشفة','type'=>'date']],'showRoute' => 'archives.show','search' => 'true','searchPlaceholder' => 'البنك أو السنة...','emptyTitle' => 'لا توجد أرشيفات','emptyDescription' => 'ستظهر اللقطات الشهرية بعد إتمام عملية الأرشفة.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الأرشيف الشهري','subtitle' => 'استعراض اللقطات الشهرية للمحافظ وإجماليات الدين والتحصيل المؤرشفة.','eyebrow' => 'المحافظ والمؤسسات','icon' => 'fa-box-archive','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'bank.name','label'=>'البنك','type'=>'text'],['key'=>'year','label'=>'السنة','type'=>'text'],['key'=>'month','label'=>'الشهر','type'=>'text'],['key'=>'cases_count','label'=>'عدد القضايا','type'=>'text'],['key'=>'total_debt','label'=>'إجمالي الدين','type'=>'money'],['key'=>'collected_amount','label'=>'إجمالي التحصيل','type'=>'money'],['key'=>'archived_at','label'=>'تاريخ الأرشفة','type'=>'date']]),'show-route' => 'archives.show','search' => 'true','search-placeholder' => 'البنك أو السنة...','empty-title' => 'لا توجد أرشيفات','empty-description' => 'ستظهر اللقطات الشهرية بعد إتمام عملية الأرشفة.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/archives/index.blade.php ENDPATH**/ ?>