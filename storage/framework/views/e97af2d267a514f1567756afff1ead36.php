<?php $__env->startSection('title', 'تفاصيل الدفعة'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'تفاصيل الدفعة','subtitle' => 'إيصال رقم '.$payment->receipt_number,'eyebrow' => 'المدفوعات / تفاصيل الإيصال','icon' => 'fa-receipt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تفاصيل الدفعة','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('إيصال رقم '.$payment->receipt_number),'eyebrow' => 'المدفوعات / تفاصيل الإيصال','icon' => 'fa-receipt']); ?> <?php $__env->slot('actions', null, []); ?> <a href="<?php echo e(route('payments.index')); ?>" class="app-btn app-btn-secondary"><i class="fa-solid fa-arrow-right"></i> العودة للسجل</a><?php if($payment->status === 'pending'): ?><a href="<?php echo e(route('payments.confirmations')); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-list-check"></i> مراجعة الدفعة</a><?php endif; ?> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mb-5 overflow-hidden rounded-2xl bg-gradient-to-l from-[#10251a] to-[#172c21] p-6 text-white"><div class="flex flex-wrap items-start justify-between gap-4"><div><p class="text-[10px] font-bold text-brand">قيمة عملية التحصيل</p><p class="mt-2 text-3xl font-extrabold"><?php echo e(number_format((float)$payment->amount,2)); ?> <span class="text-sm text-muted">جنيه مصري</span></p><p class="mt-3 font-mono text-[11px] text-dim"><?php echo e($payment->receipt_number); ?></p></div><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $payment->status,'class' => '!px-3 !py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->status),'class' => '!px-3 !py-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></div><div class="mt-6 grid gap-3 border-t border-white/10 pt-5 sm:grid-cols-3"><div><p class="text-[10px] text-dim">تاريخ الدفع</p><p class="mt-1 text-xs font-bold"><?php echo e($payment->paid_at?->format('Y-m-d H:i') ?? '—'); ?></p></div><div><p class="text-[10px] text-dim">طريقة الدفع</p><p class="mt-1 text-xs font-bold"><?php echo e(['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك'][$payment->method] ?? $payment->method); ?></p></div><div><p class="text-[10px] text-dim">تاريخ التسجيل</p><p class="mt-1 text-xs font-bold"><?php echo e($payment->created_at?->format('Y-m-d H:i') ?? '—'); ?></p></div></div></div>
<div class="grid gap-5 xl:grid-cols-2"><?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'بيانات العميل والقضية','subtitle' => 'السجل الذي تم ربط الدفعة به','icon' => 'fa-user-check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'بيانات العميل والقضية','subtitle' => 'السجل الذي تم ربط الدفعة به','icon' => 'fa-user-check']); ?><div class="mb-5"><?php if (isset($component)) { $__componentOriginal565855a8bdd7feffc6916e5260415425 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal565855a8bdd7feffc6916e5260415425 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.client-field','data' => ['client' => $payment->debtCase?->client]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('client-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['client' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->debtCase?->client)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal565855a8bdd7feffc6916e5260415425)): ?>
<?php $attributes = $__attributesOriginal565855a8bdd7feffc6916e5260415425; ?>
<?php unset($__attributesOriginal565855a8bdd7feffc6916e5260415425); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal565855a8bdd7feffc6916e5260415425)): ?>
<?php $component = $__componentOriginal565855a8bdd7feffc6916e5260415425; ?>
<?php unset($__componentOriginal565855a8bdd7feffc6916e5260415425); ?>
<?php endif; ?></div><dl class="grid gap-4 sm:grid-cols-2"><div><dt class="text-[10px] font-bold text-dim">رقم القضية</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e($payment->debt_case_id); ?></dd></div><div><dt class="text-[10px] font-bold text-dim">رقم القرض</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e($payment->debtCase?->loan_number ?? '—'); ?></dd></div><div><dt class="text-[10px] font-bold text-dim">إجمالي الدين</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e(number_format((float)($payment->debtCase?->total_debt ?? 0),2)); ?> ج.م</dd></div><div><dt class="text-[10px] font-bold text-dim">المحصل حتى الآن</dt><dd class="mt-1 text-xs font-extrabold text-brand"><?php echo e(number_format((float)($payment->debtCase?->collected_amount ?? 0),2)); ?> ج.م</dd></div></dl> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'المراجعة والمرفقات','subtitle' => 'تفاصيل الاعتماد والمرجع','icon' => 'fa-clipboard-check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'المراجعة والمرفقات','subtitle' => 'تفاصيل الاعتماد والمرجع','icon' => 'fa-clipboard-check']); ?><dl class="grid gap-4 sm:grid-cols-2"><div><dt class="text-[10px] font-bold text-dim">المحصل</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e($payment->collector?->name ?? '—'); ?></dd></div><div><dt class="text-[10px] font-bold text-dim">تم التأكيد بواسطة</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e($payment->confirmedBy?->name ?? '—'); ?></dd></div><div><dt class="text-[10px] font-bold text-dim">وقت التأكيد</dt><dd class="mt-1 text-xs font-extrabold"><?php echo e($payment->confirmed_at?->format('Y-m-d H:i') ?? '—'); ?></dd></div><div><dt class="text-[10px] font-bold text-dim">الرقم المرجعي</dt><dd class="mt-1 break-all text-xs font-extrabold"><?php echo e($payment->reference ?? '—'); ?></dd></div><?php if($payment->proof_path): ?><div class="sm:col-span-2"><a class="app-btn app-btn-secondary" href="<?php echo e(\Illuminate\Support\Facades\Storage::disk('public')->url($payment->proof_path)); ?>" target="_blank" rel="noopener"><i class="fa-solid fa-paperclip"></i> عرض إثبات الدفع</a></div><?php endif; ?></dl><?php if($payment->rejection_reason): ?><div class="mt-5 rounded-xl border border-danger/20 bg-danger/10 p-4"><p class="text-[10px] font-extrabold text-danger"><i class="fa-solid fa-circle-exclamation ml-1"></i> سبب الرفض</p><p class="mt-2 text-xs leading-6 text-danger"><?php echo e($payment->rejection_reason); ?></p></div><?php endif; ?> <?php if($payment->notes): ?><div class="mt-5 rounded-xl bg-white/[0.025] p-4"><p class="text-[10px] font-bold text-dim">ملاحظات</p><p class="mt-2 whitespace-pre-line text-xs leading-6 text-fg"><?php echo e($payment->notes); ?></p></div><?php endif; ?> <?php echo $__env->renderComponent(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/payments/show.blade.php ENDPATH**/ ?>