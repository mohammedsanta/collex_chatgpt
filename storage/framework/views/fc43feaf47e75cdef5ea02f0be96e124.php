<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'name', 'value' => null, 'rows' => 4, 'placeholder' => null, 'required' => false, 'help' => null]));

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

foreach (array_filter((['label', 'name', 'value' => null, 'rows' => 4, 'placeholder' => null, 'required' => false, 'help' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<label class="block"><span class="app-label"><?php echo e($label); ?> <?php if($required): ?><span class="text-danger">*</span><?php endif; ?></span><textarea class="app-input resize-y" name="<?php echo e($name); ?>" rows="<?php echo e($rows); ?>" <?php if($placeholder): ?> placeholder="<?php echo e($placeholder); ?>" <?php endif; ?> <?php if($required): ?> required <?php endif; ?>><?php echo e(old($name, $value)); ?></textarea><?php if($help): ?><span class="app-help"><?php echo e($help); ?></span><?php endif; ?> <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="mt-1 block text-[10px] text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></label>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/textarea-field.blade.php ENDPATH**/ ?>