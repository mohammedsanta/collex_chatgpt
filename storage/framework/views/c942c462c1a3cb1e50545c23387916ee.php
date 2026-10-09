<?php $__env->startSection('title', 'تفاصيل المستخدم'); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'تفاصيل المستخدم','subtitle' => 'معلومات الحساب والدور الوظيفي والارتباطات.','eyebrow' => 'إدارة المستخدمين / التفاصيل','icon' => 'fa-id-card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تفاصيل المستخدم','subtitle' => 'معلومات الحساب والدور الوظيفي والارتباطات.','eyebrow' => 'إدارة المستخدمين / التفاصيل','icon' => 'fa-id-card']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('users.index')); ?>" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                المستخدمون
            </a>

            <?php if (! ($user->is_system_account)): ?>
                <a href="<?php echo e(route('users.edit', $user)); ?>" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-pen"></i>
                    تعديل البيانات
                </a>
            <?php endif; ?>
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
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <i class="fa-solid fa-circle-check ml-2"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="grid gap-4 xl:grid-cols-3">

        <div class="xl:col-span-2">
            <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'الملف الشخصي','icon' => 'fa-user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الملف الشخصي','icon' => 'fa-user']); ?>

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                        <?php if($user->avatar_path): ?>
                            <img
                                src="<?php echo e(\Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar_path)); ?>"
                                alt="<?php echo e($user->name); ?>"
                                class="h-full w-full object-cover"
                            >
                        <?php else: ?>
                            <span class="text-2xl font-extrabold text-brand">
                                <?php echo e(mb_substr($user->name, 0, 1)); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="text-lg font-extrabold">
                            <?php echo e($user->name); ?>

                        </h2>

                        <p class="mt-1 text-xs text-dim">
                            <?php echo e($user->employee_code); ?> · <?php echo e($user->role?->label ?? $user->role?->name ?? 'بدون دور'); ?>

                        </p>

                        <p class="mt-2 break-all text-xs text-dim">
                            <?php echo e($user->email); ?>

                        </p>

                        <div class="mt-3 flex flex-wrap gap-2">
                            <?php
                                $statusClasses = match ($user->status) {
                                    'active' => 'border-brand/20 bg-brand/5 text-brand',
                                    'inactive' => 'border-orange-500/20 bg-orange-500/5 text-orange-400',
                                    'suspended' => 'border-red-500/20 bg-red-500/5 text-red-400',
                                    default => 'border-white/10 bg-white/5 text-dim',
                                };

                                $statusLabels = [
                                    'active' => 'نشط',
                                    'inactive' => 'غير نشط',
                                    'suspended' => 'موقوف',
                                ];
                            ?>

                            <span class="rounded-lg border px-3 py-1 text-[10px] font-bold <?php echo e($statusClasses); ?>">
                                <?php echo e($statusLabels[$user->status] ?? $user->status); ?>

                            </span>

                            <?php if($user->is_system_account): ?>
                                <span class="rounded-lg border border-orange-500/20 bg-orange-500/5 px-3 py-1 text-[10px] font-bold text-orange-400">
                                    <i class="fa-solid fa-shield-halved ml-1"></i>
                                    حساب نظام محمي
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="mt-6 grid gap-4 border-t border-white/5 pt-5 sm:grid-cols-2">

                    <div>
                        <p class="text-[10px] text-dim">رقم الهاتف</p>
                        <p class="mt-1 text-xs font-bold"><?php echo e($user->phone ?: '—'); ?></p>
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">المشرف المباشر</p>

                        <?php if($user->supervisor): ?>
                            <a
                                href="<?php echo e(route('users.show', $user->supervisor)); ?>"
                                class="mt-1 inline-flex text-xs font-bold hover:text-brand"
                            >
                                <?php echo e($user->supervisor->name); ?>

                                <i class="fa-solid fa-arrow-up-right-from-square mr-2 text-[10px]"></i>
                            </a>
                        <?php else: ?>
                            <p class="mt-1 text-xs font-bold">لا يوجد مشرف</p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">تاريخ إنشاء الحساب</p>
                        <p class="mt-1 text-xs font-bold">
                            <?php echo e($user->created_at?->format('Y-m-d H:i') ?? '—'); ?>

                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] text-dim">آخر تحديث</p>
                        <p class="mt-1 text-xs font-bold">
                            <?php echo e($user->updated_at?->format('Y-m-d H:i') ?? '—'); ?>

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

        <div>
            <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'ملخص النشاط','icon' => 'fa-chart-simple']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'ملخص النشاط','icon' => 'fa-chart-simple']); ?>

                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">البنوك المرتبطة</span>
                        <span class="text-lg font-extrabold"><?php echo e($user->banks->count()); ?></span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">شركات التقسيط</span>
                        <span class="text-lg font-extrabold"><?php echo e($user->installmentCompanies->count()); ?></span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">أعضاء الفريق</span>
                        <span class="text-lg font-extrabold"><?php echo e($user->subordinates->count()); ?></span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs text-dim">صلاحيات مباشرة</span>
                        <span class="text-lg font-extrabold"><?php echo e($user->permissions->count()); ?></span>
                    </div>

                    <div class="border-t border-white/5 pt-4">
                        <p class="text-[10px] text-dim">آخر تسجيل دخول</p>
                        <p class="mt-1 text-xs font-bold">
                            <?php echo e($user->last_login_at?->format('Y-m-d H:i') ?? 'لم يسجل الدخول بعد'); ?>

                        </p>

                        <?php if($user->last_login_ip): ?>
                            <p class="mt-2 text-[10px] text-dim">
                                IP: <?php echo e($user->last_login_ip); ?>

                            </p>
                        <?php endif; ?>
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

    </div>

    
    <div class="mt-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'إدارة حساب المستخدم','icon' => 'fa-sliders']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'إدارة حساب المستخدم','icon' => 'fa-sliders']); ?>

            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

                <a
                    href="<?php echo e(route('users.team', $user)); ?>"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-people-group text-lg text-brand"></i>
                    <p class="mt-3 text-xs font-extrabold">الفريق التابع</p>
                    <p class="mt-1 text-[10px] text-dim">عرض الموظفين التابعين لهذا المشرف</p>
                </a>

                <a
                    href="<?php echo e(route('users.assignments', $user)); ?>"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-building-columns text-lg text-blue-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الجهات المرتبطة</p>
                    <p class="mt-1 text-[10px] text-dim">إدارة البنوك وشركات التقسيط</p>
                </a>

                <a
                    href="<?php echo e(route('users.permissions', $user)); ?>"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-shield-halved text-lg text-purple-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الصلاحيات</p>
                    <p class="mt-1 text-[10px] text-dim">مراجعة الصلاحيات والاستثناءات</p>
                </a>

                <a
                    href="<?php echo e(route('roles.index')); ?>"
                    class="rounded-xl border border-white/5 bg-white/[0.02] p-4 transition hover:border-brand/30"
                >
                    <i class="fa-solid fa-user-shield text-lg text-orange-400"></i>
                    <p class="mt-3 text-xs font-extrabold">الأدوار الوظيفية</p>
                    <p class="mt-1 text-[10px] text-dim">عرض الأدوار المعرفة في النظام</p>
                </a>

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

    
    <div class="mt-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'الموظفون التابعون','icon' => 'fa-people-group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الموظفون التابعون','icon' => 'fa-people-group']); ?>

            <?php if($user->subordinates->isNotEmpty()): ?>
                <div class="table-wrap w-full overflow-x-auto">
                    <table class="data-table w-full min-w-[600px]">
                        <thead>
                            <tr>
                                <th>الموظف</th>
                                <th>كود الموظف</th>
                                <th>الدور</th>
                                <th>الحالة</th>
                                <th>التفاصيل</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $user->subordinates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subordinate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-xs font-bold"><?php echo e($subordinate->name); ?></td>
                                    <td class="text-xs text-dim"><?php echo e($subordinate->employee_code); ?></td>
                                    <td class="text-xs"><?php echo e($subordinate->role?->label ?? $subordinate->role?->name ?? '—'); ?></td>
                                    <td class="text-xs"><?php echo e($subordinate->status); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('users.show', $subordinate)); ?>" class="app-btn app-btn-secondary !px-3 !py-2">
                                            <i class="fa-solid fa-eye"></i>
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="py-6 text-center text-xs text-dim">
                    لا يوجد موظفون تابعون لهذا المستخدم.
                </p>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/users/show.blade.php ENDPATH**/ ?>