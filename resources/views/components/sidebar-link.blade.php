@props(['route' => '#', 'pattern' => null, 'icon' => 'fa-circle', 'color' => 'green', 'badge' => null])
@php($exists = \Illuminate\Support\Facades\Route::has($route))
@php($active = $exists && request()->routeIs($pattern ?: $route))
<a href="{{ $exists ? route($route) : '#' }}" @if($active) aria-current="page" @endif @class(['nav-link', 'active' => $active, 'opacity-60' => !$exists])><span class="nav-icon"><i class="fa-solid {{ $icon }}"></i></span><span class="min-w-0 flex-1 truncate">{{ $slot }}</span>@if($badge)<span class="rounded-md bg-danger/15 px-1.5 py-0.5 text-[9px] font-bold text-danger">{{ $badge }}</span>@elseif(!$exists)<span class="text-[8px] text-muted">قريبًا</span>@endif</a>
