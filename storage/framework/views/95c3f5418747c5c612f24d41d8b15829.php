
<?php
    $editing = isset($role);
?>

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="label" class="mb-2 block text-sm font-medium text-slate-300">
            اسم الدور
        </label>

        <input
            id="label"
            name="label"
            type="text"
            value="<?php echo e(old('label', $role->label ?? '')); ?>"
            class="app-input w-full"
            placeholder="مثال: مشرف التحصيل"
            required
            maxlength="100"
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
        <label for="name" class="mb-2 block text-sm font-medium text-slate-300">
            الاسم البرمجي
        </label>

        <input
            id="name"
            name="name"
            type="text"
            value="<?php echo e(old('name', $role->name ?? '')); ?>"
            class="app-input w-full"
            placeholder="مثال: collection_supervisor"
            required
            maxlength="100"
            pattern="[A-Za-z][A-Za-z0-9_]*"
            <?php if($editing && $role->is_system): echo 'disabled'; endif; ?>
        >

        <?php if($editing && $role->is_system): ?>
            <p class="mt-2 text-xs text-amber-400">
                لا يمكن تغيير الاسم البرمجي لدور النظام.
            </p>
        <?php else: ?>
            <p class="mt-2 text-xs text-slate-500">
                استخدم الحروف الإنجليزية والأرقام والشرطة السفلية.
            </p>
        <?php endif; ?>

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
        <label for="level" class="mb-2 block text-sm font-medium text-slate-300">
            مستوى الدور
        </label>

        <input
            id="level"
            name="level"
            type="number"
            min="0"
            max="100"
            value="<?php echo e(old('level', $role->level ?? 0)); ?>"
            class="app-input w-full"
            required
            <?php if($editing && $role->is_system): echo 'disabled'; endif; ?>
        >

        <?php $__errorArgs = ['level'];
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

    <div class="md:col-span-2">
        <label for="description" class="mb-2 block text-sm font-medium text-slate-300">
            وصف الدور
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            maxlength="1000"
            class="app-input w-full"
            placeholder="اشرح مسؤوليات الدور..."
        ><?php echo e(old('description', $role->description ?? '')); ?></textarea>

        <?php $__errorArgs = ['description'];
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

<div class="mt-6 flex flex-wrap items-center gap-3 border-t border-white/10 pt-5">
    <button type="submit" class="app-btn app-btn-primary">
        <i class="fa-solid fa-floppy-disk ml-2"></i>
        <?php echo e($editing ? 'حفظ التعديلات' : 'إنشاء الدور'); ?>

    </button>

    <a href="<?php echo e(route('roles.index')); ?>" class="app-btn">
        إلغاء
    </a>
</div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/roles/partials/form.blade.php ENDPATH**/ ?>