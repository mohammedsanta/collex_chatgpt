<?php $__env->startSection('title', 'نظرة عامة'); ?>
<?php $__env->startSection('topbar-title', 'نظرة عامة'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'نظرة عامة','subtitle' => 'ملخص تشغيلي يجمع مؤشرات العملاء والقضايا والمدفوعات والالتزامات.','eyebrow' => 'الرئيسية','icon' => 'fa-compass']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'نظرة عامة','subtitle' => 'ملخص تشغيلي يجمع مؤشرات العملاء والقضايا والمدفوعات والالتزامات.','eyebrow' => 'الرئيسية','icon' => 'fa-compass']); ?>
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
<?php ($overviewStats = $stats ?? []); ?>
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4"><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'العملاء','value' => number_format(data_get($overviewStats,'clients',0)),'icon' => 'fa-users','color' => 'green','hint' => 'إجمالي ملفات العملاء']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'العملاء','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format(data_get($overviewStats,'clients',0))),'icon' => 'fa-users','color' => 'green','hint' => 'إجمالي ملفات العملاء']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'القضايا النشطة','value' => number_format(data_get($overviewStats,'active_cases',0)),'icon' => 'fa-file-invoice-dollar','color' => 'blue','hint' => 'قضايا تحت المتابعة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'القضايا النشطة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format(data_get($overviewStats,'active_cases',0))),'icon' => 'fa-file-invoice-dollar','color' => 'blue','hint' => 'قضايا تحت المتابعة']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'دفعات معلقة','value' => number_format(data_get($overviewStats,'pending_payments',0)),'icon' => 'fa-clock','color' => 'orange','hint' => 'تحتاج إلى مراجعة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'دفعات معلقة','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format(data_get($overviewStats,'pending_payments',0))),'icon' => 'fa-clock','color' => 'orange','hint' => 'تحتاج إلى مراجعة']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?><?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'التحصيل المؤكد','value' => number_format((float)data_get($overviewStats,'confirmed_collections',0),2).' ج.م','icon' => 'fa-sack-dollar','color' => 'purple','hint' => 'الدفعات المعتمدة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'التحصيل المؤكد','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format((float)data_get($overviewStats,'confirmed_collections',0),2).' ج.م'),'icon' => 'fa-sack-dollar','color' => 'purple','hint' => 'الدفعات المعتمدة']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?></div>
<div class="mt-5 grid gap-5 xl:grid-cols-2"><?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'أهم مؤشرات المتابعة','subtitle' => 'الأرقام المعروضة تعتمد على البيانات التي يرسلها المتحكم','icon' => 'fa-gauge-high']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'أهم مؤشرات المتابعة','subtitle' => 'الأرقام المعروضة تعتمد على البيانات التي يرسلها المتحكم','icon' => 'fa-gauge-high']); ?><div class="space-y-4"><?php $__currentLoopData = [['المدفوعات المعلقة',data_get($overviewStats,'pending_payments',0),'text-warning','fa-hourglass-half'],['القضايا المتأخرة',data_get($overviewStats,'overdue_cases',0),'text-danger','fa-triangle-exclamation'],['وعود السداد النشطة',data_get($overviewStats,'active_promises',0),'text-info','fa-handshake'],['الشكاوى المفتوحة',data_get($overviewStats,'open_complaints',0),'text-accent','fa-message']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="flex items-center justify-between gap-4 rounded-xl border border-line bg-white/[0.02] p-4"><div class="flex items-center gap-3"><span class="grid h-9 w-9 place-items-center rounded-lg bg-white/[0.04] <?php echo e($metric[2]); ?>"><i class="fa-solid <?php echo e($metric[3]); ?>"></i></span><span class="text-xs font-bold text-muted"><?php echo e($metric[0]); ?></span></div><span class="text-lg font-black text-fg"><?php echo e(number_format((float)$metric[1])); ?></span></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal36665f0dc0e45320e21db1e20a989acf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36665f0dc0e45320e21db1e20a989acf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel','data' => ['title' => 'الوصول السريع','subtitle' => 'افتح الوحدات المستخدمة يوميًا','icon' => 'fa-bolt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الوصول السريع','subtitle' => 'افتح الوحدات المستخدمة يوميًا','icon' => 'fa-bolt']); ?><div class="grid gap-3 sm:grid-cols-2"><?php $__currentLoopData = [['العملاء','clients.index','fa-users'],['المدفوعات','payments.index','fa-money-bill-transfer'],['مراجعة المدفوعات','payments.confirmations','fa-list-check'],['القضايا والقروض','loans.index','fa-file-invoice-dollar'],['التقارير','reports.index','fa-chart-column'],['الإعدادات','settings.index','fa-sliders']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(\Illuminate\Support\Facades\Route::has($link[1]) ? route($link[1]) : 'javascript:void(0)'); ?>" class="flex items-center gap-3 rounded-xl border border-line bg-white/[0.02] p-3 hover:border-brand/25 hover:bg-brand/[0.03]"><span class="grid h-9 w-9 place-items-center rounded-lg bg-brand/10 text-brand"><i class="fa-solid <?php echo e($link[2]); ?>"></i></span><span class="flex-1 text-xs font-extrabold text-fg"><?php echo e($link[0]); ?></span><i class="fa-solid fa-arrow-left text-[10px] text-dim"></i></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $attributes = $__attributesOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__attributesOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36665f0dc0e45320e21db1e20a989acf)): ?>
<?php $component = $__componentOriginal36665f0dc0e45320e21db1e20a989acf; ?>
<?php unset($__componentOriginal36665f0dc0e45320e21db1e20a989acf); ?>
<?php endif; ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/overview/index.blade.php ENDPATH**/ ?>