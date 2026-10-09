<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'icon' => 'fa-chart-simple', 'color' => 'green', 'hint' => null]));

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

foreach (array_filter((['label', 'value', 'icon' => 'fa-chart-simple', 'color' => 'green', 'hint' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php ($tone = match($color) { 'green' => 'stat-tone-green', 'blue' => 'stat-tone-blue', 'orange' => 'stat-tone-orange', 'purple' => 'stat-tone-purple', 'red' => 'stat-tone-red', default => 'stat-tone-green' }); ?>
<div class="app-stat"><div class="flex items-start justify-between gap-3"><div class="min-w-0"><p class="app-stat-label"><?php echo e($label); ?></p><p class="app-stat-value mt-2 break-words"><?php echo e($value); ?></p><?php if($hint): ?><p class="mt-2 text-[10px] leading-5 text-dim"><?php echo e($hint); ?></p><?php endif; ?></div><span class="app-stat-icon <?php echo e($tone); ?>"><i class="fa-solid <?php echo e($icon); ?>"></i></span></div></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/stat-card.blade.php ENDPATH**/ ?>