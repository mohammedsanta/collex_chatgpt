
@php
    $menu = config('navigation', []);
    $currentRoute = request()->route()?->getName() ?? '';

    $user = auth()->user();
    $userName = $user?->name ?? 'مستخدم النظام';
    $userInitial = mb_strtoupper(mb_substr($userName, 0, 1));
@endphp

<aside
    id="app-sidebar"
    class="app-sidebar"
    aria-label="القائمة الرئيسية"
    dir="rtl"
>
    {{-- Brand header --}}
    <div class="flex h-[82px] shrink-0 items-center gap-3 border-b border-white/[.07] px-5">
        <a
            href="{{ \Illuminate\Support\Facades\Route::has('dashboard') ? route('dashboard') : url('/') }}"
            class="flex min-w-0 items-center gap-3"
        >
            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-[14px] bg-brand text-black shadow-lg shadow-brand/10">
                <i class="fa-solid fa-chart-line text-lg" aria-hidden="true"></i>
            </span>

            <span class="min-w-0">
                <span class="block text-lg font-black tracking-wide text-white">
                    كولكس <span class="text-brand">Collex</span>
                </span>

                <span class="mt-0.5 block text-[9px] font-semibold tracking-wide text-[#738279]">
                    إدارة التحصيل بذكاء
                </span>
            </span>
        </a>

        <button
            type="button"
            class="mr-auto grid h-8 w-8 place-items-center rounded-lg text-muted hover:bg-white/5 hover:text-white lg:hidden"
            data-sidebar-close
            aria-label="إغلاق القائمة"
        >
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
    </div>

    {{-- Navigation tree --}}
    <nav class="nav-scroll flex-1 overflow-y-auto px-3 py-5">
        @foreach ($menu as $section)
            <section class="sidebar-section">
                <h2 class="sidebar-section-title">
                    {{ $section['section'] }}
                </h2>

                <div class="sidebar-section-items">
                    @foreach ($section['items'] as $item)
                        <x-sidebar.tree-item
                            :item="$item"
                            :current-route="$currentRoute"
                        />
                    @endforeach
                </div>
            </section>
        @endforeach
    </nav>

    {{-- User account --}}
    <div class="shrink-0 border-t border-white/[.07] p-3">
        <div class="mb-2 flex items-center gap-3 rounded-xl border border-white/[.06] bg-white/[.025] p-3">
            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-brand/10 text-xs font-black text-brand">
                {{ $userInitial }}
            </span>

            <span class="min-w-0 flex-1">
                <span class="block truncate text-[11px] font-extrabold text-white">
                    {{ $userName }}
                </span>

                <span class="mt-0.5 block truncate text-[9px] text-[#77867c]">
                    {{ data_get($user, 'role.label', 'عضو الفريق') }}
                </span>
            </span>

            @if (\Illuminate\Support\Facades\Route::has('account.edit'))
                <a
                    href="{{ route('account.edit') }}"
                    class="text-dim transition hover:text-brand"
                    aria-label="إعدادات الحساب"
                >
                    <i class="fa-solid fa-user-gear text-xs" aria-hidden="true"></i>
                </a>
            @else
                <i class="fa-solid fa-user-gear text-xs text-dim" aria-hidden="true"></i>
            @endif
        </div>

        @if (\Illuminate\Support\Facades\Route::has('logout'))
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/[.07] px-3 py-2.5 text-[11px] font-bold text-muted transition hover:border-danger/20 hover:bg-danger/5 hover:text-danger"
                >
                    <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                    تسجيل الخروج
                </button>
            </form>
        @endif
    </div>
</aside>