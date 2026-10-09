<?php echo csrf_field(); ?>
<div class="grid gap-x-5 gap-y-4 md:grid-cols-2">
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'الاسم الكامل','name' => 'name','value' => $client->name ?? null,'required' => true,'placeholder' => 'اسم العميل كما في المستندات']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الاسم الكامل','name' => 'name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->name ?? null),'required' => true,'placeholder' => 'اسم العميل كما في المستندات']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'الرقم القومي','name' => 'national_id','value' => $client->national_id ?? null,'required' => true,'placeholder' => '14 رقمًا','inputmode' => 'numeric','minlength' => '14','maxlength' => '14','pattern' => '[0-9]{14}','help' => 'يجب إدخال 14 رقمًا.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'الرقم القومي','name' => 'national_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->national_id ?? null),'required' => true,'placeholder' => '14 رقمًا','inputmode' => 'numeric','minlength' => '14','maxlength' => '14','pattern' => '[0-9]{14}','help' => 'يجب إدخال 14 رقمًا.']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'البريد الإلكتروني','name' => 'email','type' => 'email','value' => $client->email ?? null,'placeholder' => 'name@example.com']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'البريد الإلكتروني','name' => 'email','type' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->email ?? null),'placeholder' => 'name@example.com']); ?>
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
    <?php if (isset($component)) { $__componentOriginala2fbd5dd19e5d391186efe67b2f11409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-field','data' => ['label' => 'المحافظة','name' => 'governorate_id','value' => $client->governorate_id ?? null,'options' => ($governorates ?? collect())->pluck('name', 'id')->all(),'placeholder' => 'اختر المحافظة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'المحافظة','name' => 'governorate_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->governorate_id ?? null),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($governorates ?? collect())->pluck('name', 'id')->all()),'placeholder' => 'اختر المحافظة']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $attributes = $__attributesOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__attributesOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409)): ?>
<?php $component = $__componentOriginala2fbd5dd19e5d391186efe67b2f11409; ?>
<?php unset($__componentOriginala2fbd5dd19e5d391186efe67b2f11409); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'جهة العمل','name' => 'employer_name','value' => $client->employer_name ?? null,'placeholder' => 'اسم جهة العمل']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'جهة العمل','name' => 'employer_name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->employer_name ?? null),'placeholder' => 'اسم جهة العمل']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'المسمى الوظيفي','name' => 'job_title','value' => $client->job_title ?? null,'placeholder' => 'المسمى الوظيفي']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'المسمى الوظيفي','name' => 'job_title','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->job_title ?? null),'placeholder' => 'المسمى الوظيفي']); ?>
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
    <div class="md:col-span-2"><?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'عنوان السكن','name' => 'address','value' => $client->address ?? null,'placeholder' => 'العنوان بالتفصيل','maxlength' => '500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'عنوان السكن','name' => 'address','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->address ?? null),'placeholder' => 'العنوان بالتفصيل','maxlength' => '500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?></div>
    <div class="md:col-span-2"><?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['label' => 'عنوان العمل','name' => 'work_address','value' => $client->work_address ?? null,'placeholder' => 'عنوان جهة العمل','maxlength' => '500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'عنوان العمل','name' => 'work_address','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->work_address ?? null),'placeholder' => 'عنوان جهة العمل','maxlength' => '500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?></div>
    <div class="md:col-span-2"><?php if (isset($component)) { $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea-field','data' => ['label' => 'ملاحظات','name' => 'notes','value' => $client->notes ?? null,'rows' => '3','placeholder' => 'أي معلومات إضافية مفيدة للفريق']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'ملاحظات','name' => 'notes','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($client->notes ?? null),'rows' => '3','placeholder' => 'أي معلومات إضافية مفيدة للفريق']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $attributes = $__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__attributesOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7)): ?>
<?php $component = $__componentOriginala2e5900c20998b7a8b4f1001b5da39c7; ?>
<?php unset($__componentOriginala2e5900c20998b7a8b4f1001b5da39c7); ?>
<?php endif; ?></div>
</div>
<div class="mt-7 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-5"><button type="submit" class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> <?php echo e(isset($client) ? 'حفظ التعديلات' : 'إنشاء ملف العميل'); ?></button><a href="<?php echo e(isset($client) ? route('clients.show', $client) : route('clients.index')); ?>" class="app-btn app-btn-secondary">إلغاء</a><p class="mr-auto text-[10px] text-slate-400"><i class="fa-solid fa-lock ml-1"></i> يتم التحقق من صحة البيانات قبل الحفظ.</p></div>
<?php /**PATH D:\ryada\projects\try\test\collex_views\resources\views/clients/_form.blade.php ENDPATH**/ ?>