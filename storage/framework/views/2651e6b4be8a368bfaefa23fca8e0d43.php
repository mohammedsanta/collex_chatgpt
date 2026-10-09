<?php $__env->startSection('title', 'تسجيل وعد سداد'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="mx-auto max-w-5xl space-y-6">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <a
                    href="<?php echo e(route('banks.ptp.index', ['bank' => $bank->id])); ?>"
                    class="transition hover:text-emerald-400"
                >
                    وعود السداد
                </a>

                <i class="fa-solid fa-chevron-left text-xs"></i>

                <span class="text-gray-200">تسجيل وعد سداد</span>
            </div>

            <h1 class="text-2xl font-bold text-white sm:text-3xl">
                تسجيل وعد سداد جديد
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                تسجيل ومتابعة التزام العميل بسداد المبلغ المستحق.
            </p>
        </div>

        <a
            href="<?php echo e(route('banks.ptp.index', ['bank' => $bank->id])); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
        >
            <i class="fa-solid fa-arrow-right"></i>
            العودة إلى وعود السداد
        </a>
    </div>

    
    <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-xl text-emerald-400">
                <i class="fa-solid fa-building-columns"></i>
            </div>

            <div>
                <p class="text-sm text-gray-400">البنك الحالي</p>

                <h2 class="mt-1 text-lg font-semibold text-white">
                    <?php echo e($bank->name); ?>

                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    رقم البنك: #<?php echo e($bank->id); ?>

                </p>
            </div>

            <div class="mr-auto hidden text-left sm:block">
                <p class="text-xs text-gray-500">الحالات المتاحة</p>

                <p class="mt-1 text-xl font-bold text-emerald-400">
                    <?php echo e($cases->count()); ?>

                </p>
            </div>
        </div>
    </div>

    
    <?php if($errors->any()): ?>
        <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation mt-1 text-red-400"></i>

                <div>
                    <h3 class="font-semibold text-red-300">
                        يرجى مراجعة البيانات التالية
                    </h3>

                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-200">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <form
        action="<?php echo e(route('banks.ptp.store', ['bank' => $bank->id])); ?>"
        method="POST"
        class="space-y-6"
    >
        <?php echo csrf_field(); ?>

        
        <section class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70">
            <div class="border-b border-white/10 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">
                        <i class="fa-solid fa-user-check"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-white">
                            بيانات الحالة
                        </h2>

                        <p class="mt-1 text-xs text-gray-400">
                            اختر حالة العميل المرتبطة بالبنك الحالي.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                
                <div class="sm:col-span-2">
                    <label
                        for="debt_case_id"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        حالة العميل
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="debt_case_id"
                        name="debt_case_id"
                        required
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'w-full rounded-xl border bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:ring-2 focus:ring-emerald-500/30',
                            'border-red-500/50' => $errors->has('debt_case_id'),
                            'border-white/10 focus:border-emerald-500' => !$errors->has('debt_case_id'),
                        ]); ?>"
                    >
                        <option value="">اختر حالة العميل</option>

                        <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($case->id); ?>"
                                <?php if((string) old('debt_case_id') === (string) $case->id): echo 'selected'; endif; ?>
                            >
                                حالة #<?php echo e($case->id); ?>

                                — <?php echo e($case->client?->name ?? 'عميل غير محدد'); ?>

                                — <?php echo e($case->portfolio?->name ?? 'بدون محفظة'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php $__errorArgs = ['debt_case_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <?php if($cases->isEmpty()): ?>
                        <div class="mt-3 flex items-start gap-2 rounded-xl border border-amber-500/20 bg-amber-500/10 p-3 text-sm text-amber-300">
                            <i class="fa-solid fa-triangle-exclamation mt-1"></i>

                            <p>
                                لا توجد حالات متاحة لهذا البنك. أضف حالة إلى إحدى محافظه أولًا.
                            </p>
                        </div>
                    <?php else: ?>
                        <p class="mt-2 text-xs text-gray-500">
                            يتم عرض الحالات التابعة لمحافظ هذا البنك فقط.
                        </p>
                    <?php endif; ?>
                </div>

            </div>
        </section>

        
        <section class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70">
            <div class="border-b border-white/10 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">
                        <i class="fa-solid fa-handshake"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-white">
                            تفاصيل وعد السداد
                        </h2>

                        <p class="mt-1 text-xs text-gray-400">
                            أدخل المبلغ والتاريخ والحالة الحالية للوعد.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                
                <div>
                    <label
                        for="promised_amount"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        المبلغ المتعهد بسداده
                        <span class="text-red-400">*</span>
                    </label>

                    <div class="relative">
                        <input
                            id="promised_amount"
                            type="number"
                            name="promised_amount"
                            value="<?php echo e(old('promised_amount')); ?>"
                            min="0.01"
                            step="0.01"
                            required
                            placeholder="مثال: 5000.00"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:ring-2 focus:ring-emerald-500/30',
                                'border-red-500/50' => $errors->has('promised_amount'),
                                'border-white/10 focus:border-emerald-500' => !$errors->has('promised_amount'),
                            ]); ?>"
                        />
                    </div>

                    <?php $__errorArgs = ['promised_amount'];
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
                    <label
                        for="promise_date"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        تاريخ السداد المتوقع
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="promise_date"
                        type="date"
                        name="promise_date"
                        value="<?php echo e(old('promise_date')); ?>"
                        required
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['promise_date'];
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

                
                <div class="sm:col-span-2">
                    <label
                        for="status"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        حالة الوعد
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    >
                        <option
                            value="active"
                            <?php if(old('status', 'active') === 'active'): echo 'selected'; endif; ?>
                        >
                            نشط — في انتظار السداد
                        </option>

                        <option
                            value="review"
                            <?php if(old('status') === 'review'): echo 'selected'; endif; ?>
                        >
                            قيد المراجعة
                        </option>
                    </select>

                    <?php $__errorArgs = ['status'];
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

                
                <div class="sm:col-span-2">
                    <label
                        for="notes"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        ملاحظات
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        maxlength="5000"
                        placeholder="أضف أي تفاصيل أو ملاحظات متعلقة بوعد السداد..."
                        class="w-full resize-y rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    ><?php echo e(old('notes')); ?></textarea>

                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <p class="mt-2 text-xs text-gray-500">
                        الحد الأقصى 5000 حرف.
                    </p>
                </div>

            </div>
        </section>

        
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a
                href="<?php echo e(route('banks.ptp.index', ['bank' => $bank->id])); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
            >
                إلغاء
            </a>

            <button
                type="submit"
                <?php if($cases->isEmpty()): echo 'disabled'; endif; ?>
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 px-6 py-3 text-sm font-semibold text-gray-950 transition hover:bg-emerald-400 disabled:cursor-not-allowed disabled:opacity-50"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                حفظ وعد السداد
            </button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/ptp/create.blade.php ENDPATH**/ ?>