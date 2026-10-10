<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'لا توجد بيانات لعرضها', 'description' => 'ستظهر البيانات هنا بمجرد توفرها.', 'icon' => 'fa-inbox']));

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

foreach (array_filter((['title' => 'لا توجد بيانات لعرضها', 'description' => 'ستظهر البيانات هنا بمجرد توفرها.', 'icon' => 'fa-inbox']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="app-empty"><div class="app-empty-icon"><i class="fa-solid <?php echo e($icon); ?>" aria-hidden="true"></i></div><p class="text-xs font-extrabold text-fg"><?php echo e($title); ?></p><p class="mx-auto mt-1 max-w-sm text-[11px] leading-6 text-muted"><?php echo e($description); ?></p><?php if(isset($action)): ?><div class="mt-4"><?php echo e($action); ?></div><?php endif; ?></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/empty-state.blade.php ENDPATH**/ ?>