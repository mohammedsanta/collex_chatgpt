
@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    /*
    |--------------------------------------------------------------------------
    | Navigation helpers
    |--------------------------------------------------------------------------
    */

    $routeExists = static fn (?string $name): bool =>
        $name !== null && Route::has($name);

    $isActive = static function ($patterns): bool {
        foreach ((array) $patterns as $pattern) {
            if ($pattern && request()->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    };

    /*
     * Build URLs safely. Some bank pages require a {bank} parameter.
     * When no bank is selected, use the configured fallback route.
     */
    $resolveUrl = static function (
        ?string $name,
        ?string $fallback = null
    ): ?string {
        if (!$name || !Route::has($name)) {
            return $fallback && Route::has($fallback)
                ? route($fallback)
                : null;
        }

        $route = Route::getRoutes()->getByName($name);
        $parameters = [];

        foreach ($route?->parameterNames() ?? [] as $parameter) {
            $value = request()->route($parameter);

            if ($value !== null && $value !== '') {
                $parameters[$parameter] = $value;
            }
        }

        $missing = collect($route?->parameterNames() ?? [])
            ->contains(
                static fn (string $parameter): bool =>
                    !array_key_exists($parameter, $parameters)
            );

        if (!$missing) {
            return route($name, $parameters);
        }

        return $fallback && Route::has($fallback)
            ? route($fallback)
            : null;
    };

    /*
    |--------------------------------------------------------------------------
    | Theme palette
    |--------------------------------------------------------------------------
    */

    $palette = [
        'green' => [
            'text' => 'text-[#00ff66]',
            'icon' => 'bg-[#00ff66]/10',
            'border' => 'border-[#00ff66]/15',
            'gradient' => 'from-[#00ff66]/10',
            'dot' => 'bg-[#00ff66] shadow-[0_0_8px_#00ff66]',
            'idle' => 'text-[#687582]',
            'hover' => 'group-hover:bg-[#00ff66]/10 group-hover:text-[#00ff66]',
        ],
        'blue' => [
            'text' => 'text-[#00aaff]',
            'icon' => 'bg-[#00aaff]/10',
            'border' => 'border-[#00aaff]/15',
            'gradient' => 'from-[#00aaff]/10',
            'dot' => 'bg-[#00aaff] shadow-[0_0_8px_#00aaff]',
            'idle' => 'text-[#687582]',
            'hover' => 'group-hover:bg-[#00aaff]/10 group-hover:text-[#00aaff]',
        ],
        'purple' => [
            'text' => 'text-[#a855f7]',
            'icon' => 'bg-[#a855f7]/10',
            'border' => 'border-[#a855f7]/15',
            'gradient' => 'from-[#a855f7]/10',
            'dot' => 'bg-[#a855f7] shadow-[0_0_8px_#a855f7]',
            'idle' => 'text-[#687582]',
            'hover' => 'group-hover:bg-[#a855f7]/10 group-hover:text-[#a855f7]',
        ],
        'orange' => [
            'text' => 'text-orange-400',
            'icon' => 'bg-orange-400/10',
            'border' => 'border-orange-400/15',
            'gradient' => 'from-orange-400/10',
            'dot' => 'bg-orange-400 shadow-[0_0_8px_#fb923c]',
            'idle' => 'text-[#687582]',
            'hover' => 'group-hover:bg-orange-400/10 group-hover:text-orange-400',
        ],
        'yellow' => [
            'text' => 'text-yellow-400',
            'icon' => 'bg-yellow-400/10',
            'border' => 'border-yellow-400/15',
            'gradient' => 'from-yellow-400/10',
            'dot' => 'bg-yellow-400 shadow-[0_0_8px_#facc15]',
            'idle' => 'text-yellow-400/80',
            'hover' => 'group-hover:bg-yellow-400/10 group-hover:text-yellow-300',
        ],
        'red' => [
            'text' => 'text-red-400',
            'icon' => 'bg-red-400/10',
            'border' => 'border-red-400/15',
            'gradient' => 'from-red-400/10',
            'dot' => 'bg-red-400 shadow-[0_0_8px_#f87171]',
            'idle' => 'text-red-400/80',
            'hover' => 'group-hover:bg-red-400/10 group-hover:text-red-300',
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | Menu
    |--------------------------------------------------------------------------
    |
    | Each section has items.
    | Each item is either a link or a tree with children.
    | pattern supports Laravel route-name patterns.
    |
    */

    $unread = auth()->check()
        && method_exists(auth()->user(), 'unreadNotifications')
            ? auth()->user()->unreadNotifications()->count()
            : 0;

    $pending = null; // Connect to your pending-payment query when available.

    $menu = [
        [
            'title' => 'الرئيسية',
            'dot' => 'bg-[#00ff66]',
            'items' => [
                [
                    'label' => 'لوحة التحكم',
                    'icon' => 'fa-house',
                    'color' => 'green',
                    'route' => 'dashboard',
                    'pattern' => 'dashboard',
                ],
                [
                    'label' => 'نظرة عامة',
                    'icon' => 'fa-chart-pie',
                    'color' => 'green',
                    'route' => 'overview.index',
                ],
                [
                    'label' => 'مركز العمليات',
                    'icon' => 'fa-layer-group',
                    'color' => 'blue',
                    'route' => 'operations.index',
                ],
                [
                    'label' => 'الإشعارات',
                    'icon' => 'fa-bell',
                    'color' => 'yellow',
                    'route' => 'notifications.index',
                    'badge' => $unread ?: null,
                ],
            ],
        ],

        [
            'title' => 'إدارة التحصيل',
            'dot' => 'bg-[#00aaff]',
            'items' => [
                [
                    'label' => 'العملاء',
                    'icon' => 'fa-users',
                    'color' => 'blue',
                    'route' => 'clients.index',
                    'pattern' => ['clients.*'],
                ],
                [
                    'label' => 'القضايا والقروض',
                    'icon' => 'fa-file-invoice-dollar',
                    'color' => 'blue',
                    'children' => [
                        [
                            'label' => 'كل القضايا',
                            'route' => 'loans.index',
                            'pattern' => ['loans.*', 'debt-cases.*'],
                        ],
                        [
                            'label' => 'أنواع القروض',
                            'route' => 'loan-types.index',
                        ],
                        [
                            'label' => 'المحافظ',
                            'route' => 'portfolios.index',
                            'pattern' => ['portfolios.*'],
                        ],
                    ],
                ],
                [
                    'label' => 'المدفوعات',
                    'icon' => 'fa-money-bill-transfer',
                    'color' => 'green',
                    'route' => 'payments.index',
                    'pattern' => ['payments.*'],
                ],
                [
                    'label' => 'تأكيد التحصيلات',
                    'icon' => 'fa-circle-check',
                    'color' => 'green',
                    'route' => 'confirmations.index',
                    'pattern' => ['confirmations.*'],
                    'badge' => $pending,
                ],
                [
                    'label' => 'وعود السداد',
                    'icon' => 'fa-handshake',
                    'color' => 'green',
                    'route' => 'ptp.index',
                    'pattern' => ['ptp.*'],
                ],
                [
                    'label' => 'الزيارات الميدانية',
                    'icon' => 'fa-location-dot',
                    'color' => 'blue',
                    'route' => 'visits.index',
                    'fallback' => 'banks.index',
                    'pattern' => ['visits.*', 'banks.visits.*'],
                ],
                [
                    'label' => 'الشكاوى',
                    'icon' => 'fa-message',
                    'color' => 'orange',
                    'route' => 'complaints.index',
                    'fallback' => 'banks.index',
                    'pattern' => ['complaints.*', 'banks.complaints.*'],
                ],
                [
                    'label' => 'التقارير اليومية',
                    'icon' => 'fa-calendar-day',
                    'color' => 'blue',
                    'route' => 'dcr.index',
                    'fallback' => 'banks.index',
                    'pattern' => ['dcr.*', 'banks.dcr.*'],
                ],
            ],
        ],

        [
            'title' => 'المحافظ والمؤسسات',
            'dot' => 'bg-[#00ff66]',
            'items' => [
                [
                    'label' => 'البنوك',
                    'icon' => 'fa-building-columns',
                    'color' => 'green',
                    'children' => [
                        [
                            'label' => 'كل البنوك',
                            'route' => 'banks.index',
                            'pattern' => [
                                'banks.index',
                                'banks.show',
                                'banks.edit',
                                'banks.panel',
                                'banks.clients.*',
                                'banks.scope.*',
                                'banks.distribution.*',
                                'banks.dcr.*',
                                'banks.ptp.*',
                                'banks.complaints.*',
                                'banks.visits.*',
                                'banks.archives.*',
                            ],
                        ],
                        [
                            'label' => 'إضافة بنك',
                            'route' => 'banks.create',
                        ],
                        [
                            'label' => 'عملاء البنك',
                            'route' => 'banks.clients.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.clients.*',
                        ],
                        [
                            'label' => 'توزيع المحافظ',
                            'route' => 'banks.distribution.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.distribution.*',
                        ],
                        [
                            'label' => 'استيراد البيانات',
                            'route' => 'banks.scope.import',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.scope.*',
                        ],
                        [
                            'label' => 'وعود السداد',
                            'route' => 'banks.ptp.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.ptp.*',
                        ],
                        [
                            'label' => 'الزيارات الميدانية',
                            'route' => 'banks.visits.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.visits.*',
                        ],
                        [
                            'label' => 'الشكاوى',
                            'route' => 'banks.complaints.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.complaints.*',
                        ],
                        [
                            'label' => 'التقارير اليومية',
                            'route' => 'banks.dcr.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.dcr.*',
                        ],
                        [
                            'label' => 'أرشيف البنك',
                            'route' => 'banks.archives.index',
                            'fallback' => 'banks.index',
                            'pattern' => 'banks.archives.*',
                        ],
                    ],
                ],
                [
                    'label' => 'شركات التقسيط',
                    'icon' => 'fa-building',
                    'color' => 'blue',
                    'children' => [
                        [
                            'label' => 'كل الشركات',
                            'route' => 'installment-companies.index',
                            'pattern' => [
                                'installment-companies.index',
                                'installment-companies.edit',
                                'installment-companies.panel',
                            ],
                        ],
                        [
                            'label' => 'إضافة شركة',
                            'route' => 'installment-companies.create',
                        ],
                    ],
                ],
                [
                    'label' => 'الأرشيف الشهري',
                    'icon' => 'fa-box-archive',
                    'color' => 'red',
                    'route' => 'archives.index',
                    'pattern' => ['archives.*'],
                ],
            ],
        ],

        [
            'title' => 'الفريق والإدارة',
            'dot' => 'bg-[#a855f7]',
            'items' => [
                [
                    'label' => 'إدارة الموظفين',
                    'icon' => 'fa-user-group',
                    'color' => 'purple',
                    'children' => [
                        [
                            'label' => 'قائمة الموظفين',
                            'route' => 'employees.index',
                            'pattern' => ['employees.index', 'employees.show', 'employees.edit'],
                        ],
                        [
                            'label' => 'إضافة موظف',
                            'route' => 'employees.create',
                        ],
                        [
                            'label' => 'أداء الموظفين',
                            'route' => 'employees.performance',
                        ],
                    ],
                ],
                [
                    'label' => 'إدارة المستخدمين',
                    'icon' => 'fa-user-gear',
                    'color' => 'purple',
                    'children' => [
                        [
                            'label' => 'قائمة المستخدمين',
                            'route' => 'users.index',
                            'pattern' => ['users.*'],
                        ],
                        [
                            'label' => 'إضافة مستخدم',
                            'route' => 'users.create',
                        ],
                        [
                            'label' => 'الأدوار والصلاحيات',
                            'route' => 'roles.index',
                            'pattern' => ['roles.*'],
                        ],
                        [
                            'label' => 'إضافة دور',
                            'route' => 'roles.create',
                        ],
                    ],
                ],
                [
                    'label' => 'التقارير',
                    'icon' => 'fa-chart-column',
                    'color' => 'purple',
                    'children' => [
                        [
                            'label' => 'التقارير الرئيسية',
                            'route' => 'reports.index',
                            'pattern' => ['reports.index'],
                        ],
                        [
                            'label' => 'تصدير التقارير',
                            'route' => 'reports.exports',
                            'pattern' => ['reports.exports'],
                        ],
                    ],
                ],
                [
                    'label' => 'سجل النشاط',
                    'icon' => 'fa-clock-rotate-left',
                    'color' => 'orange',
                    'route' => 'activity-logs.index',
                    'pattern' => ['activity-logs.*'],
                ],
            ],
        ],

        [
            'title' => 'إعدادات النظام',
            'dot' => 'bg-yellow-400',
            'items' => [
                [
                    'label' => 'الإعدادات',
                    'icon' => 'fa-gear',
                    'color' => 'purple',
                    'children' => [
                        [
                            'label' => 'إعدادات النظام',
                            'route' => 'settings.index',
                        ],
                        [
                            'label' => 'أنواع القروض',
                            'route' => 'loan-types.index',
                        ],
                        [
                            'label' => 'المحافظات',
                            'route' => 'governorates.index',
                        ],
                    ],
                ],
            ],
        ],
    ];

    $authUser = auth()->user();
    $userName = $authUser?->name ?? 'المدير';
    $userRole = data_get($authUser, 'role.label', 'Administrator');
@endphp

<aside
    id="app-sidebar"
    class="fixed right-0 top-0 z-50 flex h-screen w-64 flex-col border-l border-white/5 bg-[#0b0f12] text-white shadow-2xl shadow-black/40"
    dir="rtl"
    aria-label="القائمة الرئيسية"
>
    {{-- Header --}}
    <div class="shrink-0 border-b border-white/5 px-5 py-5">
        <a
            href="{{ $resolveUrl('dashboard') ?? url('/') }}"
            class="flex items-center gap-3"
        >
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#00ff66] to-[#00b84d] text-black shadow-lg shadow-[#00ff66]/10">
                <i class="fa-solid fa-chart-line text-lg" aria-hidden="true"></i>
            </span>

            <span>
                <span class="block text-base font-bold tracking-wide text-white">
                    كولكس <span class="text-[#00ff66]">Collex</span>
                </span>
                <span class="mt-0.5 block text-[10px] text-[#64707c]">
                    نظام إدارة التحصيل
                </span>
            </span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav
        class="flex-1 overflow-y-auto px-3 py-5"
        style="scrollbar-width: thin; scrollbar-color: #263038 transparent;"
    >
        @foreach ($menu as $section)
            <section class="{{ $loop->last ? '' : 'mb-6' }}">
                <div class="mb-3 flex items-center gap-2 px-3">
                    <span class="h-1 w-1 shrink-0 rounded-full {{ $section['dot'] }}"></span>
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-[#52606d]">
                        {{ $section['title'] }}
                    </h2>
                </div>

                <div class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php
                            $color = $palette[$item['color'] ?? 'green'];
                            $children = $item['children'] ?? [];
                            $hasChildren = !empty($children);

                            $itemActive = $isActive(
                                $item['pattern'] ?? ($item['route'] ?? null)
                            );

                            $childActive = collect($children)->contains(
                                fn ($child) => $isActive(
                                    $child['pattern'] ?? ($child['route'] ?? null)
                                )
                            );

                            $groupActive = $itemActive || $childActive;

                            $itemUrl = $resolveUrl(
                                $item['route'] ?? null,
                                $item['fallback'] ?? null
                            );
                        @endphp

                        @if ($hasChildren)
                            <details
                                class="group/tree"
                                @if ($groupActive) open @endif
                            >
                                <summary
                                    @class([
                                        'group relative flex cursor-pointer list-none items-center gap-3 overflow-hidden rounded-xl border px-3 py-2.5 text-sm transition-all duration-200 [&::-webkit-details-marker]:hidden',
                                        "bg-gradient-to-l to-transparent {$color['border']} {$color['gradient']} {$color['text']}" => $groupActive,
                                        'border-transparent text-[#8c98a5] hover:bg-white/[.04] hover:text-white' => !$groupActive,
                                    ])
                                >
                                    <span
                                        @class([
                                            'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg transition-colors',
                                            "{$color['icon']} {$color['text']}" => $groupActive,
                                            "bg-white/[.03] {$color['idle']} {$color['hover']}" => !$groupActive,
                                        ])
                                    >
                                        <i
                                            class="fa-solid {{ $item['icon'] }} text-xs"
                                            aria-hidden="true"
                                        ></i>
                                    </span>

                                    <span @class([
                                        'min-w-0 flex-1 truncate',
                                        'font-semibold' => $groupActive,
                                    ])>
                                        {{ $item['label'] }}
                                    </span>

                                    <i
                                        class="fa-solid fa-chevron-left shrink-0 text-[9px] opacity-60 transition-transform duration-200 group-open/tree:-rotate-90"
                                        aria-hidden="true"
                                    ></i>
                                </summary>

                                {{-- Child tree --}}
                                <ul class="relative mr-7 mb-2 mt-1 space-y-0.5 border-r border-white/10">
                                    @foreach ($children as $child)
                                        @php
                                            $childActive = $isActive(
                                                $child['pattern'] ?? ($child['route'] ?? null)
                                            );

                                            $childUrl = $resolveUrl(
                                                $child['route'] ?? null,
                                                $child['fallback'] ?? null
                                            );
                                        @endphp

                                        <li class="relative">
                                            <span
                                                @class([
                                                    'absolute right-[-3.5px] top-1/2 h-[7px] w-[7px] -translate-y-1/2 rounded-full',
                                                    $color['dot'] => $childActive,
                                                    'bg-[#33414d]' => !$childActive,
                                                ])
                                                aria-hidden="true"
                                            ></span>

                                            @if ($childUrl)
                                                <a
                                                    href="{{ $childUrl }}"
                                                    @if ($childActive) aria-current="page" @endif
                                                    @class([
                                                        'relative flex min-h-8 items-center rounded-lg py-1.5 pr-5 pl-2 text-[12px] transition-colors duration-200',
                                                        'font-semibold text-white' => $childActive,
                                                        'text-[#8c98a5] hover:bg-white/[.04] hover:text-white' => !$childActive,
                                                    ])
                                                >
                                                    <span class="min-w-0 flex-1 truncate">
                                                        {{ $child['label'] }}
                                                    </span>

                                                    @if (!Route::has($child['route'] ?? ''))
                                                        <span class="mr-auto shrink-0 rounded bg-white/[.06] px-1.5 py-0.5 text-[9px] text-[#5f6b77]">
                                                            قريباً
                                                        </span>
                                                    @endif
                                                </a>
                                            @else
                                                <span
                                                    class="relative flex min-h-8 cursor-not-allowed items-center rounded-lg py-1.5 pr-5 pl-2 text-[12px] text-[#687582] opacity-60"
                                                    aria-disabled="true"
                                                >
                                                    <span class="min-w-0 flex-1 truncate">
                                                        {{ $child['label'] }}
                                                    </span>
                                                    <span class="mr-auto shrink-0 rounded bg-white/[.06] px-1.5 py-0.5 text-[9px]">
                                                        قريباً
                                                    </span>
                                                </span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        @else
                            {{-- Single page --}}
                            @if ($itemUrl)
                                <a
                                    href="{{ $itemUrl }}"
                                    @if ($itemActive) aria-current="page" @endif
                                    @class([
                                        'group flex min-h-11 items-center gap-3 rounded-xl border px-3 py-2 text-sm transition-all duration-200',
                                        "border-transparent {$color['text']} bg-white/[.025]" => $itemActive,
                                        'border-transparent text-[#8c98a5] hover:bg-white/[.04] hover:text-white' => !$itemActive,
                                    ])
                                >
                                    <span
                                        @class([
                                            'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg',
                                            "{$color['icon']} {$color['text']}" => $itemActive,
                                            "bg-white/[.03] {$color['idle']} {$color['hover']}" => !$itemActive,
                                        ])
                                    >
                                        <i
                                            class="fa-solid {{ $item['icon'] }} text-xs"
                                            aria-hidden="true"
                                        ></i>
                                    </span>

                                    <span class="min-w-0 flex-1 truncate">
                                        {{ $item['label'] }}
                                    </span>

                                    @if (!empty($item['badge']))
                                        <span class="rounded-md bg-red-500/15 px-1.5 py-0.5 text-[9px] font-bold text-red-400">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif

                                    @if ($itemActive)
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full {{ $color['dot'] }}"></span>
                                    @endif
                                </a>
                            @else
                                <span
                                    class="flex min-h-11 cursor-not-allowed items-center gap-3 rounded-xl px-3 py-2 text-sm text-[#687582] opacity-60"
                                    aria-disabled="true"
                                    title="المسار غير مسجل"
                                >
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/[.03]">
                                        <i class="fa-solid {{ $item['icon'] }} text-xs" aria-hidden="true"></i>
                                    </span>

                                    <span class="min-w-0 flex-1 truncate">
                                        {{ $item['label'] }}
                                    </span>

                                    <span class="text-[9px]">قريباً</span>
                                </span>
                            @endif
                        @endif
                    @endforeach
                </div>
            </section>
        @endforeach
    </nav>

    {{-- User footer --}}
    <div class="shrink-0 border-t border-white/5 p-3">
        <div class="flex items-center gap-3 rounded-xl border border-white/5 bg-white/[.025] p-3">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#00ff66]/10 text-xs font-bold text-[#00ff66]">
                {{ mb_strtoupper(mb_substr($userName, 0, 1)) }}
            </span>

            <span class="min-w-0 flex-1">
                <span class="block truncate text-xs font-semibold text-white">
                    {{ $userName }}
                </span>
                <span class="block truncate text-[10px] text-[#5f6b77]">
                    {{ $userRole }}
                </span>
            </span>

            <details class="group/account relative">
                <summary
                    class="flex h-8 w-8 cursor-pointer list-none items-center justify-center rounded-lg text-[#65717d] transition hover:bg-white/[.05] hover:text-white [&::-webkit-details-marker]:hidden"
                    aria-label="قائمة الحساب"
                >
                    <i class="fa-solid fa-ellipsis-vertical" aria-hidden="true"></i>
                </summary>

                <div class="absolute bottom-full left-0 z-50 mb-2 w-52 rounded-xl border border-white/10 bg-[#11161a] p-1 shadow-xl shadow-black/50">
                    @if (Route::has('account.edit'))
                        <a
                            href="{{ route('account.edit') }}"
                            class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs text-[#8c98a5] transition hover:bg-white/[.06] hover:text-white"
                        >
                            <i class="fa-solid fa-user w-4 text-[#00aaff]" aria-hidden="true"></i>
                            حسابي
                        </a>

                        <a
                            href="{{ route('account.edit') }}#password"
                            class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs text-[#8c98a5] transition hover:bg-white/[.06] hover:text-white"
                        >
                            <i class="fa-solid fa-key w-4 text-yellow-400" aria-hidden="true"></i>
                            تغيير كلمة المرور
                        </a>
                    @endif

                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs text-red-400 transition hover:bg-red-400/10"
                            >
                                <i class="fa-solid fa-right-from-bracket w-4" aria-hidden="true"></i>
                                تسجيل الخروج
                            </button>
                        </form>
                    @endif
                </div>
            </details>
        </div>
    </div>
</aside>