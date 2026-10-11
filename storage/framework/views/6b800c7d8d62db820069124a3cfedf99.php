<?php $__env->startSection('title', 'إدارة الصلاحيات - Collex'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6" dir="rtl">

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'إدارة الصلاحيات','subtitle' => 'تعريف صلاحيات النظام وربطها بالأدوار.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'إدارة الصلاحيات','subtitle' => 'تعريف صلاحيات النظام وربطها بالأدوار.']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('roles.index')); ?>" class="app-btn">
                <i class="fa-solid fa-user-shield ml-2"></i>
                إدارة الأدوار
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

    <?php if (isset($component)) { $__componentOriginal5168fdb0c14fd91c6598264bc4be63f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2)): ?>
<?php $attributes = $__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2; ?>
<?php unset($__attributesOriginal5168fdb0c14fd91c6598264bc4be63f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5168fdb0c14fd91c6598264bc4be63f2)): ?>
<?php $component = $__componentOriginal5168fdb0c14fd91c6598264bc4be63f2; ?>
<?php unset($__componentOriginal5168fdb0c14fd91c6598264bc4be63f2); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'إضافة صلاحية']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'إضافة صلاحية']); ?>
        <form action="<?php echo e(route('permissions.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="name" class="mb-2 block text-sm text-slate-300">
                        الاسم البرمجي
                    </label>
                    <input
                        id="name"
                        name="name"
                        value="<?php echo e(old('name')); ?>"
                        class="app-input w-full"
                        placeholder="banks.view"
                        maxlength="100"
                        pattern="[A-Za-z][A-Za-z0-9_.]*"
                        required
                    >
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="label" class="mb-2 block text-sm text-slate-300">
                        اسم الصلاحية
                    </label>
                    <input
                        id="label"
                        name="label"
                        value="<?php echo e(old('label')); ?>"
                        class="app-input w-full"
                        placeholder="عرض البنوك"
                        maxlength="255"
                        required
                    >
                    <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="group" class="mb-2 block text-sm text-slate-300">
                        المجموعة
                    </label>
                    <input
                        id="group"
                        name="group"
                        value="<?php echo e(old('group')); ?>"
                        class="app-input w-full"
                        placeholder="banks"
                        maxlength="100"
                        pattern="[A-Za-z][A-Za-z0-9_]*"
                        required
                    >
                    <?php $__errorArgs = ['group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-plus ml-2"></i>
                    إضافة الصلاحية
                </button>
            </div>
        </form>
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

    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'الصلاحيات المسجلة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الصلاحيات المسجلة']); ?>
        <div class="table-wrap w-full overflow-x-auto">
            <table class="data-table w-full min-w-[850px]">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصلاحية</th>
                        <th>الاسم البرمجي</th>
                        <th>المجموعة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($permissions instanceof \Illuminate\Contracts\Pagination\Paginator ? $permissions->firstItem() + $loop->index : $loop->iteration); ?></td>

                            <td class="font-medium text-white">
                                <?php echo e($permission->label); ?>

                            </td>

                            <td>
                                <code><?php echo e($permission->name); ?></code>
                            </td>

                            <td><?php echo e($permission->group); ?></td>

                            <td>
                                <div class="flex flex-wrap items-center gap-2">
                                    <details class="relative">
                                        <summary
                                            class="icon-btn icon-btn-info cursor-pointer"
                                            title="تعديل الصلاحية"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </summary>

                                        <div class="absolute left-0 z-20 mt-2 w-80 rounded-xl border border-white/10 bg-[#111418] p-4 shadow-xl">
                                            <form
                                                action="<?php echo e(route('permissions.update', $permission)); ?>"
                                                method="POST"
                                                class="space-y-3"
                                            >
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        الاسم البرمجي
                                                    </label>
                                                    <input
                                                        name="name"
                                                        value="<?php echo e($permission->name); ?>"
                                                        class="app-input w-full"
                                                        maxlength="100"
                                                        required
                                                    >
                                                </div>

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        اسم الصلاحية
                                                    </label>
                                                    <input
                                                        name="label"
                                                        value="<?php echo e($permission->label); ?>"
                                                        class="app-input w-full"
                                                        maxlength="255"
                                                        required
                                                    >
                                                </div>

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        المجموعة
                                                    </label>
                                                    <input
                                                        name="group"
                                                        value="<?php echo e($permission->group); ?>"
                                                        class="app-input w-full"
                                                        maxlength="100"
                                                        required
                                                    >
                                                </div>

                                                <button type="submit" class="app-btn app-btn-primary w-full">
                                                    حفظ التعديلات
                                                </button>
                                            </form>
                                        </div>
                                    </details>

                                    <form
                                        action="<?php echo e(route('permissions.destroy', $permission)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('سيتم حذف الصلاحية من جميع الأدوار والمستخدمين. هل تريد المتابعة؟')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="icon-btn icon-btn-danger"
                                            title="حذف الصلاحية"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                لا توجد صلاحيات مسجلة.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($permissions instanceof \Illuminate\Contracts\Pagination\Paginator): ?>
            <div class="mt-5">
                <?php echo e($permissions->links()); ?>

            </div>
        <?php endif; ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/roles/index.blade.php ENDPATH**/ ?>