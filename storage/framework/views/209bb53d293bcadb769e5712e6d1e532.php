<?php $__env->startSection('title', 'وعود السداد'); ?>
<?php $__env->startSection('topbar-title', 'وعود السداد'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $promises ?? $promisesToPay ?? $items ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginal1de2d9a167cf552228534b52dfe24088 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de2d9a167cf552228534b52dfe24088 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.module-index','data' => ['title' => 'وعود السداد','subtitle' => 'متابعة تعهدات العملاء بالمبالغ والمواعيد ونتائج الوفاء.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-handshake','rows' => $records,'columns' => [['key'=>'debtCase.client.name','label'=>'العميل','type'=>'text'],['key'=>'debtCase.loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'user.name','label'=>'المحصل','type'=>'text'],['key'=>'promised_amount','label'=>'المبلغ الموعود','type'=>'money'],['key'=>'paid_amount','label'=>'المبلغ المدفوع','type'=>'money'],['key'=>'promise_date','label'=>'تاريخ الوعد','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']],'showRoute' => 'ptp.show','editRoute' => 'ptp.edit','createRoute' => 'ptp.create','search' => 'true','searchPlaceholder' => 'اسم العميل أو رقم القرض...','emptyTitle' => 'لا توجد وعود سداد','emptyDescription' => 'ستظهر الوعود المسجلة مع المبلغ والموعد وحالة الالتزام هنا.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'وعود السداد','subtitle' => 'متابعة تعهدات العملاء بالمبالغ والمواعيد ونتائج الوفاء.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-handshake','rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['key'=>'debtCase.client.name','label'=>'العميل','type'=>'text'],['key'=>'debtCase.loan_number','label'=>'رقم القرض','type'=>'mono'],['key'=>'user.name','label'=>'المحصل','type'=>'text'],['key'=>'promised_amount','label'=>'المبلغ الموعود','type'=>'money'],['key'=>'paid_amount','label'=>'المبلغ المدفوع','type'=>'money'],['key'=>'promise_date','label'=>'تاريخ الوعد','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']]),'show-route' => 'ptp.show','edit-route' => 'ptp.edit','create-route' => 'ptp.create','search' => 'true','search-placeholder' => 'اسم العميل أو رقم القرض...','empty-title' => 'لا توجد وعود سداد','empty-description' => 'ستظهر الوعود المسجلة مع المبلغ والموعد وحالة الالتزام هنا.']); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/ptp/index.blade.php ENDPATH**/ ?>