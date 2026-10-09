<?php $__env->startSection('title', 'مراجعة المدفوعات'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'مراجعة المدفوعات','subtitle' => 'راجع تفاصيل الإيصال قبل اعتماد التحصيل أو رفضه.','eyebrow' => 'التحكم المالي','icon' => 'fa-list-check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'مراجعة المدفوعات','subtitle' => 'راجع تفاصيل الإيصال قبل اعتماد التحصيل أو رفضه.','eyebrow' => 'التحكم المالي','icon' => 'fa-list-check']); ?> <?php $__env->slot('actions', null, []); ?> <a href="<?php echo e(route('payments.index')); ?>" class="app-btn app-btn-secondary"><i class="fa-solid fa-receipt"></i> سجل المدفوعات</a> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mb-5 flex items-start gap-3 rounded-xl border border-warning/20 bg-warning/10 p-4 text-warning"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-warning/15"><i class="fa-solid fa-hourglass-half"></i></span><div><p class="text-xs font-extrabold">الدفعات التي تحتاج إلى مراجعة</p><p class="mt-1 text-[10px] leading-5 text-warning">تحقق من المبلغ والقضية والمرجع قبل اتخاذ القرار. عملية التأكيد تؤثر في إجمالي التحصيل المسجل على القضية.</p></div></div>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'قائمة الانتظار','subtitle' => 'الدفعات المعلقة فقط','icon' => 'fa-clock','padding' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'قائمة الانتظار','subtitle' => 'الدفعات المعلقة فقط','icon' => 'fa-clock','padding' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?><div class="overflow-x-auto"><table class="app-table"><thead><tr><th>الإيصال</th><th>العميل والقضية</th><th>المحصل</th><th>المبلغ</th><th>طريقة الدفع</th><th>تاريخ الدفع</th><th class="text-center">الإجراء</th></tr></thead><tbody><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td><a href="<?php echo e(route('payments.show',$payment)); ?>" class="font-mono text-[10px] font-extrabold text-brand hover:underline"><?php echo e($payment->receipt_number); ?></a></td><td><p class="text-xs font-extrabold"><?php echo e($payment->debtCase?->client?->name ?? '—'); ?></p><p class="mt-1 text-[9px] text-dim">قضية #<?php echo e($payment->debt_case_id); ?> · قرض <?php echo e($payment->debtCase?->loan_number ?? '—'); ?></p></td><td><?php echo e($payment->collector?->name ?? '—'); ?></td><td class="whitespace-nowrap text-sm font-extrabold"><?php echo e(number_format((float)$payment->amount,2)); ?> <small class="text-[9px] text-dim">ج.م</small></td><td><?php echo e(['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك'][$payment->method] ?? $payment->method); ?></td><td class="whitespace-nowrap"><?php echo e($payment->paid_at?->format('Y-m-d H:i') ?? '—'); ?></td><td><div class="flex items-center justify-center gap-2"><form method="POST" action="<?php echo e(route('payments.confirm',$payment)); ?>" onsubmit="return confirm('تأكيد هذه الدفعة؟ سيتم تحديث إجمالي التحصيل.')"><?php echo csrf_field(); ?><button class="app-btn app-btn-primary px-3 py-2"><i class="fa-solid fa-check"></i> تأكيد</button></form><button type="button" class="app-btn app-btn-danger px-3 py-2" data-modal-open="reject-payment-<?php echo e($payment->id); ?>"><i class="fa-solid fa-xmark"></i> رفض</button></div><div id="reject-payment-<?php echo e($payment->id); ?>" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/70 p-4" data-modal><div class="w-full max-w-md rounded-2xl bg-surface shadow-2xl"><div class="flex items-center justify-between border-b border-line px-5 py-4"><h3 class="text-sm font-extrabold">رفض الدفعة <?php echo e($payment->receipt_number); ?></h3><button type="button" data-modal-close="reject-payment-<?php echo e($payment->id); ?>" class="grid h-8 w-8 place-items-center rounded-lg text-dim hover:bg-base"><i class="fa-solid fa-xmark"></i></button></div><form method="POST" action="<?php echo e(route('payments.reject',$payment)); ?>" class="p-5"><?php echo csrf_field(); ?><label class="block"><span class="app-label">سبب الرفض <span class="text-danger">*</span></span><textarea name="reason" class="app-input" rows="4" required minlength="3" maxlength="1000" placeholder="اذكر سبب الرفض بوضوح"></textarea></label><div class="mt-5 flex justify-end gap-2"><button type="button" data-modal-close="reject-payment-<?php echo e($payment->id); ?>" class="app-btn app-btn-secondary">إلغاء</button><button class="app-btn app-btn-danger"><i class="fa-solid fa-ban"></i> تأكيد الرفض</button></div></form></div></div></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'قائمة المراجعة فارغة','description' => 'لا توجد دفعات معلقة حاليًا. ستظهر هنا الدفعات الجديدة التي تنتظر القرار.','icon' => 'fa-circle-check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'قائمة المراجعة فارغة','description' => 'لا توجد دفعات معلقة حاليًا. ستظهر هنا الدفعات الجديدة التي تنتظر القرار.','icon' => 'fa-circle-check']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></td></tr><?php endif; ?></tbody></table></div><?php if(method_exists($payments,'links')): ?><div class="border-t border-line px-5 py-4"><?php echo e($payments->links()); ?></div><?php endif; ?> <?php echo $__env->renderComponent(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/payments/confirmations.blade.php ENDPATH**/ ?>