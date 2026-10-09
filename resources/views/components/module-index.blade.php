@props(['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group', 'rows' => [], 'columns' => [], 'createRoute' => null, 'showRoute' => null, 'editRoute' => null, 'search' => false, 'searchName' => 'q', 'searchPlaceholder' => 'ابحث في السجلات...', 'emptyTitle' => 'لا توجد سجلات', 'emptyDescription' => 'لا توجد بيانات مطابقة لعوامل البحث.', 'createLabel' => 'إضافة سجل'])
<x-page-header :title="$title" :subtitle="$subtitle" :eyebrow="$eyebrow" :icon="$icon"><x-slot:actions>@if($createRoute && \Illuminate\Support\Facades\Route::has($createRoute))<a href="{{ route($createRoute) }}" class="app-btn app-btn-primary"><i class="fa-solid fa-plus"></i> {{ $createLabel }}</a>@endif</x-slot:actions></x-page-header>
<x-panel :title="$title" subtitle="استعراض السجلات والبحث والتصفية" :icon="$icon" :padding="false"><x-slot:actions>@if($search)<form method="GET" class="flex flex-wrap gap-2"><div class="relative"><i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-dim"></i><input class="app-input min-w-[190px] pr-8 sm:w-64" name="{{ $searchName }}" value="{{ request($searchName) }}" placeholder="{{ $searchPlaceholder }}"></div><button class="app-btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> بحث</button>@if(request()->filled($searchName))<a class="app-btn app-btn-ghost" href="{{ url()->current() }}">مسح</a>@endif</form>@endif</x-slot:actions>
<div class="overflow-x-auto"><table class="app-table"><thead><tr>@foreach($columns as $column)<th>{{ $column['label'] ?? '' }}</th>@endforeach@if($showRoute || $editRoute)<th class="text-center">الإجراءات</th>@endif</tr></thead><tbody>
@forelse($rows as $row)<tr>
@foreach($columns as $index => $column)@php($value = data_get($row, $column['key'] ?? ''))<td>
@if(($column['type'] ?? '') === 'status')<x-status-badge :status="$value ?? 'unknown'" />
@elseif(($column['type'] ?? '') === 'money')<span class="whitespace-nowrap font-extrabold text-fg">{{ number_format((float)($value ?? 0), 2) }} <small class="text-dim">ج.م</small></span>
@elseif(($column['type'] ?? '') === 'date')<span class="whitespace-nowrap">{{ is_object($value) && method_exists($value, 'format') ? $value->format('Y-m-d') : ($value ?: '—') }}</span>
@elseif(($column['type'] ?? '') === 'boolean')<x-status-badge :status="$value ? 'active' : 'inactive'" />
@elseif(($column['type'] ?? '') === 'mono')<span class="font-mono text-[10px]">{{ is_scalar($value) && $value !== '' ? $value : '—' }}</span>
@elseif($index === 0 && $showRoute && \Illuminate\Support\Facades\Route::has($showRoute))<a href="{{ route($showRoute, $row) }}" class="font-extrabold text-fg hover:text-brand">{{ is_scalar($value) && $value !== '' ? $value : 'عرض السجل' }}</a>
@else<span>{{ is_scalar($value) && $value !== '' ? $value : '—' }}</span>@endif
</td>@endforeach
@if($showRoute || $editRoute)<td><div class="flex items-center justify-center gap-1">@if($showRoute && \Illuminate\Support\Facades\Route::has($showRoute))<x-action-icon :href="route($showRoute, $row)" icon="fa-eye" label="عرض" tone="green"/>@endif @if($editRoute && \Illuminate\Support\Facades\Route::has($editRoute))<x-action-icon :href="route($editRoute, $row)" icon="fa-pen" label="تعديل"/>@endif</div></td>@endif
</tr>@empty<tr><td colspan="{{ max(1, count($columns) + (($showRoute || $editRoute) ? 1 : 0)) }}"><x-empty-state :title="$emptyTitle" :description="$emptyDescription" :icon="$icon" /></td></tr>@endforelse
</tbody></table></div>
@if(is_object($rows) && method_exists($rows, 'links'))<div class="border-t border-line px-5 py-4">{{ $rows->links() }}</div>@endif
</x-panel>
