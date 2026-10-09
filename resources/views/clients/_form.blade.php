@csrf
<div class="grid gap-x-5 gap-y-4 md:grid-cols-2">
    <x-form-field label="الاسم الكامل" name="name" :value="$client->name ?? null" required placeholder="اسم العميل كما في المستندات" />
    <x-form-field label="الرقم القومي" name="national_id" :value="$client->national_id ?? null" required placeholder="14 رقمًا" inputmode="numeric" minlength="14" maxlength="14" pattern="[0-9]{14}" help="يجب إدخال 14 رقمًا." />
    <x-form-field label="البريد الإلكتروني" name="email" type="email" :value="$client->email ?? null" placeholder="name@example.com" />
    <x-select-field label="المحافظة" name="governorate_id" :value="$client->governorate_id ?? null" :options="($governorates ?? collect())->pluck('name', 'id')->all()" placeholder="اختر المحافظة" />
    <x-form-field label="جهة العمل" name="employer_name" :value="$client->employer_name ?? null" placeholder="اسم جهة العمل" />
    <x-form-field label="المسمى الوظيفي" name="job_title" :value="$client->job_title ?? null" placeholder="المسمى الوظيفي" />
    <div class="md:col-span-2"><x-form-field label="عنوان السكن" name="address" :value="$client->address ?? null" placeholder="العنوان بالتفصيل" maxlength="500" /></div>
    <div class="md:col-span-2"><x-form-field label="عنوان العمل" name="work_address" :value="$client->work_address ?? null" placeholder="عنوان جهة العمل" maxlength="500" /></div>
    <div class="md:col-span-2"><x-textarea-field label="ملاحظات" name="notes" :value="$client->notes ?? null" rows="3" placeholder="أي معلومات إضافية مفيدة للفريق" /></div>
</div>
<div class="mt-7 flex flex-wrap items-center gap-2 border-t border-line pt-5"><button type="submit" class="app-btn app-btn-primary"><i class="fa-solid fa-floppy-disk"></i> {{ isset($client) ? 'حفظ التعديلات' : 'إنشاء ملف العميل' }}</button><a href="{{ isset($client) ? route('clients.show', $client) : route('clients.index') }}" class="app-btn app-btn-secondary">إلغاء</a><p class="mr-auto text-[10px] text-dim"><i class="fa-solid fa-lock ml-1"></i> يتم التحقق من صحة البيانات قبل الحفظ.</p></div>
