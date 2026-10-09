@props(['status' => 'unknown'])
@php
    $labels = ['active'=>'نشط','inactive'=>'غير نشط','suspended'=>'موقوف','pending'=>'قيد المراجعة','confirmed'=>'مؤكد','rejected'=>'مرفوض','paid'=>'مسدد','legal'=>'قانوني','draft'=>'مسودة','processing'=>'قيد المعالجة','completed'=>'مكتمل','failed'=>'فشل','scheduled'=>'مجدول','completed_visit'=>'تمت الزيارة','missed'=>'لم تتم','cancelled'=>'ملغي','open'=>'مفتوحة','in_review'=>'قيد المراجعة','resolved'=>'تم الحل','closed'=>'مغلقة','archived'=>'مؤرشف','kept'=>'تم الوفاء','partial'=>'جزئي','broken'=>'لم يتم الوفاء','submitted'=>'مرسل','approved'=>'معتمد','review'=>'مراجعة','overdue'=>'متأخر','unknown'=>'غير محدد'];
    $tone = match((string)$status) { 'active','confirmed','completed','paid','resolved','closed','kept','approved' => 'app-badge-green', 'pending','draft','processing','scheduled','review','in_review','submitted','overdue' => 'app-badge-yellow', 'rejected','failed','suspended','broken','missed','cancelled' => 'app-badge-red', 'legal' => 'app-badge-blue', default => 'app-badge-gray' };
    $label = $labels[(string)$status] ?? str_replace('_', ' ', (string)$status);
@endphp
<span {{ $attributes->merge(['class' => 'app-badge '.$tone]) }}><span class="h-1.5 w-1.5 rounded-full bg-current opacity-70"></span>{{ $label }}</span>
