<?php $__env->startSection('title', 'إدارة المستخدمين'); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'إدارة المستخدمين','subtitle' => 'إدارة حسابات الموظفين والأدوار والحالة الوظيفية.','eyebrow' => 'الموارد البشرية / المستخدمون','icon' => 'fa-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'إدارة المستخدمين','subtitle' => 'إدارة حسابات الموظفين والأدوار والحالة الوظيفية.','eyebrow' => 'الموارد البشرية / المستخدمون','icon' => 'fa-users']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('roles.index')); ?>" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-shield-halved"></i>
                الأدوار والصلاحيات
            </a>

            <a href="<?php echo e(route('users.create')); ?>" class="app-btn app-btn-primary">
                <i class="fa-solid fa-user-plus"></i>
                إضافة مستخدم
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
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            <i class="fa-solid fa-circle-check ml-2"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 px-4 py-3 text-xs font-bold text-red-400">
            <i class="fa-solid fa-circle-exclamation ml-2"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'إجمالي المستخدمين','value' => number_format($stats['total']),'icon' => 'fa-users','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'إجمالي المستخدمين','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($stats['total'])),'icon' => 'fa-users','color' => 'blue']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'حسابات نشطة','value' => number_format($stats['active']),'icon' => 'fa-user-check','color' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'حسابات نشطة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($stats['active'])),'icon' => 'fa-user-check','color' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'حسابات غير نشطة','value' => number_format($stats['inactive']),'icon' => 'fa-user-clock','color' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'حسابات غير نشطة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($stats['inactive'])),'icon' => 'fa-user-clock','color' => 'orange']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'حسابات موقوفة','value' => number_format($stats['suspended']),'icon' => 'fa-user-lock','color' => 'purple']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'حسابات موقوفة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($stats['suspended'])),'icon' => 'fa-user-lock','color' => 'purple']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>

    </div>

    
    <div class="mt-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'البحث والتصفية','icon' => 'fa-filter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'البحث والتصفية','icon' => 'fa-filter']); ?>

            <form method="GET" action="<?php echo e(route('users.index')); ?>">
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">

                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-[10px] font-bold text-dim">
                            البحث عن مستخدم
                        </label>

                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-dim"></i>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                placeholder="الاسم، كود الموظف، البريد أو الهاتف"
                                class="app-input w-full pr-10"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="role_id" class="mb-2 block text-[10px] font-bold text-dim">
                            الدور الوظيفي
                        </label>

                        <select id="role_id" name="role_id" class="app-input w-full">
                            <option value="">كل الأدوار</option>

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($role->id); ?>"
                                    <?php if((string) request('role_id') === (string) $role->id): echo 'selected'; endif; ?>
                                >
                                    <?php echo e($role->label ?: $role->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-[10px] font-bold text-dim">
                            حالة الحساب
                        </label>

                        <select id="status" name="status" class="app-input w-full">
                            <option value="">كل الحالات</option>
                            <option value="active" <?php if(request('status') === 'active'): echo 'selected'; endif; ?>>نشط</option>
                            <option value="inactive" <?php if(request('status') === 'inactive'): echo 'selected'; endif; ?>>غير نشط</option>
                            <option value="suspended" <?php if(request('status') === 'suspended'): echo 'selected'; endif; ?>>موقوف</option>
                        </select>
                    </div>

                    <div>
                        <label for="account_type" class="mb-2 block text-[10px] font-bold text-dim">
                            نوع الحساب
                        </label>

                        <select id="account_type" name="account_type" class="app-input w-full">
                            <option value="">كل الحسابات</option>
                            <option value="employee" <?php if(request('account_type') === 'employee'): echo 'selected'; endif; ?>>
                                حساب موظف
                            </option>
                            <option value="system" <?php if(request('account_type') === 'system'): echo 'selected'; endif; ?>>
                                حساب نظام
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="fa-solid fa-filter"></i>
                        تطبيق الفلاتر
                    </button>

                    <a href="<?php echo e(route('users.index')); ?>" class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-left"></i>
                        إعادة ضبط
                    </a>
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
    </div>

    
    <div class="mt-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'قائمة المستخدمين','icon' => 'fa-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'قائمة المستخدمين','icon' => 'fa-users']); ?>

            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <p class="text-[11px] text-dim">
                    عدد النتائج في الصفحة:
                    <span class="font-extrabold text-white"><?php echo e($users->count()); ?></span>
                    من إجمالي
                    <span class="font-extrabold text-white"><?php echo e($users->total()); ?></span>
                </p>
            </div>

            <div class="table-wrap w-full max-w-full overflow-x-auto">
                <table class="data-table w-full min-w-[1100px]">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الموظف</th>
                            <th>الدور</th>
                            <th>المشرف</th>
                            <th>الجهات المرتبطة</th>
                            <th>الحالة</th>
                            <th>آخر دخول</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-dim">
                                    <?php echo e($users->firstItem() + $loop->index); ?>

                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-white/5">
                                            <?php if($user->avatar_path): ?>
                                                <img
                                                    src="<?php echo e(\Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar_path)); ?>"
                                                    alt="<?php echo e($user->name); ?>"
                                                    class="h-full w-full object-cover"
                                                >
                                            <?php else: ?>
                                                <span class="text-xs font-extrabold text-brand">
                                                    <?php echo e(mb_substr($user->name, 0, 1)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="min-w-0">
                                            <a
                                                href="<?php echo e(route('users.show', $user)); ?>"
                                                class="text-xs font-extrabold hover:text-brand"
                                            >
                                                <?php echo e($user->name); ?>

                                            </a>

                                            <p class="mt-1 text-[10px] text-dim">
                                                كود: <?php echo e($user->employee_code); ?>

                                            </p>

                                            <p class="mt-1 break-all text-[10px] text-dim">
                                                <?php echo e($user->email); ?>

                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-xs font-bold">
                                        <?php echo e($user->role?->label ?? $user->role?->name ?? 'بدون دور'); ?>

                                    </span>

                                    <?php if($user->is_system_account): ?>
                                        <span class="mt-1 block text-[10px] font-bold text-orange-400">
                                            <i class="fa-solid fa-shield-halved ml-1"></i>
                                            حساب نظام
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-xs">
                                    <?php echo e($user->supervisor?->name ?? '—'); ?>

                                </td>

                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="rounded-lg border border-blue-500/20 bg-blue-500/5 px-2 py-1 text-[10px] text-blue-400">
                                            <?php echo e($user->banks->count()); ?> بنك
                                        </span>

                                        <span class="rounded-lg border border-cyan-500/20 bg-cyan-500/5 px-2 py-1 text-[10px] text-cyan-400">
                                            <?php echo e($user->installmentCompanies->count()); ?> شركة
                                        </span>
                                    </div>
                                </td>

                                <td>
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

                                    <span class="inline-flex rounded-lg border px-2.5 py-1 text-[10px] font-bold <?php echo e($statusClasses); ?>">
                                        <?php echo e($statusLabels[$user->status] ?? $user->status); ?>

                                    </span>
                                </td>

                                <td class="text-[10px] text-dim">
                                    <?php echo e($user->last_login_at?->format('Y-m-d H:i') ?? 'لم يسجل الدخول'); ?>

                                </td>

                                <td>
                                    <div class="flex items-center gap-2">

                                        <a
                                            href="<?php echo e(route('users.show', $user)); ?>"
                                            class="app-btn app-btn-secondary !px-3 !py-2"
                                            title="التفاصيل"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <?php if (! ($user->is_system_account)): ?>
                                            <a
                                                href="<?php echo e(route('users.edit', $user)); ?>"
                                                class="app-btn app-btn-secondary !px-3 !py-2"
                                                title="تعديل"
                                            >
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a
                                                href="<?php echo e(route('users.permissions', $user)); ?>"
                                                class="app-btn app-btn-secondary !px-3 !py-2"
                                                title="الصلاحيات"
                                            >
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </a>

                                            <form
                                                method="POST"
                                                action="<?php echo e(route('users.destroy', $user)); ?>"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟');"
                                            >
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button
                                                    type="submit"
                                                    class="app-btn app-btn-secondary !px-3 !py-2 text-red-400"
                                                    title="حذف"
                                                >
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="py-12 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <i class="fa-solid fa-users mb-3 text-3xl text-dim"></i>

                                        <p class="text-sm font-extrabold">
                                            لا يوجد مستخدمون مطابقون
                                        </p>

                                        <p class="mt-2 text-xs text-dim">
                                            جرّب تغيير كلمات البحث أو الفلاتر.
                                        </p>

                                        <a href="<?php echo e(route('users.create')); ?>" class="app-btn app-btn-primary mt-4">
                                            <i class="fa-solid fa-user-plus"></i>
                                            إضافة مستخدم جديد
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

            <?php if($users->hasPages()): ?>
                <div class="mt-5 border-t border-white/5 pt-4">
                    <?php echo e($users->links()); ?>

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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/users/index.blade.php ENDPATH**/ ?>