<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['client' => null, 'label' => 'العميل']));

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

foreach (array_filter((['client' => null, 'label' => 'العميل']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="flex items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-xl bg-brand/10 text-xs font-extrabold text-brand"><?php echo e(mb_strtoupper(mb_substr($client?->name ?? '؟', 0, 1))); ?></span><div><p class="text-xs font-extrabold text-fg"><?php echo e($client?->name ?? 'غير محدد'); ?></p><p class="mt-1 text-[10px] text-dim"><?php echo e($label); ?> · <?php echo e($client?->code ?? '—'); ?></p></div></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/client-field.blade.php ENDPATH**/ ?>