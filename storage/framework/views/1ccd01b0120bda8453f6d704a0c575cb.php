<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => '#', 'icon' => 'fa-eye', 'label' => 'عرض', 'tone' => 'gray', 'method' => null]));

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

foreach (array_filter((['href' => '#', 'icon' => 'fa-eye', 'label' => 'عرض', 'tone' => 'gray', 'method' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<a href="<?php echo e($href); ?>" title="<?php echo e($label); ?>" aria-label="<?php echo e($label); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['inline-grid h-8 w-8 place-items-center rounded-lg border text-[11px] transition hover:-translate-y-0.5', 'border-line bg-surface text-muted hover:border-brand/25 hover:text-brand' => $tone === 'gray', 'border-brand/20 bg-brand/10 text-brand' => $tone === 'green', 'border-danger/20 bg-danger/10 text-danger' => $tone === 'red']); ?>"><i class="fa-solid <?php echo e($icon); ?>"></i></a>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/action-icon.blade.php ENDPATH**/ ?>