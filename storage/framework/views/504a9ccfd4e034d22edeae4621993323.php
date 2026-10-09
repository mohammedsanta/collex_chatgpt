<?php
    $editing = isset($user);
?>

<?php if($errors->any()): ?>
    <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 p-4">
        <p class="mb-2 text-xs font-extrabold text-red-400">
            يرجى مراجعة البيانات التالية:
        </p>

        <ul class="space-y-1 text-[11px] text-red-300">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>• <?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form
    method="POST"
    action="<?php echo e($editing ? route('users.update', $user) : route('users.store')); ?>"
>
    <?php echo csrf_field(); ?>

    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'البيانات الأساسية','icon' => 'fa-user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'البيانات الأساسية','icon' => 'fa-user']); ?>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            <div>
                <label for="name" class="mb-2 block text-[10px] font-bold text-dim">
                    الاسم بالكامل <span class="text-red-400">*</span>
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php echo e(old('name', $user->name ?? '')); ?>"
                    required
                    maxlength="255"
                    autocomplete="name"
                    class="app-input w-full"
                    placeholder="اسم الموظف بالكامل"
                >
            </div>

            <div>
                <label for="employee_code" class="mb-2 block text-[10px] font-bold text-dim">
                    كود الموظف <span class="text-red-400">*</span>
                </label>

                <input
                    id="employee_code"
                    name="employee_code"
                    type="text"
                    value="<?php echo e(old('employee_code', $user->employee_code ?? '')); ?>"
                    required
                    maxlength="20"
                    class="app-input w-full"
                    placeholder="مثال: EMP-1001"
                >
            </div>

            <div>
                <label for="phone" class="mb-2 block text-[10px] font-bold text-dim">
                    رقم الهاتف
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="tel"
                    value="<?php echo e(old('phone', $user->phone ?? '')); ?>"
                    maxlength="20"
                    autocomplete="tel"
                    class="app-input w-full"
                    placeholder="01xxxxxxxxx"
                >
            </div>

            <div class="md:col-span-2 xl:col-span-1">
                <label for="email" class="mb-2 block text-[10px] font-bold text-dim">
                    البريد الإلكتروني <span class="text-red-400">*</span>
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="<?php echo e(old('email', $user->email ?? '')); ?>"
                    required
                    maxlength="255"
                    autocomplete="email"
                    class="app-input w-full"
                    placeholder="employee@example.com"
                >
            </div>

            <div>
                <label for="role_id" class="mb-2 block text-[10px] font-bold text-dim">
                    الدور الوظيفي <span class="text-red-400">*</span>
                </label>

                <select id="role_id" name="role_id" required class="app-input w-full">
                    <option value="">اختر الدور</option>

                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($role->id); ?>"
                            <?php if((string) old('role_id', $user->role_id ?? '') === (string) $role->id): echo 'selected'; endif; ?>
                        >
                            <?php echo e($role->label ?: $role->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label for="supervisor_id" class="mb-2 block text-[10px] font-bold text-dim">
                    المشرف المباشر
                </label>

                <select id="supervisor_id" name="supervisor_id" class="app-input w-full">
                    <option value="">بدون مشرف</option>

                    <?php $__currentLoopData = $supervisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supervisor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($supervisor->id); ?>"
                            <?php if((string) old('supervisor_id', $user->supervisor_id ?? '') === (string) $supervisor->id): echo 'selected'; endif; ?>
                        >
                            <?php echo e($supervisor->name); ?> — <?php echo e($supervisor->employee_code); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label for="status" class="mb-2 block text-[10px] font-bold text-dim">
                    حالة الحساب <span class="text-red-400">*</span>
                </label>

                <select id="status" name="status" required class="app-input w-full">
                    <option value="active" <?php if(old('status', $user->status ?? 'active') === 'active'): echo 'selected'; endif; ?>>
                        نشط
                    </option>

                    <option value="inactive" <?php if(old('status', $user->status ?? '') === 'inactive'): echo 'selected'; endif; ?>>
                        غير نشط
                    </option>

                    <option value="suspended" <?php if(old('status', $user->status ?? '') === 'suspended'): echo 'selected'; endif; ?>>
                        موقوف
                    </option>
                </select>
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

    <div class="mt-5">
        <?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'بيانات تسجيل الدخول','icon' => 'fa-lock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'بيانات تسجيل الدخول','icon' => 'fa-lock']); ?>

            <div class="grid gap-5 md:grid-cols-2">

                <div>
                    <label for="password" class="mb-2 block text-[10px] font-bold text-dim">
                        كلمة المرور
                        <?php if (! ($editing)): ?>
                            <span class="text-red-400">*</span>
                        <?php endif; ?>
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        <?php if(! $editing): echo 'required'; endif; ?>
                        minlength="8"
                        autocomplete="<?php echo e($editing ? 'new-password' : 'new-password'); ?>"
                        class="app-input w-full"
                        placeholder="<?php echo e($editing ? 'اتركها فارغة للاحتفاظ بالحالية' : '8 أحرف على الأقل'); ?>"
                    >

                    <?php if($editing): ?>
                        <p class="mt-2 text-[10px] text-dim">
                            لن تتغير كلمة المرور إذا تركت الحقل فارغًا.
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-[10px] font-bold text-dim">
                        تأكيد كلمة المرور
                    </label>

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        minlength="8"
                        autocomplete="new-password"
                        class="app-input w-full"
                        placeholder="أعد كتابة كلمة المرور"
                    >
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

    <div class="mt-5 flex flex-wrap justify-end gap-3">
        <a
            href="<?php echo e($editing ? route('users.show', $user) : route('users.index')); ?>"
            class="app-btn app-btn-secondary"
        >
            إلغاء
        </a>

        <button type="submit" class="app-btn app-btn-primary">
            <i class="fa-solid <?php echo e($editing ? 'fa-floppy-disk' : 'fa-user-plus'); ?>"></i>
            <?php echo e($editing ? 'حفظ التعديلات' : 'إنشاء المستخدم'); ?>

        </button>
    </div>
</form><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/users/partials/form.blade.php ENDPATH**/ ?>