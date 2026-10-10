<?php $__env->startSection('title', 'العملاء'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'العملاء','subtitle' => 'إدارة ملفات العملاء وبيانات التواصل والهوية في مكان واحد.','eyebrow' => 'إدارة العملاء','icon' => 'fa-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'العملاء','subtitle' => 'إدارة ملفات العملاء وبيانات التواصل والهوية في مكان واحد.','eyebrow' => 'إدارة العملاء','icon' => 'fa-users']); ?>
     <?php $__env->slot('actions', null, []); ?> <a href="<?php echo e(route('clients.create')); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-user-plus"></i> إضافة عميل جديد</a> <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<div class="mb-5 grid gap-3 sm:grid-cols-3"><div class="app-card flex items-center gap-3 p-4"><span class="grid h-10 w-10 place-items-center rounded-xl bg-brand/10 text-brand"><i class="fa-solid fa-users"></i></span><div><p class="text-[10px] font-bold text-dim">النتائج المعروضة</p><p class="mt-1 text-lg font-extrabold"><?php echo e(number_format($clients->total() ?? $clients->count())); ?></p></div></div><div class="app-card flex items-center gap-3 p-4 sm:col-span-2"><i class="fa-solid fa-circle-info text-brand"></i><p class="text-[10px] leading-5 text-muted">ابحث بالاسم أو كود العميل أو الرقم القومي. يتم عرض النتائج على صفحات لتسهيل التعامل مع السجلات الكبيرة.</p></div></div>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'دليل العملاء','subtitle' => 'استخدم البحث للوصول السريع إلى سجل العميل','icon' => 'fa-address-book','padding' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'دليل العملاء','subtitle' => 'استخدم البحث للوصول السريع إلى سجل العميل','icon' => 'fa-address-book','padding' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
     <?php $__env->slot('actions', null, []); ?> <form method="GET" action="<?php echo e(route('clients.index')); ?>" class="flex w-full flex-wrap gap-2 sm:w-auto"><div class="relative min-w-[220px] flex-1 sm:flex-none"><i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-[11px] text-dim"></i><input class="app-input pr-9 sm:w-72" name="q" value="<?php echo e(request('q')); ?>" placeholder="الاسم، الكود، الرقم القومي"></div><button class="app-btn app-btn-secondary"><i class="fa-solid fa-filter"></i> بحث</button><?php if(request()->filled('q')): ?><a href="<?php echo e(route('clients.index')); ?>" class="app-btn app-btn-secondary">مسح</a><?php endif; ?></form> <?php $__env->endSlot(); ?>
    <div class="overflow-x-auto"><table class="app-table"><thead><tr><th>العميل</th><th>كود العميل</th><th>الرقم القومي</th><th>المحافظة</th><th>تاريخ الإضافة</th><th class="text-center">الإجراءات</th></tr></thead><tbody>
    <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td><div class="flex items-center gap-3"><?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['name' => $client->name,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->name),'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $attributes = $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $component = $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?><div><a href="<?php echo e(route('clients.show', $client)); ?>" class="text-xs font-extrabold text-fg hover:text-brand"><?php echo e($client->name); ?></a><p class="mt-1 text-[9px] text-dim"><?php echo e($client->email ?? 'لا يوجد بريد إلكتروني'); ?></p></div></div></td><td><span class="rounded-lg bg-white/[0.025] px-2 py-1 font-mono text-[10px] font-bold text-muted"><?php echo e($client->code); ?></span></td><td class="font-mono text-muted"><?php echo e($client->national_id); ?></td><td><?php echo e($client->governorate?->name ?? '—'); ?></td><td class="whitespace-nowrap text-muted"><?php echo e($client->created_at?->format('Y-m-d') ?? '—'); ?></td><td><div class="flex items-center justify-center gap-1"><?php if (isset($component)) { $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-icon','data' => ['href' => route('clients.show', $client),'icon' => 'fa-eye','label' => 'عرض','tone' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('clients.show', $client)),'icon' => 'fa-eye','label' => 'عرض','tone' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $attributes = $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $component = $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-icon','data' => ['href' => route('clients.edit', $client),'icon' => 'fa-pen','label' => 'تعديل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('clients.edit', $client)),'icon' => 'fa-pen','label' => 'تعديل']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $attributes = $__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__attributesOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729)): ?>
<?php $component = $__componentOriginal2b612bcbad651c78da47ba0e8d4b3729; ?>
<?php unset($__componentOriginal2b612bcbad651c78da47ba0e8d4b3729); ?>
<?php endif; ?><form method="POST" action="<?php echo e(route('clients.destroy', $client)); ?>" onsubmit="return confirm('هل تريد حذف هذا العميل؟')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="inline-grid h-8 w-8 place-items-center rounded-lg border border-danger/20 bg-danger/10 text-[11px] text-danger" title="حذف" aria-label="حذف"><i class="fa-solid fa-trash"></i></button></form></div></td></tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6"><?php if (isset($component)) { $__componentOriginal074a021b9d42f490272b5eefda63257c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal074a021b9d42f490272b5eefda63257c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty-state','data' => ['title' => 'لا توجد سجلات مطابقة','description' => 'غيّر كلمات البحث أو ابدأ بإضافة عميل جديد.','icon' => 'fa-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'لا توجد سجلات مطابقة','description' => 'غيّر كلمات البحث أو ابدأ بإضافة عميل جديد.','icon' => 'fa-users']); ?> <?php $__env->slot('action', null, []); ?> <a href="<?php echo e(route('clients.create')); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-plus"></i> إضافة عميل</a> <?php $__env->endSlot(); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $attributes = $__attributesOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__attributesOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal074a021b9d42f490272b5eefda63257c)): ?>
<?php $component = $__componentOriginal074a021b9d42f490272b5eefda63257c; ?>
<?php unset($__componentOriginal074a021b9d42f490272b5eefda63257c); ?>
<?php endif; ?></td></tr><?php endif; ?>
    </tbody></table></div>
    <?php if(method_exists($clients, 'links')): ?><div class="flex flex-wrap items-center justify-between gap-3 border-t border-line px-5 py-4"><p class="text-[10px] text-dim">عرض <?php echo e($clients->firstItem() ?? 0); ?>–<?php echo e($clients->lastItem() ?? 0); ?> من <?php echo e($clients->total() ?? 0); ?> سجل</p><div class="text-xs"><?php echo e($clients->links()); ?></div></div><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/index.blade.php ENDPATH**/ ?>