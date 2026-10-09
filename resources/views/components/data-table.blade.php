@props(['columns' => [], 'rows' => [], 'emptyTitle' => 'لا توجد بيانات', 'emptyDescription' => 'جرّب تغيير عوامل التصفية أو أضف سجلًا جديدًا.'])
<div class="overflow-x-auto"><table class="app-table"><thead><tr>@foreach($columns as $column)<th>{{ is_array($column) ? ($column['label'] ?? '') : $column }}</th>@endforeach</tr></thead><tbody>{{ $slot }}</tbody></table></div>
