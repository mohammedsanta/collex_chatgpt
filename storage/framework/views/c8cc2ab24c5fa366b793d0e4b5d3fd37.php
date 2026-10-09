<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group']));

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

foreach (array_filter((['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="mb-6 flex flex-wrap items-start justify-between gap-4">
    <div class="flex min-w-0 items-start gap-3"><span class="mt-1 grid h-11 w-11 shrink-0 place-items-center rounded-2xl border border-brand/20 bg-brand/10 text-brand"><i class="fa-solid <?php echo e($icon); ?>" aria-hidden="true"></i></span><div class="min-w-0"><p class="eyebrow mb-1"><?php echo e($eyebrow); ?></p><h1 class="page-title"><?php echo e($title); ?></h1><?php if($subtitle): ?><p class="page-subtitle"><?php echo e($subtitle); ?></p><?php endif; ?></div></div>
    <?php if(isset($actions)): ?><div class="flex flex-wrap items-center gap-2"><?php echo e($actions); ?></div><?php endif; ?>
</div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/page-header.blade.php ENDPATH**/ ?>