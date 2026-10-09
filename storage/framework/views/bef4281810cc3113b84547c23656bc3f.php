<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'تسجيل الدخول'); ?> · <?php echo e(config('app.name', 'Collex')); ?></title>
    <?php echo $__env->make('layouts.partials._head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body class="min-h-screen">
    <main class="auth-grid flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-[460px]">
            <div class="mb-7 text-center">
                <div class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-2xl border border-brand/20 bg-brand/10 text-2xl text-brand shadow-lg shadow-brand/5"><i class="fa-solid fa-chart-line"></i></div>
                <h1 class="text-2xl font-black text-fg">كولكس <span class="text-brand">Collex</span></h1>
                <p class="mt-2 text-xs text-muted">منصة إدارة التحصيل والعمليات المالية</p>
            </div>
            <div class="auth-card rounded-3xl p-6 sm:p-9"><?php echo $__env->make('components.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php echo $__env->yieldContent('content'); ?></div>
            <p class="mt-6 text-center text-[10px] text-dim">© <?php echo e(now()->year); ?> Collex. جميع الحقوق محفوظة.</p>
        </div>
    </main>
    <?php echo $__env->make('layouts.partials._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/layouts/guest.blade.php ENDPATH**/ ?>