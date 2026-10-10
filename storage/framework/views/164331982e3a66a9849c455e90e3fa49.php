<?php $__env->startSection('title', 'الإشعارات'); ?>
<?php $__env->startSection('topbar-title', 'الإشعارات'); ?>
<?php $__env->startSection('content'); ?>
<?php ($records = $notifications ?? $items ?? auth()->user()?->notifications ?? collect()); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'الإشعارات','subtitle' => 'تابع التنبيهات المتعلقة بالمدفوعات والوعود والمهام والتغييرات المهمة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-bell']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الإشعارات','subtitle' => 'تابع التنبيهات المتعلقة بالمدفوعات والوعود والمهام والتغييرات المهمة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-bell']); ?> <?php $__env->slot('actions', null, []); ?> <?php if(\Illuminate\Support\Facades\Route::has('notifications.read-all')): ?><form method="POST" action="<?php echo e(route('notifications.read-all')); ?>"><?php echo csrf_field(); ?><button class="app-btn app-btn-secondary"><i class="fa-solid fa-check-double"></i> تحديد الكل كمقروء</button></form><?php endif; ?> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="app-card divide-y divide-line"><?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php ($payload = is_array($notification->data ?? null) ? $notification->data : (array)($notification->data ?? [])); ?><article class="flex gap-3 p-4 sm:p-5"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl <?php echo e(($notification->read_at ?? null) ? 'bg-white/[0.03] text-muted' : 'bg-brand/10 text-brand'); ?>"><i class="fa-solid fa-bell"></i></span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-start justify-between gap-2"><h2 class="text-xs font-extrabold text-fg"><?php echo e(data_get($payload, 'title', data_get($payload, 'message', 'إشعار من النظام'))); ?></h2><span class="text-[10px] text-dim"><?php echo e($notification->created_at?->format('Y-m-d H:i') ?? '—'); ?></span></div><p class="mt-1 text-[11px] leading-6 text-muted"><?php echo e(data_get($payload, 'body', data_get($payload, 'description', ''))); ?></p><?php if(!($notification->read_at ?? null)): ?><span class="mt-2 inline-flex items-center gap-1.5 text-[9px] font-bold text-brand"><span class="h-1.5 w-1.5 rounded-full bg-brand"></span> غير مقروء</span><?php endif; ?></div><?php if(\Illuminate\Support\Facades\Route::has('notifications.read') && !($notification->read_at ?? null)): ?><form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>"><?php echo csrf_field(); ?><button class="app-btn app-btn-ghost">تعليم كمقروء</button></form><?php endif; ?></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'أنت على اطلاع','description' => 'لا توجد إشعارات لعرضها حاليًا. ستظهر هنا التنبيهات الجديدة عند ورودها.','icon' => 'fa-bell-slash']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'أنت على اطلاع','description' => 'لا توجد إشعارات لعرضها حاليًا. ستظهر هنا التنبيهات الجديدة عند ورودها.','icon' => 'fa-bell-slash']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?><?php endif; ?></div>
<?php if(is_object($records) && method_exists($records, 'links')): ?><div class="mt-4"><?php echo e($records->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/notifications/index.blade.php ENDPATH**/ ?>