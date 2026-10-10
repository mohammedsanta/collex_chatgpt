<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'name', 'options' => [], 'value' => null, 'placeholder' => 'اختر...', 'required' => false, 'help' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['label', 'name', 'options' => [], 'value' => null, 'placeholder' => 'اختر...', 'required' => false, 'help' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<label class="block"><span class="app-label"><?php echo e($label); ?> <?php if($required): ?><span class="text-danger">*</span><?php endif; ?></span><select class="app-input" name="<?php echo e($name); ?>" <?php if($required): ?> required <?php endif; ?>><option value=""><?php echo e($placeholder); ?></option><?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($optionValue); ?>" <?php if((string)old($name, $value) === (string)$optionValue): echo 'selected'; endif; ?>><?php echo e($optionLabel); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select><?php if($help): ?><span class="app-help"><?php echo e($help); ?></span><?php endif; ?> <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="mt-1 block text-[10px] text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></label>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/select-field.blade.php ENDPATH**/ ?>