

<?php $__env->startSection('title', 'إنشاء حالة مديونية'); ?>

<?php $__env->startSection('content'); ?>
<div dir="rtl" class="mx-auto max-w-5xl space-y-6">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <a
                    href="<?php echo e(route('banks.cases.store', ['bank' => $bank->id])); ?>"
                    class="transition hover:text-emerald-400"
                >
                    البنوك
                </a>

                <i class="fa-solid fa-chevron-left text-xs"></i>

                <span class="text-gray-200">إنشاء حالة مديونية</span>
            </div>

            <h1 class="text-2xl font-bold text-white sm:text-3xl">
                إنشاء حالة مديونية جديدة
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                أدخل بيانات الحالة وحدد المحفظة المرتبطة بها.
            </p>
        </div>

        <a
            href="<?php echo e(url('/banks/' . $bank->id)); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
        >
            <i class="fa-solid fa-arrow-right"></i>
            رجوع
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
        action="<?php echo e(url('/banks/' . $bank->id . '/cases')); ?>"
        method="POST"
        class="space-y-6"
    >
        <?php echo csrf_field(); ?>

        
        <section class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70">

            <div class="border-b border-white/10 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-white">
                            بيانات الحالة
                        </h2>

                        <p class="mt-1 text-xs text-gray-400">
                            حدد المحفظة وأدخل بيانات المديونية.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                
                <div class="sm:col-span-2">
                    <label
                        for="portfolio_id"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        المحفظة
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="portfolio_id"
                        name="portfolio_id"
                        required
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    >
                        <option value="">اختر المحفظة</option>

                        <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($portfolio->id); ?>"
                                <?php if((string) old('portfolio_id') === (string) $portfolio->id): echo 'selected'; endif; ?>
                            >
                                <?php echo e($portfolio->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php $__errorArgs = ['portfolio_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <?php if($portfolios->isEmpty()): ?>
                        <p class="mt-2 text-sm text-amber-400">
                            لا توجد محافظ لهذا البنك. أنشئ محفظة أولًا.
                        </p>
                    <?php endif; ?>
                </div>

                
                <div>
                    <label
                        for="client_id"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        رقم العميل
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="client_id"
                        type="number"
                        name="client_id"
                        value="<?php echo e(old('client_id')); ?>"
                        min="1"
                        required
                        placeholder="أدخل رقم العميل"
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['client_id'];
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
                        أدخل معرّف عميل موجودًا في النظام.
                    </p>
                </div>

                
                <div>
                    <label
                        for="contract_number"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        رقم العقد
                    </label>

                    <input
                        id="contract_number"
                        type="text"
                        name="contract_number"
                        value="<?php echo e(old('contract_number')); ?>"
                        maxlength="255"
                        placeholder="أدخل رقم العقد"
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['contract_number'];
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
                        for="original_amount"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        أصل المديونية
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="original_amount"
                        type="number"
                        name="original_amount"
                        value="<?php echo e(old('original_amount')); ?>"
                        min="0.01"
                        step="0.01"
                        required
                        placeholder="0.00"
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['original_amount'];
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
                        for="outstanding_amount"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        المبلغ المتبقي
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="outstanding_amount"
                        type="number"
                        name="outstanding_amount"
                        value="<?php echo e(old('outstanding_amount')); ?>"
                        min="0"
                        step="0.01"
                        required
                        placeholder="0.00"
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['outstanding_amount'];
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
                        for="due_date"
                        class="mb-2 block text-sm font-medium text-gray-300"
                    >
                        تاريخ الاستحقاق
                    </label>

                    <input
                        id="due_date"
                        type="date"
                        name="due_date"
                        value="<?php echo e(old('due_date')); ?>"
                        class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30"
                    />

                    <?php $__errorArgs = ['due_date'];
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
                        placeholder="أضف ملاحظات عن حالة المديونية..."
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
                </div>

            </div>
        </section>

        
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a
                href="<?php echo e(url('/banks/' . $bank->id)); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-gray-300 transition hover:bg-white/10 hover:text-white"
            >
                إلغاء
            </a>

            <button
                type="submit"
                <?php if($portfolios->isEmpty()): echo 'disabled'; endif; ?>
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 px-6 py-3 text-sm font-semibold text-gray-950 transition hover:bg-emerald-400 disabled:cursor-not-allowed disabled:opacity-50"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                إنشاء الحالة
            </button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/banks/cases/create.blade.php ENDPATH**/ ?>