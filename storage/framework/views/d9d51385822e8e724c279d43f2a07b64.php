<?php $__env->startSection('title', 'تسجيل دفعة'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'تسجيل دفعة جديدة','subtitle' => 'سجّل عملية تحصيل واربطها بالقضية الصحيحة مع بيانات مرجعية واضحة.','eyebrow' => 'المدفوعات / تسجيل','icon' => 'fa-circle-plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تسجيل دفعة جديدة','subtitle' => 'سجّل عملية تحصيل واربطها بالقضية الصحيحة مع بيانات مرجعية واضحة.','eyebrow' => 'المدفوعات / تسجيل','icon' => 'fa-circle-plus']); ?> <?php $__env->slot('actions', null, []); ?> <a href="<?php echo e(route('payments.index')); ?>" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> كل المدفوعات</a> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mx-auto max-w-4xl"><div class="mb-4 flex items-start gap-3 rounded-xl border border-info/20 bg-info/10 p-4 text-info"><i class="fa-solid fa-circle-info mt-0.5"></i><p class="text-[10px] leading-6">سيتم إنشاء الدفعة بحالة <strong>قيد المراجعة</strong>. لن تدخل في إجمالي التحصيل المؤكد إلا بعد اعتمادها.</p></div><?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'بيانات عملية التحصيل','subtitle' => 'تأكد من المبلغ والقضية وتاريخ السداد','icon' => 'fa-money-bill-wave']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'بيانات عملية التحصيل','subtitle' => 'تأكد من المبلغ والقضية وتاريخ السداد','icon' => 'fa-money-bill-wave']); ?><form method="POST" action="<?php echo e(route('payments.store')); ?>"><?php echo $__env->make('payments._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></form> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/payments/create.blade.php ENDPATH**/ ?>