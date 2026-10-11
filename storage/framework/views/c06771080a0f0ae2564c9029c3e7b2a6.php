<?php $__env->startSection('title', 'التقارير'); ?>
<?php $__env->startSection('topbar-title', 'التقارير'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'التقارير','subtitle' => 'اختر نوع التقرير والفترة المطلوبة، ثم راجع النتائج أو صدّرها حسب الصلاحيات المتاحة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-chart-column']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'التقارير','subtitle' => 'اختر نوع التقرير والفترة المطلوبة، ثم راجع النتائج أو صدّرها حسب الصلاحيات المتاحة.','eyebrow' => 'الفريق والإدارة','icon' => 'fa-chart-column']); ?>
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
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
<?php $__currentLoopData = [['تحصيل يومي','ملخص التحصيل والمكالمات والزيارات والوعود حسب الموظف والبنك.','fa-calendar-day','reports.daily'],['أداء الفريق','مقارنة الأداء والأهداف والنتائج بين أعضاء فريق التحصيل.','fa-chart-line','reports.performance'],['تحليل المحافظ','عرض عدد القضايا وإجمالي الدين والتحصيل حسب المحفظة.','fa-layer-group','reports.portfolios'],['حالة الوعود','متابعة الوعود التي تم الوفاء بها أو كسرها أو تأجيلها.','fa-handshake','reports.promises'],['سجل التصدير','متابعة ملفات التصدير ونتائجها وتاريخ انتهاء صلاحيتها.','fa-file-export','reports.exports'],['سجل النشاط','مراجعة الأحداث المهمة والتغييرات المسجلة على النظام.','fa-clock-rotate-left','activity-logs.index']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="app-card flex flex-col p-5"><span class="grid h-11 w-11 place-items-center rounded-xl border border-brand/20 bg-brand/10 text-brand"><i class="fa-solid <?php echo e($report[2]); ?>"></i></span><h2 class="mt-4 text-sm font-extrabold text-fg"><?php echo e($report[0]); ?></h2><p class="mt-2 flex-1 text-[11px] leading-6 text-muted"><?php echo e($report[1]); ?></p><div class="mt-5"><?php if(\Illuminate\Support\Facades\Route::has($report[3])): ?><a href="<?php echo e(route($report[3])); ?>" class="app-btn app-btn-secondary w-full">فتح التقرير <i class="fa-solid fa-arrow-left"></i></a><?php else: ?><span class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-line px-3 py-2.5 text-[10px] font-bold text-dim"><i class="fa-solid fa-link-slash"></i> المسار غير مربوط بعد</span><?php endif; ?></div></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="mt-5"><?php if(\Illuminate\Support\Facades\Route::has('reports.exports')): ?><a href="<?php echo e(route('reports.exports')); ?>" class="app-btn app-btn-primary"><i class="fa-solid fa-file-export"></i> متابعة عمليات التصدير</a><?php endif; ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/reports/index.blade.php ENDPATH**/ ?>