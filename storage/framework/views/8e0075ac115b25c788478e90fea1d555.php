<?php $__env->startSection('title', 'عملاء البنك'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="space-y-6">

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'عملاء البنك','subtitle' => 'عرض العملاء المرتبطين بحالات مديونية تابعة للبنك.','eyebrow' => 'البنوك / العملاء','icon' => 'fa-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'عملاء البنك','subtitle' => 'عرض العملاء المرتبطين بحالات مديونية تابعة للبنك.','eyebrow' => 'البنوك / العملاء','icon' => 'fa-users']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a
                href="<?php echo e(route('banks.clients.assign', ['bank' => $bank->id])); ?>"
                class="app-btn app-btn-primary"
            >
                <i class="fa-solid fa-layer-group"></i>
                توزيع الحالات
            </a>
         <?php $__env->endSlot(); ?>
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

    <?php if(session('success')): ?>
        <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'بيانات العملاء','subtitle' => 'البنك: '.e($bank->name).'','icon' => 'fa-user-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'بيانات العملاء','subtitle' => 'البنك: '.e($bank->name).'','icon' => 'fa-user-group']); ?>
        <form
            method="GET"
            action="<?php echo e(route('banks.clients.index', ['bank' => $bank->id])); ?>"
            class="mb-5 flex flex-col gap-3 sm:flex-row"
        >
            <input
                type="search"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="ابحث بالاسم أو كود العميل أو الرقم القومي..."
                class="app-input min-w-0 flex-1"
            >

            <button type="submit" class="app-btn app-btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                بحث
            </button>

            <?php if($search !== ''): ?>
                <a
                    href="<?php echo e(route('banks.clients.index', ['bank' => $bank->id])); ?>"
                    class="app-btn app-btn-secondary"
                >
                    مسح البحث
                </a>
            <?php endif; ?>
        </form>

        <div class="mb-4 flex flex-wrap gap-3 text-sm text-gray-400">
            <span>
                إجمالي النتائج:
                <strong class="text-emerald-300"><?php echo e($clients->total()); ?></strong>
            </span>
            <span>
                البنك:
                <strong class="text-white"><?php echo e($bank->name); ?></strong>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] text-right text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-4 py-3 font-medium">اسم العميل</th>
                        <th class="px-4 py-3 font-medium">كود العميل</th>
                        <th class="px-4 py-3 font-medium">الرقم القومي</th>
                        <th class="px-4 py-3 font-medium">المحافظة</th>
                        <th class="px-4 py-3 font-medium">عدد الحالات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition hover:bg-white/[0.03]">
                            <td class="px-4 py-4 font-semibold">
                                <?php echo e($client->name); ?>

                            </td>
                            <td class="px-4 py-4">
                                <?php echo e($client->code ?: '—'); ?>

                            </td>
                            <td class="px-4 py-4">
                                <?php echo e($client->national_id ?: '—'); ?>

                            </td>
                            <td class="px-4 py-4">
                                <?php echo e($client->governorate?->name ?? '—'); ?>

                            </td>
                            <td class="px-4 py-4">
                                <span class="rounded-lg bg-emerald-500/10 px-3 py-1 text-emerald-300">
                                    <?php echo e($client->bank_cases_count); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-400">
                                <?php if($search !== ''): ?>
                                    لا توجد نتائج مطابقة لعبارة البحث.
                                <?php else: ?>
                                    لا يوجد عملاء مرتبطون بحالات مديونية لهذا البنك.
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5 border-t border-white/10 pt-5">
            <?php echo e($clients->links()); ?>

        </div>
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/clients/index.blade.php ENDPATH**/ ?>