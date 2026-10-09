<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null, 'subtitle' => null, 'icon' => null, 'padding' => true]));

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

foreach (array_filter((['title' => null, 'subtitle' => null, 'icon' => null, 'padding' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<section <?php echo e($attributes->merge(['class' => 'app-card'])); ?>>
    <?php if($title || $icon || isset($header)): ?><div class="app-card-header"><?php if(isset($header)): ?><?php echo e($header); ?><?php else: ?><div class="flex items-center gap-3"><?php if($icon): ?><span class="grid h-9 w-9 place-items-center rounded-xl border border-line bg-white/[0.03] text-muted"><i class="fa-solid <?php echo e($icon); ?>"></i></span><?php endif; ?><div><h2 class="text-xs font-extrabold text-fg"><?php echo e($title); ?></h2><?php if($subtitle): ?><p class="mt-1 text-[10px] text-muted"><?php echo e($subtitle); ?></p><?php endif; ?></div></div><?php endif; ?> <?php if(isset($actions)): ?><div class="flex flex-wrap items-center gap-2"><?php echo e($actions); ?></div><?php endif; ?></div><?php endif; ?>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['app-card-body' => $padding, 'p-0' => !$padding]); ?>"><?php echo e($slot); ?></div>
</section>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/panel.blade.php ENDPATH**/ ?>