<?php
    $menu = [
        ['section' => 'الرئيسية', 'items' => [
            ['label' => 'لوحة التحكم', 'icon' => 'fa-chart-pie', 'route' => 'dashboard'],
            ['label' => 'نظرة عامة', 'icon' => 'fa-compass', 'route' => 'overview.index'],
            ['label' => 'مركز العمليات', 'icon' => 'fa-layer-group', 'route' => 'operations.index'],
        ]],
        ['section' => 'إدارة التحصيل', 'items' => [
            ['label' => 'العملاء', 'icon' => 'fa-users', 'route' => 'clients.index'],
            ['label' => 'القضايا والقروض', 'icon' => 'fa-file-invoice-dollar', 'route' => 'loans.index'],
            ['label' => 'المدفوعات', 'icon' => 'fa-money-bill-transfer', 'route' => 'payments.index'],
            ['label' => 'مراجعة المدفوعات', 'icon' => 'fa-circle-check', 'route' => 'payments.confirmations'],
            ['label' => 'وعود السداد', 'icon' => 'fa-handshake', 'route' => 'ptp.index'],
            ['label' => 'الزيارات الميدانية', 'icon' => 'fa-location-dot', 'route' => 'banks.visits.index'],
            ['label' => 'الشكاوى', 'icon' => 'fa-message', 'route' => 'banks.complaints.index'],
        ]],
        ['section' => 'المحافظ والمؤسسات', 'items' => [
            ['label' => 'البنوك', 'icon' => 'fa-building-columns', 'route' => 'banks.index'],
            ['label' => 'شركات التقسيط', 'icon' => 'fa-shop', 'route' => 'installment-companies.index'],
            ['label' => 'توزيع المحافظ', 'icon' => 'fa-diagram-project', 'route' => 'banks.distribution.index'],
            ['label' => 'استيراد البيانات', 'icon' => 'fa-file-import', 'route' => 'banks.scope.import'],
            ['label' => 'الأرشيف الشهري', 'icon' => 'fa-box-archive', 'route' => 'archives.index'],
        ]],
        ['section' => 'الفريق والإدارة', 'items' => [
            ['label' => 'الموظفون', 'icon' => 'fa-user-group', 'route' => 'employees.index'],
            ['label' => 'المستخدمون', 'icon' => 'fa-user-gear', 'route' => 'users.index'],
            ['label' => 'الأدوار والصلاحيات', 'icon' => 'fa-shield-halved', 'route' => 'roles.index'],
            ['label' => 'التقارير', 'icon' => 'fa-chart-column', 'route' => 'reports.index'],
            ['label' => 'سجل النشاط', 'icon' => 'fa-clock-rotate-left', 'route' => 'activity-logs.index'],
            ['label' => 'الإشعارات', 'icon' => 'fa-bell', 'route' => 'notifications.index'],
        ]],
        ['section' => 'إعدادات النظام', 'items' => [
            ['label' => 'أنواع القروض', 'icon' => 'fa-list-check', 'route' => 'loan-types.index'],
            ['label' => 'المحافظات', 'icon' => 'fa-map-location-dot', 'route' => 'governorates.index'],
            ['label' => 'الإعدادات', 'icon' => 'fa-sliders', 'route' => 'settings.index'],
        ]],
    ];
    $currentRoute = request()->route()?->getName() ?? '';
    $routeIsActive = static fn (string $name): bool => $name !== '' && ($currentRoute === $name || str_starts_with($currentRoute, $name . '.'));
?>
<aside id="app-sidebar" class="app-sidebar" aria-label="القائمة الرئيسية">
    <div class="flex h-[82px] shrink-0 items-center gap-3 border-b border-white/[.07] px-5">
        <a href="<?php echo e(\Illuminate\Support\Facades\Route::has('dashboard') ? route('dashboard') : url('/')); ?>" class="flex min-w-0 items-center gap-3">
            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-[14px] bg-brand text-black shadow-lg shadow-brand/10"><i class="fa-solid fa-chart-line text-lg"></i></span>
            <span class="min-w-0"><span class="block text-lg font-black tracking-wide text-white">كولكس <span class="text-brand">Collex</span></span><span class="mt-0.5 block text-[9px] font-semibold tracking-wide text-[#738279]">إدارة التحصيل بذكاء</span></span>
        </a>
        <button type="button" class="mr-auto grid h-8 w-8 place-items-center rounded-lg text-muted hover:bg-white/5 hover:text-white lg:hidden" data-sidebar-close aria-label="إغلاق القائمة"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <nav class="nav-scroll flex-1 overflow-y-auto px-3 py-5">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <section class="mb-6 last:mb-0"><p class="mb-2 px-3 text-[9px] font-extrabold tracking-[.13em] text-[#58675e]"><?php echo e($section['section']); ?></p><div class="space-y-1">
                <?php $__currentLoopData = $section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($exists = \Illuminate\Support\Facades\Route::has($item['route'])); ?>
                    <?php ($active = $exists && $routeIsActive($item['route'])); ?>
                    <a href="<?php echo e($exists ? route($item['route']) : 'javascript:void(0)'); ?>" <?php if($active): ?> aria-current="page" <?php endif; ?> <?php if(!$exists): ?> aria-disabled="true" title="واجهة موجودة ضمن التصميم؛ يلزم تسجيل المسار لتفعيل التنقل" <?php endif; ?> class="nav-link <?php echo e($active ? 'active' : ''); ?> <?php echo e(!$exists ? 'opacity-60' : ''); ?>">
                        <span class="nav-icon"><i class="fa-solid <?php echo e($item['icon']); ?>"></i></span><span class="min-w-0 flex-1 truncate"><?php echo e($item['label']); ?></span>
                        <?php if(!$exists): ?><span class="rounded-md border border-white/[.08] px-1.5 py-0.5 text-[8px] text-dim">غير مربوط</span><?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div></section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
    <div class="shrink-0 border-t border-white/[.07] p-3">
        <?php if(\Illuminate\Support\Facades\Route::has('account.edit')): ?><a href="<?php echo e(route('account.edit')); ?>" class="mb-2 flex items-center gap-3 rounded-xl border border-white/[.06] bg-white/[.025] p-3"><?php else: ?><div class="mb-2 flex items-center gap-3 rounded-xl border border-white/[.06] bg-white/[.025] p-3"><?php endif; ?>
            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-brand/10 text-xs font-black text-brand"><?php echo e(mb_strtoupper(mb_substr(auth()->user()?->name ?? 'C', 0, 1))); ?></span>
            <span class="min-w-0 flex-1"><span class="block truncate text-[11px] font-extrabold text-white"><?php echo e(auth()->user()?->name ?? 'مستخدم النظام'); ?></span><span class="mt-0.5 block truncate text-[9px] text-[#77867c]"><?php echo e(data_get(auth()->user(), 'role.label', 'عضو الفريق')); ?></span></span><i class="fa-solid fa-user-gear text-xs text-dim"></i>
        <?php if(\Illuminate\Support\Facades\Route::has('account.edit')): ?></a><?php else: ?></div><?php endif; ?>
        <?php if(\Illuminate\Support\Facades\Route::has('logout')): ?><form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/[.07] px-3 py-2.5 text-[11px] font-bold text-muted transition hover:border-danger/20 hover:bg-danger/5 hover:text-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> تسجيل الخروج</button></form><?php endif; ?>
    </div>
</aside>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/layouts/partials/_aside.blade.php ENDPATH**/ ?>