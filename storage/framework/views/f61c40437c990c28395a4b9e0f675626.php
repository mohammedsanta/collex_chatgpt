<?php echo csrf_field(); ?>
<div class="grid gap-x-5 gap-y-4 md:grid-cols-2">
    <div class="md:col-span-2"><?php if (isset($component)) { $__componentOriginala2fbd5dd19e5d391186efe67b2f11409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-field','data' => ['label' => 'القضية / العميل','name' => 'debt_case_id','options' => ($debtCases ?? collect())->mapWithKeys(fn($case) => [$case->id => '#'.$case->id.' · '.($case->client?->name ?? 'عميل غير محدد').' · '.number_format((float)$case->total_debt, 2).' ج.م'])->all(),'value' => $payment->debt_case_id ?? null,'required' => true,'placeholder' => 'اختر القضية المرتبطة بالدفعة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'القضية / العميل','name' => 'debt_case_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($debtCases ?? collect())->mapWithKeys(fn($case) => [$case->id => '#'.$case->id.' · '.($case->client?->name ?? 'عميل غير محدد').' · '.number_format((float)$case->total_debt, 2).' ج.م'])->all()),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->debt_case_id ?? null),'required' => true,'placeholder' => 'اختر القضية المرتبطة بالدفعة']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $attributes = $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $component = $__componentOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?></div>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'المبلغ (جنيه مصري)','name' => 'amount','type' => 'number','value' => $payment->amount ?? old('amount'),'required' => true,'placeholder' => '0.00','min' => '0.01','step' => '0.01']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'المبلغ (جنيه مصري)','name' => 'amount','type' => 'number','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->amount ?? old('amount')),'required' => true,'placeholder' => '0.00','min' => '0.01','step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala2fbd5dd19e5d391186efe67b2f11409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-field','data' => ['label' => 'طريقة الدفع','name' => 'method','value' => $payment->method ?? null,'options' => ['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك'],'required' => true,'placeholder' => 'اختر طريقة الدفع']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'طريقة الدفع','name' => 'method','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->method ?? null),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['cash'=>'نقدي','e_wallet'=>'محفظة إلكترونية','bank_transfer'=>'تحويل بنكي','card'=>'بطاقة','cheque'=>'شيك']),'required' => true,'placeholder' => 'اختر طريقة الدفع']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $attributes = $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $component = $__componentOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'تاريخ ووقت الدفع','name' => 'paid_at','type' => 'datetime-local','value' => old('paid_at', isset($payment) ? $payment->paid_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'تاريخ ووقت الدفع','name' => 'paid_at','type' => 'datetime-local','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('paid_at', isset($payment) ? $payment->paid_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'))),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'الرقم المرجعي','name' => 'reference','value' => $payment->reference ?? null,'placeholder' => 'رقم التحويل أو مرجع العملية','maxlength' => '100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الرقم المرجعي','name' => 'reference','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->reference ?? null),'placeholder' => 'رقم التحويل أو مرجع العملية','maxlength' => '100']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
    <div class="md:col-span-2"><?php if (isset($component)) { $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea-field','data' => ['label' => 'ملاحظات','name' => 'notes','value' => $payment->notes ?? null,'rows' => '3','placeholder' => 'تفاصيل إضافية عن عملية التحصيل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'ملاحظات','name' => 'notes','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment->notes ?? null),'rows' => '3','placeholder' => 'تفاصيل إضافية عن عملية التحصيل']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $attributes = $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $component = $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?></div>
</div>
<div class="mt-7 flex flex-wrap items-center gap-2 border-t border-line pt-5"><button type="submit" class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> تسجيل الدفعة</button><a href="<?php echo e(route('payments.index')); ?>" class="app-btn app-btn-secondary">إلغاء</a><p class="mr-auto text-[10px] text-dim">ستظل الدفعة معلّقة حتى اعتمادها من صاحب الصلاحية.</p></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/payments/_form.blade.php ENDPATH**/ ?>