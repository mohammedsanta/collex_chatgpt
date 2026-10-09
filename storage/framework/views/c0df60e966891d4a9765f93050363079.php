<?php $__env->startSection('title', 'صلاحيات المستخدم'); ?>
<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'صلاحيات المستخدم','subtitle' => 'إدارة الصلاحيات الموروثة والاستثناءات الفردية للحساب.','eyebrow' => 'إدارة المستخدمين / الصلاحيات','icon' => 'fa-shield-halved']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'صلاحيات المستخدم','subtitle' => 'إدارة الصلاحيات الموروثة والاستثناءات الفردية للحساب.','eyebrow' => 'إدارة المستخدمين / الصلاحيات','icon' => 'fa-shield-halved']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('users.show', $user)); ?>" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للمستخدم
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

    <?php if($user->is_system_account): ?>
        <div class="mb-5 rounded-xl border border-orange-500/20 bg-orange-500/5 p-4 text-xs text-orange-400">
            <i class="fa-solid fa-shield-halved ml-2"></i>
            هذا حساب نظام. لا يمكن تعديل صلاحياته من هذه الصفحة.
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 p-4 text-xs text-red-400">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="mb-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'ملخص الحساب','icon' => 'fa-user-shield']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'ملخص الحساب','icon' => 'fa-user-shield']); ?>

            <div class="grid gap-4 sm:grid-cols-3">

                <div>
                    <p class="text-[10px] text-dim">المستخدم</p>
                    <p class="mt-1 text-xs font-extrabold"><?php echo e($user->name); ?></p>
                </div>

                <div>
                    <p class="text-[10px] text-dim">الدور الحالي</p>
                    <p class="mt-1 text-xs font-extrabold">
                        <?php echo e($user->role?->label ?? $user->role?->name ?? 'بدون دور'); ?>

                    </p>
                </div>

                <div>
                    <p class="text-[10px] text-dim">عدد الصلاحيات المتاحة بالنظام</p>
                    <p class="mt-1 text-xs font-extrabold">
                        <?php echo e($permissions->flatten()->count()); ?>

                    </p>
                </div>

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

    <form
        method="POST"
        action="<?php echo e(route('users.permissions.update', $user)); ?>"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $groupPermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-5">
                <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => $group,'icon' => 'fa-key']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group),'icon' => 'fa-key']); ?>

                    <div class="space-y-3">

                        <?php $__currentLoopData = $groupPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $override = $user->permissions->firstWhere('id', $permission->id);

                                $setting = $override === null
                                    ? 'inherit'
                                    : ((bool) $override->pivot->granted ? 'granted' : 'revoked');

                                $roleHasPermission = $user->role
                                    ? $user->role->permissions->contains('id', $permission->id)
                                    : false;
                            ?>

                            <div class="grid gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-3 md:grid-cols-[minmax(0,1fr)_220px] md:items-center">

                                <div>
                                    <p class="text-xs font-bold">
                                        <?php echo e($permission->label); ?>

                                    </p>

                                    <p class="mt-1 break-all text-[10px] text-dim">
                                        <?php echo e($permission->name); ?>

                                    </p>

                                    <p class="mt-1 text-[10px] text-dim">
                                        صلاحية الدور:
                                        <?php if($roleHasPermission): ?>
                                            <span class="text-brand">ممنوحة</span>
                                        <?php else: ?>
                                            <span>غير ممنوحة</span>
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <div>
                                    <label
                                        for="permission_<?php echo e($permission->id); ?>"
                                        class="mb-1 block text-[10px] text-dim"
                                    >
                                        الاستثناء الشخصي
                                    </label>

                                    <select
                                        id="permission_<?php echo e($permission->id); ?>"
                                        name="permissions[<?php echo e($permission->id); ?>]"
                                        class="app-input w-full"
                                        <?php if($user->is_system_account): echo 'disabled'; endif; ?>
                                    >
                                        <option
                                            value="inherit"
                                            <?php if(old("permissions.{$permission->id}", $setting) === 'inherit'): echo 'selected'; endif; ?>
                                        >
                                            استخدام صلاحية الدور
                                        </option>

                                        <option
                                            value="granted"
                                            <?php if(old("permissions.{$permission->id}", $setting) === 'granted'): echo 'selected'; endif; ?>
                                        >
                                            منح الصلاحية لهذا المستخدم
                                        </option>

                                        <option
                                            value="revoked"
                                            <?php if(old("permissions.{$permission->id}", $setting) === 'revoked'): echo 'selected'; endif; ?>
                                        >
                                            منع الصلاحية لهذا المستخدم
                                        </option>
                                    </select>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if (! ($user->is_system_account)): ?>
            <div class="flex flex-wrap justify-end gap-3">
                <a href="<?php echo e(route('users.show', $user)); ?>" class="app-btn app-btn-secondary">
                    إلغاء
                </a>

                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    حفظ الصلاحيات
                </button>
            </div>
        <?php endif; ?>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/users/permissions.blade.php ENDPATH**/ ?>