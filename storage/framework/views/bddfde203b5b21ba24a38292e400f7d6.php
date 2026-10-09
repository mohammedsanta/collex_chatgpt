
<?php
    $editing = isset($bank) && $bank->exists;
?>

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-300">
            اسم البنك <span class="text-rose-400">*</span>
        </label>
        <input id="name" name="name" required maxlength="255"
               value="<?php echo e(old('name', $bank->name ?? '')); ?>"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: بنك مصر">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="code" class="mb-2 block text-sm font-semibold text-slate-300">
            كود البنك <span class="text-rose-400">*</span>
        </label>
        <input id="code" name="code" required maxlength="100"
               value="<?php echo e(old('code', $bank->code ?? '')); ?>"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: BM">
        <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="sector" class="mb-2 block text-sm font-semibold text-slate-300">
            القطاع
        </label>
        <input id="sector" name="sector" maxlength="255"
               value="<?php echo e(old('sector', $bank->sector ?? '')); ?>"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="مثال: بنوك تجارية">
        <?php $__errorArgs = ['sector'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="logo_path" class="mb-2 block text-sm font-semibold text-slate-300">
            مسار الشعار
        </label>
        <input id="logo_path" name="logo_path" maxlength="2048"
               value="<?php echo e(old('logo_path', $bank->logo_path ?? '')); ?>"
               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
               placeholder="اختياري">
        <?php $__errorArgs = ['logo_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="md:col-span-2">
        <label for="notes" class="mb-2 block text-sm font-semibold text-slate-300">
            ملاحظات
        </label>
        <textarea id="notes" name="notes" rows="4"
                  class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-emerald-400 focus:outline-none"
                  placeholder="أضف أي ملاحظات عن البنك..."><?php echo e(old('notes', $bank->notes ?? '')); ?></textarea>
        <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="md:col-span-2">
        <input type="hidden" name="is_active" value="0">

        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-800 bg-slate-950 p-4">
            <input type="checkbox" name="is_active" value="1"
                   <?php if((bool) old('is_active', $bank->is_active ?? true)): echo 'checked'; endif; ?>
                   class="h-5 w-5 rounded border-slate-600 bg-slate-900 text-emerald-400 focus:ring-emerald-400">
            <span>
                <span class="block font-semibold text-white">بنك نشط</span>
                <span class="mt-1 block text-sm text-slate-500">
                    إلغاء التفعيل يمنع التعامل مع البنك وفقًا لقواعد النظام.
                </span>
            </span>
        </label>
    </div>
</div><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/_form.blade.php ENDPATH**/ ?>