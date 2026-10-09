<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0b0f12">
    <title>@yield('title', 'Collex') · {{ config('app.name', 'Collex') }}</title>
    @include('layouts.partials._head')
</head>
<body>
    @include('layouts.partials._aside')
    <div id="app-overlay" class="app-overlay" data-sidebar-close></div>
    <div class="app-main">
        <header class="app-topbar flex items-center justify-between gap-4 px-4 sm:px-7">
            <div class="flex min-w-0 items-center gap-3">
                <button type="button" class="grid h-10 w-10 shrink-0 place-items-center rounded-xl border border-line bg-surface text-muted hover:text-brand lg:hidden" data-sidebar-toggle aria-label="فتح القائمة" aria-controls="app-sidebar"><i class="fa-solid fa-bars"></i></button>
                <div class="min-w-0"><p class="eyebrow">مساحة العمل</p><p class="truncate text-sm font-extrabold text-fg">@yield('topbar-title', trim($__env->yieldContent('title', 'لوحة التحكم')))</p></div>
            </div>
            <div class="flex shrink-0 items-center gap-2 sm:gap-3">
                @if(\Illuminate\Support\Facades\Route::has('notifications.index'))
                    <a href="{{ route('notifications.index') }}" class="relative grid h-10 w-10 place-items-center rounded-xl border border-line bg-surface text-muted hover:border-brand/20 hover:text-brand" aria-label="الإشعارات"><i class="fa-regular fa-bell"></i></a>
                @endif
                <div class="hidden h-8 w-px bg-line sm:block"></div>
                <div class="hidden text-left sm:block"><p class="text-xs font-extrabold text-fg">{{ auth()->user()?->name ?? 'مستخدم النظام' }}</p><p class="mt-1 text-[10px] text-muted">{{ data_get(auth()->user(), 'role.label', 'عضو الفريق') }}</p></div>
                <div class="grid h-10 w-10 place-items-center rounded-xl border border-brand/15 bg-brand/10 text-xs font-black text-brand">{{ mb_strtoupper(mb_substr(auth()->user()?->name ?? 'C', 0, 1)) }}</div>
            </div>
        </header>
        <main class="app-content">
            @include('components.flash')
            @yield('content')
        </main>
        <footer class="app-footer flex flex-wrap items-center justify-between gap-2"><span>© {{ now()->year }} Collex · نظام إدارة التحصيل</span><span>الوضوح · الدقة · المساءلة</span></footer>
    </div>
    @include('layouts.partials._scripts')
</body>
</html>
