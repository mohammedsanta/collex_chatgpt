<?php $__env->startSection('title', 'المدفوعات'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'المدفوعات','subtitle' => 'سجل عمليات التحصيل وحالات التأكيد والرفض.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-money-bill-transfer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'المدفوعات','subtitle' => 'سجل عمليات التحصيل وحالات التأكيد والرفض.','eyebrow' => 'إدارة التحصيل','icon' => 'fa-money-bill-transfer']); ?> <?php $__env->slot('actions', null, []); ?> <a href="<?php echo e(route('payments.confirmations')); ?>" class="app-btn app-btn-secondary"><i class="fa-solid fa-clock"></i> مراجعة المعلّق</a><a href="<?php echo e(route('payments.create')); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-plus"></i> تسجيل دفعة</a> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mb-5 grid gap-3 sm:grid-cols-3"><div class="app-card flex items-center gap-3 p-4"><span class="grid h-10 w-10 place-items-center rounded-xl bg-warning/10 text-warning"><i class="fa-solid fa-hourglass-half"></i></span><div><p class="text-[10px] font-bold text-dim">قيد المراجعة</p><p class="mt-1 text-lg font-extrabold"><?php echo e(isset($payments) ? $payments->where('status','pending')->count() : 0); ?></p></div></div><div class="app-card flex items-center gap-3 p-4"><span class="grid h-10 w-10 place-items-center rounded-xl bg-brand/10 text-brand"><i class="fa-solid fa-circle-check"></i></span><div><p class="text-[10px] font-bold text-dim">مؤكدة في الصفحة الحالية</p><p class="mt-1 text-lg font-extrabold"><?php echo e(isset($payments) ? $payments->where('status','confirmed')->count() : 0); ?></p></div></div><div class="app-card flex items-center gap-3 p-4"><span class="grid h-10 w-10 place-items-center rounded-xl bg-danger/10 text-danger"><i class="fa-solid fa-circle-xmark"></i></span><div><p class="text-[10px] font-bold text-dim">مرفوضة في الصفحة الحالية</p><p class="mt-1 text-lg font-extrabold"><?php echo e(isset($payments) ? $payments->where('status','rejected')->count() : 0); ?></p></div></div></div>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'سجل المدفوعات','subtitle' => 'صفِّ حسب الحالة أو افتح تفاصيل أي إيصال','icon' => 'fa-receipt','padding' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'سجل المدفوعات','subtitle' => 'صفِّ حسب الحالة أو افتح تفاصيل أي إيصال','icon' => 'fa-receipt','padding' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php $__env->slot('actions', null, []); ?> <form method="GET" action="<?php echo e(route('payments.index')); ?>" class="flex flex-wrap gap-2"><select name="status" class="app-input min-w-[150px]"><option value="">كل الحالات</option><?php $__currentLoopData = ['pending'=>'قيد المراجعة','confirmed'=>'مؤكدة','rejected'=>'مرفوضة']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($value); ?>" <?php if(request('status')===$value): echo 'selected'; endif; ?>><?php echo e($label); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><button class="app-btn app-btn-secondary"><i class="fa-solid fa-filter"></i> تطبيق</button></form> <?php $__env->endSlot(); ?>
<div class="overflow-x-auto"><table class="app-table"><thead><tr><th>الإيصال</th><th>العميل / القضية</th><th>المحصل</th><th>المبلغ</th><th>طريقة الدفع</th><th>الحالة</th><th>تاريخ الدفع</th><th></th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td><span class="font-mono text-[10px] font-extrabold text-fg"><?php echo e($payment->receipt_number); ?></span></td><td><p class="text-xs font-extrabold"><?php echo e($payment->debtCase?->client?->name ?? '—'); ?></p><p class="mt-1 text-[9px] text-dim"><?php echo e($payment->debtCase?->loan_number ?? ('قضية #'.$payment->debt_case_id)); ?></p></td><td><?php echo e($payment->collector?->name ?? '—'); ?></td><td class="whitespace-nowrap font-extrabold"><?php echo e(number_format((float)$payment->amount,2)); ?> <small class="text-dim">ج.م</small></td><td><?php echo e(['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك'][$payment->method] ?? $payment->method); ?></td><td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $payment->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td><td class="whitespace-nowrap text-muted"><?php echo e($payment->paid_at?->format('Y-m-d H:i') ?? '—'); ?></td><td><?php if (isset($component)) { $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-icon','data' => ['href' => route('payments.show',$payment),'icon' => 'fa-eye','label' => 'تفاصيل','tone' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('payments.show',$payment)),'icon' => 'fa-eye','label' => 'تفاصيل','tone' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $attributes = $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $component = $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="8"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'لا توجد مدفوعات','description' => 'لم يتم العثور على مدفوعات مطابقة لعوامل التصفية.','icon' => 'fa-receipt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'لا توجد مدفوعات','description' => 'لم يتم العثور على مدفوعات مطابقة لعوامل التصفية.','icon' => 'fa-receipt']); ?> <?php $__env->slot('action', null, []); ?> <a href="<?php echo e(route('payments.create')); ?>" class="app-btn app-btn-primary">تسجيل دفعة</a> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></td></tr><?php endif; ?></tbody></table></div>
<?php if(method_exists($payments,'links')): ?><div class="flex flex-wrap items-center justify-between gap-3 border-t border-line px-5 py-4"><p class="text-[10px] text-dim"><?php echo e($payments->total()); ?> سجل · الصفحة <?php echo e($payments->currentPage()); ?> من <?php echo e($payments->lastPage()); ?></p><?php echo e($payments->links()); ?></div><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/payments/index.blade.php ENDPATH**/ ?>