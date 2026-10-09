<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name' => 'مستخدم', 'size' => 'md']));

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

foreach (array_filter((['name' => 'مستخدم', 'size' => 'md']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php ($sizeClass = ['sm'=>'h-8 w-8 text-[10px]','md'=>'h-10 w-10 text-xs','lg'=>'h-14 w-14 text-base'][$size] ?? 'h-10 w-10 text-xs'); ?>
<span <?php echo e($attributes->merge(['class' => 'inline-grid shrink-0 place-items-center rounded-xl bg-brand/10 font-extrabold text-brand '.$sizeClass])); ?>><?php echo e(mb_strtoupper(mb_substr((string)$name, 0, 1))); ?></span>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/avatar.blade.php ENDPATH**/ ?>