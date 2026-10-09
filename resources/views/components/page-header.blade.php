@props(['title', 'subtitle' => null, 'eyebrow' => 'إدارة النظام', 'icon' => 'fa-layer-group'])
<div class="mb-6 flex flex-wrap items-start justify-between gap-4">
    <div class="flex min-w-0 items-start gap-3"><span class="mt-1 grid h-11 w-11 shrink-0 place-items-center rounded-2xl border border-brand/20 bg-brand/10 text-brand"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span><div class="min-w-0"><p class="eyebrow mb-1">{{ $eyebrow }}</p><h1 class="page-title">{{ $title }}</h1>@if($subtitle)<p class="page-subtitle">{{ $subtitle }}</p>@endif</div></div>
    @isset($actions)<div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>@endisset
</div>
