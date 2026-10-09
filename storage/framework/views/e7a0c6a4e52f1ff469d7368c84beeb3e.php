<?php $__env->startSection('title', 'تسجيل الدخول'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-7"><p class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-600">مرحبًا بعودتك</p><h2 class="mt-2 text-xl font-extrabold text-slate-900">تسجيل الدخول إلى حسابك</h2><p class="mt-2 text-xs leading-6 text-slate-500">أدخل بيانات حسابك للوصول إلى لوحة إدارة التحصيل.</p></div>
<form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5"><?php echo csrf_field(); ?>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'البريد الإلكتروني','name' => 'email','type' => 'email','value' => old('email'),'required' => true,'autocomplete' => 'username','placeholder' => 'name@company.com']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'البريد الإلكتروني','name' => 'email','type' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email')),'required' => true,'autocomplete' => 'username','placeholder' => 'name@company.com']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'كلمة المرور','name' => 'password','type' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => 'أدخل كلمة المرور']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'كلمة المرور','name' => 'password','type' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => 'أدخل كلمة المرور']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
    <div class="flex items-center justify-between gap-3"><label class="flex items-center gap-2 text-[11px] font-semibold text-slate-500"><input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"> تذكرني على هذا الجهاز</label><?php if(\Illuminate\Support\Facades\Route::has('password.request')): ?><a href="<?php echo e(route('password.request')); ?>" class="text-[11px] font-extrabold text-emerald-700 hover:text-emerald-800">نسيت كلمة المرور؟</a><?php endif; ?></div>
    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3.5 text-xs font-extrabold text-white shadow-lg shadow-emerald-600/15 transition hover:bg-emerald-700"><i class="fa-solid fa-arrow-right-to-bracket"></i> تسجيل الدخول</button>
</form>
<div class="mt-6 flex items-center justify-center gap-2 border-t border-slate-100 pt-5 text-[10px] text-slate-400"><i class="fa-solid fa-shield-halved text-emerald-600"></i> اتصال آمن · الوصول حسب الصلاحيات المعتمدة</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/auth/login.blade.php ENDPATH**/ ?>