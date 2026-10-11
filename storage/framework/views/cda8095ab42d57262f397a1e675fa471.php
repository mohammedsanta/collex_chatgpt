<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status' => 'unknown']));

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

foreach (array_filter((['status' => 'unknown']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $labels = ['active'=>'نشط','inactive'=>'غير نشط','suspended'=>'موقوف','pending'=>'قيد المراجعة','confirmed'=>'مؤكد','rejected'=>'مرفوض','paid'=>'مسدد','legal'=>'قانوني','draft'=>'مسودة','processing'=>'قيد المعالجة','completed'=>'مكتمل','failed'=>'فشل','scheduled'=>'مجدول','completed_visit'=>'تمت الزيارة','missed'=>'لم تتم','cancelled'=>'ملغي','open'=>'مفتوحة','in_review'=>'قيد المراجعة','resolved'=>'تم الحل','closed'=>'مغلقة','archived'=>'مؤرشف','kept'=>'تم الوفاء','partial'=>'جزئي','broken'=>'لم يتم الوفاء','submitted'=>'مرسل','approved'=>'معتمد','review'=>'مراجعة','overdue'=>'متأخر','unknown'=>'غير محدد'];
    $tone = match((string)$status) { 'active','confirmed','completed','paid','resolved','closed','kept','approved' => 'app-badge-green', 'pending','draft','processing','scheduled','review','in_review','submitted','overdue' => 'app-badge-yellow', 'rejected','failed','suspended','broken','missed','cancelled' => 'app-badge-red', 'legal' => 'app-badge-blue', default => 'app-badge-gray' };
    $label = $labels[(string)$status] ?? str_replace('_', ' ', (string)$status);
?>
<span <?php echo e($attributes->merge(['class' => 'app-badge '.$tone])); ?>><span class="h-1.5 w-1.5 rounded-full bg-current opacity-70"></span><?php echo e($label); ?></span>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/components/status-badge.blade.php ENDPATH**/ ?>