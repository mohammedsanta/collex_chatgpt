@props(['title' => null, 'subtitle' => null, 'icon' => null, 'padding' => true])
<section {{ $attributes->merge(['class' => 'app-card']) }}>
    @if($title || $icon || isset($header))<div class="app-card-header">@isset($header){{ $header }}@else<div class="flex items-center gap-3">@if($icon)<span class="grid h-9 w-9 place-items-center rounded-xl border border-line bg-white/[0.03] text-muted"><i class="fa-solid {{ $icon }}"></i></span>@endif<div><h2 class="text-xs font-extrabold text-fg">{{ $title }}</h2>@if($subtitle)<p class="mt-1 text-[10px] text-muted">{{ $subtitle }}</p>@endif</div></div>@endisset @isset($actions)<div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>@endisset</div>@endif
    <div @class(['app-card-body' => $padding, 'p-0' => !$padding])>{{ $slot }}</div>
</section>
